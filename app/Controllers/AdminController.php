<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ContentModel;

class AdminController extends BaseController
{
    public function dashboard_admin()
    {
        $userModel    = new UserModel();
        $contentModel = new ContentModel();
        $db           = \Config\Database::connect();

        // 1. Statistik Pengguna
        $totalUsers    = $userModel->countAll();
        $verifiedUsers = $userModel->where('is_verified', 1)->countAllResults();
        $adminCount    = $userModel->where('role', 'admin')->countAllResults();
        $regularUserCount = $userModel->where('role', 'user')->countAllResults();

        // 2. Statistik Konten Edukasi
        $totalContents   = $contentModel->countAll();
        $publishedCount  = $contentModel->where('status', 'Published')->countAllResults();
        $draftCount      = $contentModel->where('status', 'Draft')->countAllResults();
        $archivedCount   = $contentModel->where('status', 'Archived')->countAllResults();

        $videoCount      = $contentModel->where('type', 'Video')->countAllResults();
        $audioCount      = $contentModel->where('type', 'Audio')->countAllResults();
        $articleCount    = $contentModel->where('type', 'Artikel')->countAllResults();

        // 3. Statistik Interaksi & Komunitas
        $totalLikes    = $db->table('content_likes')->countAll();
        $totalComments = $db->table('content_comments')->countAll();
        $totalForums   = $db->table('forums')->countAll();

        // 4. Data List Terbaru
        $recentUsers    = $userModel->orderBy('created_at', 'DESC')->findAll(5);
        $recentContents = $contentModel->orderBy('created_at', 'DESC')->findAll(5);

        // 5. Data Chart (6 Bulan Terakhir)
        $months = [];
        $userMonthlyCounts = [];
        $contentMonthlyCounts = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthStart = date('Y-m-01 00:00:00', strtotime("-$i months"));
            $monthEnd   = date('Y-m-t 23:59:59', strtotime("-$i months"));
            $monthLabel = date('M Y', strtotime("-$i months"));

            $months[] = $monthLabel;

            // User count registered in this month
            $uCount = $db->table('users')
                ->where('created_at >=', $monthStart)
                ->where('created_at <=', $monthEnd)
                ->countAllResults();
            $userMonthlyCounts[] = $uCount;

            // Content count created in this month
            $cCount = $db->table('contents')
                ->where('created_at >=', $monthStart)
                ->where('created_at <=', $monthEnd)
                ->countAllResults();
            $contentMonthlyCounts[] = $cCount;
        }

        $data = [
            'stats' => [
                'total_users'     => $totalUsers,
                'verified_users'  => $verifiedUsers,
                'admin_count'     => $adminCount,
                'user_count'      => $regularUserCount,
                'total_contents'  => $totalContents,
                'published_count' => $publishedCount,
                'draft_count'     => $draftCount,
                'archived_count'  => $archivedCount,
                'video_count'     => $videoCount,
                'audio_count'     => $audioCount,
                'article_count'   => $articleCount,
                'total_likes'     => $totalLikes,
                'total_comments'  => $totalComments,
                'total_forums'    => $totalForums,
            ],
            'recentUsers'    => $recentUsers,
            'recentContents' => $recentContents,
            'chartData'      => [
                'labels'   => $months,
                'users'    => $userMonthlyCounts,
                'contents' => $contentMonthlyCounts,
                'types'    => [
                    'video'   => $videoCount,
                    'audio'   => $audioCount,
                    'article' => $articleCount
                ]
            ]
        ];

        return view('admin/dashboard-admin', $data);
    }
}