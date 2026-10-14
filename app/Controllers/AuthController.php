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
}
