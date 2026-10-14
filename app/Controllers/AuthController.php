<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\OtpModel;
use CodeIgniter\I18n\Time;


class AuthController extends BaseController
{


    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session   = session();
        $this->userModel = new UserModel();
    }


    public function login()
    {
        helper('url');
        if (strtolower($this->request->getMethod()) === 'post') {
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                if (!$user['is_verified']) {
                    return redirect()->back()->with('error', 'Akun belum diverifikasi.');
                }

                session()->regenerate();
                $this->setSession($user);

                $role = strtolower(trim($user['role']));

                // if ($role === 'admin') {
                //     return redirect()->to('dashboard_admin');
                // } else {
                //     return redirect()->to('dashboard');
                // }

                if ($role === 'admin') {
                    return redirect()->to('dashboard_admin');
                } else {
                    return redirect()->to('dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Email atau password salah.');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // hapus semua data session

        return redirect()->to('dashboard');
    }

    public function register()
    {
        $model = new \App\Models\UserModel();
        $otpModel = new \App\Models\OtpModel();


        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'name'           => 'required|min_length[3]',
                'email_or_phone' => 'required',
                'date_of_birth' => 'required',
                'password'       => 'required|min_length[6]'
            ];

            if (!$this->validate($rules)) {
                return view('auth/register', [
                    'validation' => $this->validator
                ]);
            }
            $emailOrPhone = $this->request->getPost('email_or_phone');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            // Cek sudah terdaftar
            if ($model->where('email', $emailOrPhone)->orWhere('phone', $emailOrPhone)->first()) {
                return redirect()->back()->with('error', 'Email atau nomor sudah terdaftar.');
            }

            // Dibawah ini untuk proses simpan data
            $userData = [
                'name'          => $this->request->getPost('name'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'password'      => $password,
                'role'          => 'user',
                'is_verified'   => 0
            ];

            $email = null;
            $phone = null;

            // Tentukan apakah input email atau phone
            $channel = '';
            if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
                $userData['email'] = $emailOrPhone;
                $email = $emailOrPhone;
                $channel = 'email';
            } 
            // else {
            //     $phone = preg_replace('/^0/', '62', $emailOrPhone);
            //     $userData['phone'] = $phone;
            //     $channel = 'phone';
            // }

            // Insert dan cek hasilnya`
            $userId = $model->insert($userData);
            $newUser = $model->find($userId);


            // Generate OTP
            $otpCode = random_int(10000, 99999);

            // // Simpan session untuk verify

            $this->session->set([
                'otp_user_id' => $newUser['id'],
                'otp_email'   => $newUser['email'] ?? null,
                'otp_phone'   => $newUser['phone'] ?? null,
                'otp_channel' => $channel,
            ]);

            // Simpan ke tabel otp_codes
            $otpModel->insert([
                'user_id'    => $userId,
                'otp_code'   => $otpCode,
                'channel'    => $channel,
                'purpose'    => 'register',
                'is_used'    => 0,
                'expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_otp_code' => date('Y-m-d H:i:s')
            ]);

            // Kirim OTP
            if ($channel === 'email') {
                $email = \Config\Services::email();
                $email->setTo($emailOrPhone);
                $email->setFrom('noreply@yourapp.com', 'Aplikasi Sejiwa');
                $email->setSubject('Kode OTP Verifikasi');
                $email->setMessage("Kode OTP Anda adalah: <b>$otpCode</b>");
                $email->setMailType('html');
                $email->send();
            } else {
                $this->sendWhatsappOtp($emailOrPhone, $otpCode);
            }

            return view('auth/verify', [
                'user' => $newUser,
                'contact' => $emailOrPhone,
                'channel' => $channel
            ]);
        }

        return view('auth/register');
    }

    private function sendEmailOtp($to, $otp)
    {
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setSubject('Kode OTP Verifikasi Akun');
        $email->setMessage("Kode OTP Anda adalah: <b>$otp</b>. Jangan berikan kepada siapa pun.");

        if ($email->send()) {
            return true;
        } else {
            log_message('error', $email->printDebugger(['headers']));
            return false;
        }
    }


    // Tambahan fungsi kirim OTP WA
    private function sendWhatsappOtp($phone, $otp)
    {
        $token = "pFqAQbq76hknjBWNOkRP3p7645qYi79Wn3LYhoIiqao6cyPNmU1K2WC"; // Token API

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'target'  => $phone,
            'message' => "Kode OTP Anda adalah: *$otp* (berlaku 5 menit)."
        ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: $token"
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function verifyOtp()
    {
        helper(['form', 'url']);

        if (strtolower($this->request->getMethod()) === 'post') {


            // Ambil OTP (bisa dari 1 field "otp" atau array "otp[]")
            $otpInput = $this->request->getPost('otp');
            $otp      = is_array($otpInput) ? implode('', $otpInput) : trim((string)$otpInput);

            // Ambil user dari session
            $userId  = session()->get('otp_user_id');
            $channel = session()->get('otp_channel');

            if (!$userId) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Sesi verifikasi tidak ditemukan. Silakan daftar ulang.'
                ]);
            }

            $user = $this->userModel->find($userId);
            if (!$user) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'User tidak ditemukan.'
                ]);
            }

            // Ambil OTP terbaru yang belum dipakai
            $otpModel = new \App\Models\OtpModel();
            $otpData  = $otpModel->where('user_id', $userId)
                ->where('is_used', 0)
                ->orderBy('id', 'DESC')
                ->first();

            if (!$otpData) {
                return view('auth/verify', [
                    'user'    => $user,
                    'channel' => $channel ?? ($user['email'] ? 'email' : 'phone'),
                    'error'   => 'OTP tidak ditemukan. Silakan kirim ulang.',
                ]);
            }

            // Cek kadaluarsa berdasarkan expires_at
            if (time() > strtotime($otpData['expires_at'])) {
                return view('auth/verify', [
                    'user'    => $user,
                    'channel' => $channel ?? ($user['email'] ? 'email' : 'phone'),
                    'error'   => 'Kode OTP telah kedaluwarsa.',
                ]);
            }

            // Cocokkan OTP
            if ($otp !== $otpData['otp_code']) {
                return view('auth/verify', [
                    'user'    => $user,
                    'channel' => $channel ?? ($user['email'] ? 'email' : 'phone'),
                    'error'   => 'Kode OTP salah.',
                ]);
            }

            // Tandai OTP terpakai & verifikasi user
            $otpModel->update($otpData['id'], ['is_used' => 1]);
            $otpModel->update($otpData['id'], ['is_verified' => 1]);
            $this->userModel->update($userId, ['is_verified' => 1]);

            // Bersihkan session OTP
            session()->remove(['otp_user_id', 'otp_email', 'otp_phone', 'otp_channel']);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Verifikasi berhasil! Silakan login.',
                'redirect' => base_url('login')
            ]);
        }

        // GET: tampilkan form verify dari session (agar $channel tidak undefined)
        $userId  = session()->get('otp_user_id');
        $channel = session()->get('otp_channel');

        if (!$userId) {
            return redirect()->to('/register')->with('error', 'Sesi verifikasi tidak ditemukan.');
        }

        $user = $this->userModel->find($userId);

        return view('auth/verify', [
            'user'    => $user,
            'channel' => $channel ?? ($user['email'] ? 'email' : 'phone'),
        ]);
    }

    private function setSession($userData)
    {
        $data = [
            'id'         => $userData['id'],
            'name'       => $userData['name'],
            'email'      => $userData['email'],
            'role'       => $userData['role'],
            'isLoggedIn' => true
        ];

        $this->session->set($data);
        return true;
    }

    public function resendVerification()
    {
        helper(['url', 'form']);

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $user  = $this->userModel->where('email', $email)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Email tidak terdaftar.');
            }

            if ($user['is_verified']) {
                return redirect()->back()->with('error', 'Akun sudah terverifikasi.');
            }

            // Generate token/OTP baru
            $token = bin2hex(random_bytes(16));

            // Simpan ke tabel otp/token_verifikasi
            $otpModel = new \App\Models\OtpModel();
            $otpModel->save([
                'user_id' => $user['id'],
                'token'   => $token,
                'expired_at' => date('Y-m-d H:i:s', strtotime('+10 minutes'))
            ]);

            // Kirim email (pseudo-code)
            service('email')
                ->setTo($email)
                ->setSubject('Verifikasi Ulang Akun')
                ->setMessage("Klik link berikut untuk verifikasi ulang: " . base_url("auth/verify/" . $token))
                ->send();

            return redirect()->back()->with('success', 'Link verifikasi ulang sudah dikirim ke email.');
        }

        return view('verify');
    }

    // =========================================================================
    // FITUR LUPA KATA SANDI (FORGOT PASSWORD)
    // =========================================================================

    public function forgotPassword()
    {
        helper(['url', 'form']);

        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('auth/forgot_password');
    }

    public function sendResetOtp()
    {
        helper(['url', 'form']);

        $rules = [
            'email_or_phone' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Email atau Nomor HP wajib diisi.']
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Silakan masukkan Email atau Nomor HP Anda.');
        }

        $input = trim((string)$this->request->getPost('email_or_phone'));

        // Cari user berdasarkan email atau nomor telepon
        $user = $this->userModel->where('email', $input)->orWhere('phone', $input)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email atau Nomor HP tidak ditemukan dalam sistem.');
        }

        $channel = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $contact = $channel === 'email' ? $user['email'] : ($user['phone'] ?? $input);

        $otpModel = new \App\Models\OtpModel();

        // Nonaktifkan OTP reset sebelumnya yang belum terpakai untuk user ini
        $otpModel->where('user_id', $user['id'])
                 ->where('purpose', 'forgot_password')
                 ->where('is_used', 0)
                 ->set(['is_used' => 1])
                 ->update();

        // Buat 5-digit OTP
        $otpCode = (string) random_int(10000, 99999);

        $otpModel->insert([
            'user_id'        => $user['id'],
            'otp_code'       => $otpCode,
            'channel'        => $channel,
            'purpose'        => 'forgot_password',
            'is_used'        => 0,
            'is_verified'    => 0,
            'expires_at'     => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at_otp' => date('Y-m-d H:i:s')
        ]);

        // Simpan sesi reset
        $this->session->set([
            'reset_user_id' => $user['id'],
            'reset_contact' => $contact,
            'reset_channel' => $channel,
        ]);

        // Kirim OTP via channel terkait
        if ($channel === 'email') {
            $this->sendResetOtpEmail($user['email'], $otpCode);
        } else {
            $this->sendResetOtpWhatsapp($contact, $otpCode);
        }

        if (ENVIRONMENT === 'development') {
            $this->session->setFlashdata('dev_otp', $otpCode);
        }

        return redirect()->to(base_url('verify-reset-otp'))->with('success', 'Kode OTP berhasil dikirimkan.');
    }

    public function verifyResetOtp()
    {
        helper(['url']);

        $userId  = $this->session->get('reset_user_id');
        $contact = $this->session->get('reset_contact');
        $channel = $this->session->get('reset_channel');

        if (!$userId) {
            return redirect()->to(base_url('forgot-password'))->with('error', 'Sesi reset kata sandi tidak ditemukan atau telah kedaluwarsa.');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(base_url('forgot-password'))->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('auth/verify_reset_otp', [
            'user'    => $user,
            'contact' => $contact,
            'channel' => $channel ?? ($user['email'] ? 'email' : 'phone')
        ]);
    }

    public function processVerifyResetOtp()
    {
        helper(['url']);

        $userId = $this->session->get('reset_user_id');
        if (!$userId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Sesi telah kedaluwarsa. Silakan ulangi proses lupa kata sandi.'
                ]);
            }
            return redirect()->to(base_url('forgot-password'))->with('error', 'Sesi telah kedaluwarsa.');
        }

        $otpInput = $this->request->getPost('otp');
        $otp      = is_array($otpInput) ? implode('', $otpInput) : trim((string)$otpInput);

        if (empty($otp)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Silakan masukkan 5 digit kode OTP.'
                ]);
            }
            return redirect()->back()->with('error', 'Silakan masukkan 5 digit kode OTP.');
        }

        $otpModel = new \App\Models\OtpModel();
        $otpData  = $otpModel->where('user_id', $userId)
                             ->where('purpose', 'forgot_password')
                             ->where('is_used', 0)
                             ->orderBy('id', 'DESC')
                             ->first();

        if (!$otpData) {
            $msg = 'Kode OTP tidak ditemukan atau sudah digunakan. Silakan klik Kirim Ulang.';
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => $msg]);
            }
            return redirect()->back()->with('error', $msg);
        }

        if (time() > strtotime($otpData['expires_at'])) {
            $msg = 'Kode OTP telah kedaluwarsa. Silakan klik Kirim Ulang Kode.';
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => $msg]);
            }
            return redirect()->back()->with('error', $msg);
        }

        if ($otp !== $otpData['otp_code']) {
            $msg = 'Kode OTP salah. Silakan periksa kembali.';
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => $msg]);
            }
            return redirect()->back()->with('error', $msg);
        }

        // Tandai OTP terpakai
        $otpModel->update($otpData['id'], [
            'is_used'     => 1,
            'is_verified' => 1
        ]);

        // Berikan otorisasi untuk langkah perubahan kata sandi
        $this->session->set([
            'reset_verified_user_id' => $userId,
            'reset_allowed'          => true
        ]);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'   => 'success',
                'message'  => 'Kode OTP terverifikasi! Silakan tentukan kata sandi baru.',
                'redirect' => base_url('reset-password')
            ]);
        }

        return redirect()->to(base_url('reset-password'));
    }

    public function resendResetOtp()
    {
        helper(['url']);

        $userId  = $this->session->get('reset_user_id');
        $contact = $this->session->get('reset_contact');
        $channel = $this->session->get('reset_channel');

        if (!$userId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Sesi telah berakhir. Silakan minta kode ulang dari halaman awal.'
                ]);
            }
            return redirect()->to(base_url('forgot-password'));
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.']);
            }
            return redirect()->to(base_url('forgot-password'));
        }

        $otpModel = new \App\Models\OtpModel();
        $otpModel->where('user_id', $userId)
                 ->where('purpose', 'forgot_password')
                 ->where('is_used', 0)
                 ->set(['is_used' => 1])
                 ->update();

        $otpCode = (string) random_int(10000, 99999);
        $otpModel->insert([
            'user_id'        => $userId,
            'otp_code'       => $otpCode,
            'channel'        => $channel,
            'purpose'        => 'forgot_password',
            'is_used'        => 0,
            'is_verified'    => 0,
            'expires_at'     => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at_otp' => date('Y-m-d H:i:s')
        ]);

        if ($channel === 'email') {
            $this->sendResetOtpEmail($user['email'], $otpCode);
        } else {
            $this->sendResetOtpWhatsapp($contact, $otpCode);
        }

        if (ENVIRONMENT === 'development') {
            $this->session->setFlashdata('dev_otp', $otpCode);
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Kode OTP baru telah berhasil dikirimkan.',
                'dev_otp' => ENVIRONMENT === 'development' ? $otpCode : null
            ]);
        }

        return redirect()->back()->with('success', 'Kode OTP baru telah dikirimkan.');
    }

    public function resetPassword()
    {
        helper(['url']);

        $userId  = $this->session->get('reset_verified_user_id');
        $allowed = $this->session->get('reset_allowed');

        if (!$userId || !$allowed) {
            return redirect()->to(base_url('forgot-password'))->with('error', 'Silakan verifikasi kode OTP terlebih dahulu.');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(base_url('forgot-password'))->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('auth/reset_password', [
            'user' => $user
        ]);
    }

    public function updatePassword()
    {
        helper(['url', 'form']);

        $userId  = $this->session->get('reset_verified_user_id');
        $allowed = $this->session->get('reset_allowed');

        if (!$userId || !$allowed) {
            return redirect()->to(base_url('login'))->with('error', 'Sesi pengaturan ulang kata sandi telah kedaluwarsa.');
        }

        $rules = [
            'password' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Kata sandi baru wajib diisi.',
                    'min_length' => 'Kata sandi baru minimal harus 6 karakter.'
                ]
            ],
            'password_confirm' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi kata sandi wajib diisi.',
                    'matches'  => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('auth/reset_password', [
                'validation' => $this->validator,
                'user'       => $this->userModel->find($userId)
            ]);
        }

        $newPassword    = $this->request->getPost('password');
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $this->userModel->update($userId, [
            'password' => $hashedPassword
        ]);

        // Bersihkan sesi reset
        $this->session->remove([
            'reset_user_id',
            'reset_contact',
            'reset_channel',
            'reset_verified_user_id',
            'reset_allowed'
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan masuk dengan kata sandi baru.');
    }

    private function sendResetOtpEmail($to, $otp)
    {
        try {
            $email = \Config\Services::email();
            $emailConfig = config('Email');

            $fromEmail = !empty($emailConfig->fromEmail) ? $emailConfig->fromEmail : 'sejiwa.apps@gmail.com';
            $fromName  = !empty($emailConfig->fromName) ? $emailConfig->fromName : 'SEJIWA';

            $email->setFrom($fromEmail, $fromName);
            $email->setTo($to);
            $email->setSubject('Kode OTP Reset Kata Sandi - SEJIWA');

            $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <style>
                    body { font-family: "Poppins", Arial, sans-serif; background-color: #f7f5f7; margin:0; padding: 20px; }
                    .card { max-width: 500px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
                    .header { background: linear-gradient(135deg, #d49cb2 0%, #b16b8e 100%); padding: 30px 20px; text-align: center; color: #ffffff; }
                    .header h1 { margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 1px; }
                    .body { padding: 30px 25px; color: #4b5563; }
                    .body p { font-size: 15px; line-height: 1.6; margin: 0 0 16px; }
                    .otp-box { background: #fdf2f7; border: 2px dashed #b16b8e; border-radius: 12px; text-align: center; padding: 18px; margin: 25px 0; }
                    .otp-code { font-size: 32px; font-weight: 700; letter-spacing: 8px; color: #b16b8e; font-family: monospace; }
                    .footer { text-align: center; padding: 20px; font-size: 13px; color: #9ca3af; }
                </style>
            </head>
            <body>
                <div class="card">
                    <div class="header">
                        <h1>SEJIWA</h1>
                    </div>
                    <div class="body">
                        <p>Halo,</p>
                        <p>Kami menerima permintaan untuk mereset kata sandi akun SEJIWA Anda. Masukkan kode OTP berikut pada halaman verifikasi:</p>
                        <div class="otp-box">
                            <div class="otp-code">' . esc($otp) . '</div>
                        </div>
                        <p style="color: #6b7280; font-size: 13px;">*Kode ini berlaku selama <strong>5 menit</strong>. Jangan bagikan kode ini kepada siapapun.</p>
                        <p style="color: #6b7280; font-size: 13px;">Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.</p>
                    </div>
                    <div class="footer">
                        &copy; ' . date('Y') . ' SEJIWA. All rights reserved.
                    </div>
                </div>
            </body>
            </html>
            ';

            $email->setMessage($message);
            $email->setMailType('html');

            if ($email->send()) {
                return true;
            } else {
                log_message('error', 'Reset OTP Email failed: ' . $email->printDebugger(['headers', 'subject']));
                return false;
            }
        } catch (\Throwable $e) {
            log_message('error', 'Reset OTP Email exception: ' . $e->getMessage());
            return false;
        }
    }

    private function sendResetOtpWhatsapp($phone, $otp)
    {
        try {
            return $this->sendWhatsappOtp($phone, $otp);
        } catch (\Throwable $e) {
            log_message('error', 'Reset OTP WhatsApp exception: ' . $e->getMessage());
            return false;
        }
    }
}
