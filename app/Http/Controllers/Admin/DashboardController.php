<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get current user
        $user = Auth::user();

        // Get statistics
        $stats = [
            'total_projects' => $this->getTotalProjects(),
            'total_blog_posts' => $this->getTotalBlogPosts(),
            'total_customers' => $this->getTotalCustomers(),
            'pending_messages' => $this->getPendingMessages(),
            'projects_change' => '+2',
            'blog_change' => '+5',
            'customers_change' => '+1',
            'messages_change' => '-2',
        ];

        // Recent projects (dummy data for now)
        $recentProjects = [
            [
                'id' => 1,
                'name' => 'ModaMarket E-Ticaret',
                'customer' => 'ModaMarket',
                'status' => 'completed',
                'status_label' => 'Tamamlandı',
                'status_class' => 'success',
                'year' => 2024,
            ],
            [
                'id' => 2,
                'name' => 'MediCare HMS',
                'customer' => 'MediCare',
                'status' => 'completed',
                'status_label' => 'Tamamlandı',
                'status_class' => 'success',
                'year' => 2023,
            ],
            [
                'id' => 3,
                'name' => 'EduLearn Platform',
                'customer' => 'EduLearn',
                'status' => 'in_progress',
                'status_label' => 'Devam Ediyor',
                'status_class' => 'warning',
                'year' => 2025,
            ],
        ];

        // Recent activities
        $recentActivities = [
            [
                'icon' => 'fa-project-diagram',
                'message' => 'Yeni proje eklendi: EduLearn Platform',
                'time' => '5 dakika önce',
                'type' => 'project',
            ],
            [
                'icon' => 'fa-blog',
                'message' => 'Blog yazısı yayınlandı: Modern Web Teknolojileri',
                'time' => '2 saat önce',
                'type' => 'blog',
            ],
            [
                'icon' => 'fa-user-tie',
                'message' => 'Yeni müşteri eklendi: TechCorp Ltd.',
                'time' => '5 saat önce',
                'type' => 'customer',
            ],
            [
                'icon' => 'fa-envelope',
                'message' => 'İletişim mesajı alındı',
                'time' => '1 gün önce',
                'type' => 'contact',
            ],
            [
                'icon' => 'fa-edit',
                'message' => 'Proje güncellendi: ModaMarket E-Ticaret',
                'time' => '2 gün önce',
                'type' => 'project',
            ],
        ];

        // Pending contact messages (dummy data)
        $pendingMessages = [
            [
                'id' => 1,
                'name' => 'Ahmet Yılmaz',
                'email' => 'ahmet@example.com',
                'subject' => 'Proje Teklifi',
                'message' => 'Merhaba, bir e-ticaret projesi için teklif almak istiyorum...',
                'date' => 'Bugün, 10:30',
                'status' => 'unread',
                'status_label' => 'Okunmadı',
                'status_class' => 'warning',
            ],
            [
                'id' => 2,
                'name' => 'Elif Demir',
                'email' => 'elif@example.com',
                'subject' => 'Fiyat Bilgisi',
                'message' => 'İyi günler, web sitesi geliştirme için fiyat bilgisi alabilir miyim?',
                'date' => 'Dün, 15:20',
                'status' => 'unread',
                'status_label' => 'Okunmadı',
                'status_class' => 'warning',
            ],
            [
                'id' => 3,
                'name' => 'Mehmet Kaya',
                'email' => 'mehmet@example.com',
                'subject' => 'Destek Talebi',
                'message' => 'Projem ile ilgili bir sorun var, yardımcı olabilir misiniz?',
                'date' => '2 gün önce',
                'status' => 'replied',
                'status_label' => 'Cevaplandı',
                'status_class' => 'success',
            ],
        ];

        return view('admin.dashboard', compact(
            'user',
            'stats',
            'recentProjects',
            'recentActivities',
            'pendingMessages'
        ));
    }

    /**
     * Get total projects count
     */
    private function getTotalProjects()
    {
        // In real app: return Project::count();
        return 12;
    }

    /**
     * Get total blog posts count
     */
    private function getTotalBlogPosts()
    {
        // In real app: return Blog::count();
        return 24;
    }

    /**
     * Get total customers count
     */
    private function getTotalCustomers()
    {
        // In real app: return Customer::count();
        return 8;
    }

    /**
     * Get pending messages count
     */
    private function getPendingMessages()
    {
        // In real app: return ContactMessage::where('status', 'unread')->count();
        return 5;
    }

    /**
     * Display analytics page.
     */
    public function analytics()
    {
        return view('admin.analytics.index');
    }

    /**
     * Export analytics data.
     */
    public function exportAnalytics(Request $request)
    {
        // Export analytics logic
        $filename = 'analytics-' . date('Y-m-d') . '.pdf';

        // In real app: generate PDF and return download
        return response()->download(storage_path('app/exports/' . $filename));
    }

    /**
     * Display activity log.
     */
    public function activityLog()
    {
        // In real app: fetch from activity log table
        $activities = [];

        return view('admin.activity-log.index', compact('activities'));
    }
}
