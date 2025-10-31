<script>
    // Sidebar Toggle Function
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');

        sidebar.classList.toggle('collapsed');

        // Save state to localStorage
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);

        // Toggle main content class
        if (mainContent) {
            if (isCollapsed) {
                mainContent.classList.add('collapsed');
            } else {
                mainContent.classList.remove('collapsed');
            }
        }
    }

    // Mobile Sidebar Toggle
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        sidebar.classList.toggle('mobile-open');
        backdrop.classList.toggle('show');
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.querySelector('.mobile-menu-toggle');

        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !mobileToggle?.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
                document.getElementById('sidebarBackdrop')?.classList.remove('show');
            }
        }
    });

    // Initialize sidebar state from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

        if (isCollapsed && window.innerWidth > 768) {
            sidebar.classList.add('collapsed');
            if (mainContent) {
                mainContent.classList.add('collapsed');
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (window.innerWidth <= 768) {
            // Mobile: remove collapsed class from main content
            if (mainContent) {
                mainContent.classList.remove('collapsed');
            }
        } else {
            // Desktop: apply correct class based on sidebar state
            const isCollapsed = sidebar.classList.contains('collapsed');
            if (mainContent) {
                if (isCollapsed) {
                    mainContent.classList.add('collapsed');
                } else {
                    mainContent.classList.remove('collapsed');
                }
            }
            // Remove mobile classes
            sidebar.classList.remove('mobile-open');
            backdrop?.classList.remove('show');
        }
    });
</script>

<style>
    /* Sidebar */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: var(--sidebar-width);
        height: 100vh;
        background: var(--dark);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed);
    }

    /* Sidebar Header */
    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: var(--header-height);
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        color: var(--white);
        overflow: hidden;
    }

    .sidebar-logo img {
        height: 35px;
        width: auto;
        flex-shrink: 0;
    }

    .sidebar-logo-text {
        font-size: 1.3rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        white-space: nowrap;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 0;
    }

    .sidebar.collapsed .sidebar-logo-text {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .sidebar-toggle {
        background: transparent;
        border: none;
        color: var(--gray-light);
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.05);
        color: var(--white);
        transform: scale(1.1);
    }

    .sidebar-toggle:active {
        transform: scale(0.95);
    }

    /* Sidebar Navigation */
    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 1rem 0;
    }

    /* Custom Scrollbar */
    .sidebar-nav::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .nav-section {
        margin-bottom: 1.5rem;
    }

    .nav-section-title {
        padding: 0.75rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .sidebar.collapsed .nav-section-title {
        opacity: 0;
        height: 0;
        padding: 0;
        margin: 0;
        visibility: hidden;
    }

    .nav-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-item {
        margin: 0.25rem 0.75rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        color: var(--gray-light);
        text-decoration: none;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
        font-size: 0.95rem;
        font-weight: 500;
        position: relative;
        overflow: visible;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
        color: var(--white);
        transform: translateX(2px);
    }

    .nav-link.active {
        background: var(--gradient-light);
        color: var(--primary-light);
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 70%;
        background: var(--gradient);
        border-radius: 0 2px 2px 0;
    }

    .nav-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .nav-text {
        flex: 1;
        white-space: nowrap;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 0;
    }

    .sidebar.collapsed .nav-text {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .nav-badge {
        padding: 0.25rem 0.5rem;
        background: var(--danger);
        color: var(--white);
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 700;
        min-width: 20px;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
    }

    .sidebar.collapsed .nav-badge {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    /* Collapsed sidebar specific styles */
    .sidebar.collapsed .nav-link {
        padding: 0.875rem;
        justify-content: center;
        gap: 0;
    }

    .sidebar.collapsed .nav-icon {
        margin: 0 auto;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        color: var(--gray-light);
        overflow: hidden;
    }

    .user-profile:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .user-info {
        flex: 1;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        min-width: 0;
    }

    .sidebar.collapsed .user-info {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .user-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--white);
        display: block;
        margin-bottom: 0.125rem;
        white-space: nowrap;
    }

    .user-role {
        font-size: 0.75rem;
        color: var(--gray);
        white-space: nowrap;
    }

    /* Tooltip for collapsed sidebar */
    .sidebar.collapsed .nav-link:hover::after {
        content: attr(title);
        position: fixed;
        left: 90px;
        padding: 0.5rem 0.75rem;
        background: var(--dark-lighter);
        color: var(--white);
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        white-space: nowrap;
        z-index: 1001;
        box-shadow: var(--shadow-md);
        pointer-events: none;
        animation: tooltipFadeIn 0.2s ease;
    }

    @keyframes tooltipFadeIn {
        from {
            opacity: 0;
            transform: translateX(-5px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Mobile Backdrop */
    .sidebar-backdrop {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    @media (max-width: 768px) {
        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.mobile-open {
            transform: translateX(0);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            width: var(--sidebar-width);
            transform: translateX(-100%);
        }

        .sidebar.collapsed.mobile-open {
            transform: translateX(0);
        }

        .sidebar-toggle {
            display: flex;
        }

        /* Show all content on mobile even when collapsed */
        .sidebar.collapsed .sidebar-logo-text,
        .sidebar.collapsed .nav-section-title,
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .nav-badge,
        .sidebar.collapsed .user-info {
            opacity: 1;
            width: auto;
            overflow: visible;
        }

        .sidebar.collapsed .nav-link {
            justify-content: flex-start;
            padding: 0.875rem 1rem;
            gap: 0.75rem;
        }

        .sidebar.collapsed .nav-icon {
            margin: 0;
        }

        /* No tooltips on mobile */
        .sidebar.collapsed .nav-link:hover::after {
            display: none;
        }
    }
</style>

<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('images/logos/coresoftdigital-blank2.png') }}" alt="CoreSoft Digital">
            <span class="sidebar-logo-text">Admin Panel</span>
        </a>
        <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <div class="nav-section">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"
                       title="Dashboard">
                        <span class="nav-icon">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Management -->
        <div class="nav-section">
            <div class="nav-section-title">İçerik Yönetimi</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}"
                       class="nav-link {{ Request::routeIs('admin.projects.*') ? 'active' : '' }}"
                       title="Projeler">
                        <span class="nav-icon">
                            <i class="fas fa-project-diagram"></i>
                        </span>
                        <span class="nav-text">Projeler</span>
                        <span class="nav-badge">12</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.blog.index') }}"
                       class="nav-link {{ Request::routeIs('admin.blog.*') ? 'active' : '' }}"
                       title="Blog">
                        <span class="nav-icon">
                            <i class="fas fa-blog"></i>
                        </span>
                        <span class="nav-text">Blog</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Customer Management -->
        <div class="nav-section">
            <div class="nav-section-title">Müşteri Yönetimi</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.customers.index') }}"
                       class="nav-link {{ Request::routeIs('admin.customers.*') ? 'active' : '' }}"
                       title="Müşteriler">
                        <span class="nav-icon">
                            <i class="fas fa-user-tie"></i>
                        </span>
                        <span class="nav-text">Müşteriler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                       class="nav-link {{ Request::routeIs('admin.contacts.*') ? 'active' : '' }}"
                       title="İletişim Mesajları">
                        <span class="nav-icon">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="nav-text">İletişim Mesajları</span>
                        <span class="nav-badge">5</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Settings -->
        <div class="nav-section">
            <div class="nav-section-title">Ayarlar</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#"
                       class="nav-link {{ Request::routeIs('admin.settings.*') ? 'active' : '' }}"
                       title="Genel Ayarlar">
                        <span class="nav-icon">
                            <i class="fas fa-cog"></i>
                        </span>
                        <span class="nav-text">Genel Ayarlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                       class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}"
                       title="Kullanıcılar">
                        <span class="nav-icon">
                            <i class="fas fa-users-cog"></i>
                        </span>
                        <span class="nav-text">Kullanıcılar</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <a href="#" class="user-profile" title="Profil">
            <div class="user-avatar">
                {{ substr(Auth::user()->name ?? 'AU', 0, 2) }}
            </div>
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name ?? 'Admin User' }}</span>
                <span class="user-role">{{ Auth::user()->role_label ?? 'Admin' }}</span>
            </div>
        </a>
    </div>
</aside>

<!-- Mobile Backdrop -->
<div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleMobileSidebar()"></div>
