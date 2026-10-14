<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\LikeModel;
use App\Models\CommentsModel;

class ContentController extends BaseController
{
    protected $contentModel;
    protected $commentModel;
    protected $likeModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
        $this->likeModel = new LikeModel();
        $this->commentModel = new CommentsModel();
    }

    public function index()
    {
        $jenis = $this->request->getGet('jenis') ?? 'all';
        $status = $this->request->getGet('status') ?? 'all';
        $search = $this->request->getGet('search') ?? '';

        // Mulai query
        $query = $this->contentModel;

        // Filter jenis
        if ($jenis !== 'all') {
            $query = $query->where('type', ucfirst($jenis));
        }

        // Filter status
        if ($status !== 'all') {
            $query = $query->where('status', ucfirst($status));
        }

        // Filter pencarian
        if (!empty($search)) {
            $query = $query->like('title', $search)
                ->orLike('description', $search);
        }

        $contents = $query->findAll();

        $data = [
            'contents' => $contents,
            'stats' => $this->contentModel->getContentStats(),
            'jenis' => $jenis,
            'status' => $status,
            'search' => $search,
        ];

        return view('admin/content/content-management', $data);
    }

    public function create()
    {
        return view('admin/content/content_form');
    }

    public function store()
    {
        $type = $this->request->getPost('type');
        $title = $this->request->getPost('title');
        $category = $this->request->getPost('category');
        $body = $this->request->getPost('body');
        $status = $this->request->getPost('status');

        // Tentukan folder upload
        $uploadDir = FCPATH . 'uploads/';
        $filePath = null;

        // ===== 1. Video via Resumable.js =====
        $videoPath = $this->request->getPost('video_path');
        if (!empty($videoPath)) {
            $filePath = $videoPath;
            $type = 'Video';
        }

        // ===== 2. Infografis / Audio =====
        if ($type === 'Infografis' && $this->request->getFile('infographic')->isValid()) {
            $file = $this->request->getFile('infographic');
            $newName = uniqid() . '_' . $file->getName();
            if (!is_dir($uploadDir . 'infografis/')) {
                mkdir($uploadDir . 'infografis/', 0777, true);
            }
            $file->move($uploadDir . 'infografis/', $newName);
            $filePath = 'uploads/infografis/' . $newName;

        } elseif ($type === 'Audio') {
            // Ambil path dari Resumable.js
            $audioPath = $this->request->getPost('audio_path');
            if (!empty($audioPath)) {
                $filePath = $audioPath;
            } else {
                // fallback kalau upload manual
                $file = $this->request->getFile('audio');
                if ($file && $file->isValid()) {
                    $newName = uniqid() . '_' . $file->getName();
                    if (!is_dir($uploadDir . 'audio/')) {
                        mkdir($uploadDir . 'audio/', 0777, true);
                    }
                    $file->move($uploadDir . 'audio/', $newName);
                    $filePath = 'uploads/audio/' . $newName;
                }
            }
        }

        // ===== 3. Thumbnail (opsional) =====
        $thumbnailPath = null;
        if ($this->request->getFile('thumbnail')->isValid()) {
            $thumb = $this->request->getFile('thumbnail');
            $thumbName = uniqid() . '_' . $thumb->getName();
            $thumbDir = $uploadDir . 'thumbnail/';
            if (!is_dir($thumbDir)) {
                mkdir($thumbDir, 0777, true);
            }
            $thumb->move($thumbDir, $thumbName);
            $thumbnailPath = 'uploads/thumbnail/' . $thumbName;
        }

        // ===== 4. Simpan satu record database =====
        $this->contentModel->insertContent([
            'title' => $title,
            'type' => $type,
            'category' => $category,
            'body' => $body,
            'status' => $status,
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->to('content-management');
    }

    public function edit($id)
    {
        $data['content'] = $this->contentModel->getContentById($id);
        return view('admin/content/edit-content', $data);
    }

    public function update($id)
    {
        $this->contentModel->updateContent($id, [
            'title' => $this->request->getPost('title'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'body' => $this->request->getPost('body'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('content-management');
    }

    public function delete($id)
    {
        if ($this->contentModel->delete($id)) {
            return redirect()->to(base_url('content-management'))
                ->with('success', 'Konten berhasil dihapus');
        } else {
            return redirect()->to(base_url('content-management'))
                ->with('error', 'Konten gagal dihapus');
        }
    }

    public function view($id)
    {
        $content = $this->contentModel->find($id);
        $comments = $this->commentModel->where('content_id', $id)->findAll();
        $related = $this->contentModel->where('id !=', $id)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('user/content_detail', [
            'content' => $content,
            'comments' => $comments,
            'related' => $related
        ]);
    }

    public function daftarVideos()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu untuk mengakses video.');
        }

        $videoModel = new contentModel();
        $data['videos'] = $videoModel->findAll(); // ambil semua video dari database

        return view('user/daftar-video', $data);
    }

    public function comment($id)
    {
        $this->commentModel->save([
            'content_id' => $id,
            'user_id' => session()->get('id'),
            'comment' => $this->request->getPost('comment')
        ]);
        return redirect()->back();
    }

    public function like($id)
    {
        $userId = session()->get('id');

        // Cek apakah user sudah like konten
        $existing = $this->likeModel
            ->where('content_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            // Jika sudah like, hapus
            $this->likeModel->delete($existing['id']);
            return $this->response->setJSON(['success' => true, 'action' => 'unlike']);
        } else {
            // Jika belum like, tambah
            $this->likeModel->insert([
                'content_id' => $id,
                'user_id' => $userId
            ]);
            return $this->response->setJSON(['success' => true, 'action' => 'like']);
        }
    }
}
