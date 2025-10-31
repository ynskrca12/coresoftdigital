<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - CoreSoft Digital</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/coresoftdigitalfavicon.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Colors */
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #7c3aed;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;

            /* Neutrals */
            --dark: #0f172a;
            --dark-light: #1e293b;
            --dark-lighter: #334155;
            --gray: #64748b;
            --gray-light: #94a3b8;
            --light: #f8fafc;
            --white: #ffffff;

            /* Sidebar */
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;

            /* Gradients */
            --gradient: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            --gradient-light: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);

            /* Border Radius */
            --radius-sm: 6px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Layout Container */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed);
        }

        /* Content Wrapper */
        .content-wrapper {
            padding: 2rem;
            margin-top: var(--header-height);
            max-width: 1600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .page-title h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-title .breadcrumb {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .page-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-primary {
            background: var(--gradient);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: var(--dark-light);
            color: var(--white);
        }

        .btn-secondary:hover:not(:disabled) {
            background: var(--dark-lighter);
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }

        .btn-success:hover:not(:disabled) {
            background: #059669;
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover:not(:disabled) {
            background: #dc2626;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover:not(:disabled) {
            background: var(--primary);
            color: var(--white);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .btn-lg {
            padding: 0.875rem 1.75rem;
            font-size: 1rem;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-left: 4px solid var(--success);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border-left: 4px solid var(--warning);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border-left: 4px solid var(--danger);
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
            border-left: 4px solid var(--info);
        }

        /* Loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-overlay.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(37, 99, 235, 0.1);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-content {
                margin-left: var(--sidebar-collapsed);
            }

            .content-wrapper {
                padding: 1.5rem;
            }

            .page-title h1 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .content-wrapper {
                padding: 1rem;
                margin-top: 60px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-actions {
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-light);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray);
        }
    </style>

    @yield('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Header -->
            @include('admin.layouts.header')

            <!-- Content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Scripts -->
    <script>
        // Loading Overlay Functions
        function showLoading() {
            document.getElementById('loading-overlay').classList.add('active');
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.remove('active');
        }
    </script>

    @yield('scripts')
</body>
</html>
