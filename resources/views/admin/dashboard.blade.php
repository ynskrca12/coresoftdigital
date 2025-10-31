@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('styles')
<style>
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--gradient);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-info h3 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon.primary {
        background: var(--gradient-light);
        color: var(--primary);
    }

    .stat-icon.success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .stat-icon.warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .stat-icon.danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .stat-footer {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-change {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .stat-change.positive {
        color: var(--success);
    }

    .stat-change.negative {
        color: var(--danger);
    }

    .stat-period {
        font-size: 0.8rem;
        color: var(--gray);
    }

    /* Charts Grid */
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .chart-card {
        min-height: 350px;
    }

    .chart-container {
        height: 280px;
    }

    /* Tables */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--light);
    }

    th {
        padding: 1rem;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        color: var(--dark);
    }

    tr:hover {
        background: var(--light);
    }

    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 1;
    }

    .badge-success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .badge-warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .badge-danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .badge-primary {
        background: var(--gradient-light);
        color: var(--primary);
    }

    /* Activity Timeline */
    .activity-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--light);
    }

    .activity-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .activity-item:last-child {
        padding-bottom: 0;
    }

    .activity-dot {
        position: absolute;
        left: -1.5rem;
        top: 0.25rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary);
        border: 3px solid var(--white);
        box-shadow: 0 0 0 2px var(--light);
    }

    .activity-content {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .activity-text {
        font-size: 0.9rem;
        color: var(--dark);
    }

    .activity-time {
        font-size: 0.75rem;
        color: var(--gray);
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.5rem;
        background: var(--white);
        border: 2px dashed rgba(0, 0, 0, 0.1);
        border-radius: var(--radius);
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        color: var(--dark);
    }

    .quick-action-btn:hover {
        border-color: var(--primary);
        border-style: solid;
        background: var(--gradient-light);
        transform: translateY(-2px);
    }

    .quick-action-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.5rem;
    }

    .quick-action-text {
        font-size: 0.9rem;
        font-weight: 600;
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h1>
            <i class="fas fa-chart-line"></i>
            Dashboard
        </h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
            <i class="fas fa-chevron-right"></i>
            <span>Dashboard</span>
        </div>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline btn-sm">
            <i class="fas fa-download"></i>
            Rapor İndir
        </button>
        <button class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
            Yeni Proje
        </button>
    </div>
</div>

<!-- Welcome Alert -->
<div class="alert alert-info fade-in">
    <i class="fas fa-info-circle"></i>
    <span>Hoş geldiniz! Son giriş: <strong>Bugün, 14:30</strong></span>
</div>

<!-- Stats Cards -->
<div class="stats-grid fade-in">
    <!-- Total Projects -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-info">
                <h3>Toplam Proje</h3>
                <div class="stat-value">12</div>
            </div>
            <div class="stat-icon primary">
                <i class="fas fa-project-diagram"></i>
            </div>
        </div>
        <div class="stat-footer">
            <span class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                +2
            </span>
            <span class="stat-period">Son 30 gün</span>
        </div>
    </div>

    <!-- Total Blog Posts -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-info">
                <h3>Blog Yazıları</h3>
                <div class="stat-value">24</div>
            </div>
            <div class="stat-icon success">
                <i class="fas fa-blog"></i>
            </div>
        </div>
        <div class="stat-footer">
            <span class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                +5
            </span>
            <span class="stat-period">Son 30 gün</span>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-info">
                <h3>Müşteriler</h3>
                <div class="stat-value">8</div>
            </div>
            <div class="stat-icon warning">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
        <div class="stat-footer">
            <span class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                +1
            </span>
            <span class="stat-period">Son 30 gün</span>
        </div>
    </div>

    <!-- Pending Messages -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-info">
                <h3>Bekleyen Mesaj</h3>
                <div class="stat-value">5</div>
            </div>
            <div class="stat-icon danger">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
        <div class="stat-footer">
            <span class="stat-change negative">
                <i class="fas fa-arrow-down"></i>
                -2
            </span>
            <span class="stat-period">Son 7 gün</span>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card fade-in" style="margin-bottom: 2rem;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-bolt"></i>
            Hızlı Aksiyonlar
        </h3>
    </div>
    <div class="card-body">
        <div class="quick-actions">
            <a href="{{ route('admin.projects.create') }}" class="quick-action-btn">
                <div class="quick-action-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="quick-action-text">Yeni Proje</span>
            </a>
            <a href="{{ route('admin.blog.create') }}" class="quick-action-btn">
                <div class="quick-action-icon">
                    <i class="fas fa-pen"></i>
                </div>
                <span class="quick-action-text">Blog Yazısı</span>
            </a>
            <a href="{{ route('admin.customers.create') }}" class="quick-action-btn">
                <div class="quick-action-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <span class="quick-action-text">Müşteri Ekle</span>
            </a>
        </div>
    </div>
</div>

<!-- Recent Projects & Activity -->
<div class="charts-grid fade-in">
    <!-- Recent Projects -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-project-diagram"></i>
                Son Projeler
            </h3>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline">
                Tümünü Gör
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Proje Adı</th>
                            <th>Müşteri</th>
                            <th>Durum</th>
                            <th>Tarih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>ModaMarket E-Ticaret</strong></td>
                            <td>ModaMarket</td>
                            <td><span class="badge badge-success">Tamamlandı</span></td>
                            <td>2024</td>
                        </tr>
                        <tr>
                            <td><strong>MediCare HMS</strong></td>
                            <td>MediCare</td>
                            <td><span class="badge badge-success">Tamamlandı</span></td>
                            <td>2023</td>
                        </tr>
                        <tr>
                            <td><strong>EduLearn Platform</strong></td>
                            <td>EduLearn</td>
                            <td><span class="badge badge-warning">Devam Ediyor</span></td>
                            <td>2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-history"></i>
                Son Aktiviteler
            </h3>
        </div>
        <div class="card-body">
            <div class="activity-timeline">
                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Yeni proje eklendi:</strong> EduLearn Platform
                        </div>
                        <div class="activity-time">5 dakika önce</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Blog yazısı yayınlandı:</strong> Modern Web Teknolojileri
                        </div>
                        <div class="activity-time">2 saat önce</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Yeni müşteri eklendi:</strong> TechCorp Ltd.
                        </div>
                        <div class="activity-time">5 saat önce</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>İletişim mesajı alındı</strong>
                        </div>
                        <div class="activity-time">1 gün önce</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>Proje güncellendi:</strong> ModaMarket E-Ticaret
                        </div>
                        <div class="activity-time">2 gün önce</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Contact Messages -->
<div class="card fade-in">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-envelope"></i>
            Bekleyen Mesajlar
        </h3>
        <a href="#" class="btn btn-sm btn-outline">
            Tümünü Gör
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>İsim</th>
                        <th>Email</th>
                        <th>Konu</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Ahmet Yılmaz</strong></td>
                        <td>ahmet@example.com</td>
                        <td>Proje Teklifi</td>
                        <td>Bugün, 10:30</td>
                        <td><span class="badge badge-warning">Okunmadı</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary">Görüntüle</button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Elif Demir</strong></td>
                        <td>elif@example.com</td>
                        <td>Fiyat Bilgisi</td>
                        <td>Dün, 15:20</td>
                        <td><span class="badge badge-warning">Okunmadı</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary">Görüntüle</button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Mehmet Kaya</strong></td>
                        <td>mehmet@example.com</td>
                        <td>Destek Talebi</td>
                        <td>2 gün önce</td>
                        <td><span class="badge badge-success">Cevaplandı</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary">Görüntüle</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-refresh stats every 30 seconds
    setInterval(function() {
        // Refresh stats via AJAX
        console.log('Refreshing stats...');
    }, 30000);

    // Initialize tooltips
    document.querySelectorAll('[title]').forEach(element => {
        element.setAttribute('data-tooltip', element.getAttribute('title'));
    });
</script>
@endsection
