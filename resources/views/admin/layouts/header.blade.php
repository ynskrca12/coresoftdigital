<style>
    /* Header */
    .admin-header {
        position: fixed;
        top: 0;
        left: var(--sidebar-width);
        right: 0;
        height: var(--header-height);
        background: var(--white);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        z-index: 999;
        transition: left 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .main-content.expanded .admin-header {
        left: var(--sidebar-collapsed);
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        background: transparent;
        border: none;
        font-size: 1.5rem;
        color: var(--dark);
        cursor: pointer;
        padding: 0.5rem;
    }

    /* Search Bar */
    .header-search {
        flex: 1;
        max-width: 500px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 2px solid rgba(0, 0, 0, 0.05);
        border-radius: var(--radius-sm);
        font-size: 0.9rem;
        background: var(--light);
        transition: all 0.2s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        pointer-events: none;
    }

    /* Header Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .header-action {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        background: transparent;
        border: none;
        cursor: pointer;
        color: var(--gray);
        transition: all 0.2s ease;
        font-size: 1.1rem;
    }

    .header-action:hover {
        background: var(--light);
        color: var(--dark);
    }

    .header-action.active {
        background: var(--primary);
        color: var(--white);
    }

    /* Notification Badge */
    .notification-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 8px;
        height: 8px;
        background: var(--danger);
        border-radius: 50%;
        border: 2px solid var(--white);
    }

    .notification-count {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 18px;
        height: 18px;
        background: var(--danger);
        color: var(--white);
        border-radius: 9px;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
    }

    /* User Menu */
    .user-menu {
        position: relative;
    }

    .user-menu-toggle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        border-radius: var(--radius-sm);
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .user-menu-toggle:hover {
        background: var(--light);
    }

    .user-menu-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 700;
        font-size: 0.9rem;
    }

    .user-menu-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .user-menu-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark);
        line-height: 1.2;
    }

    .user-menu-role {
        font-size: 0.75rem;
        color: var(--gray);
    }

    .user-menu-dropdown {
        position: absolute;
        top: calc(100% + 0.5rem);
        right: 0;
        min-width: 220px;
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(0, 0, 0, 0.05);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        z-index: 1000;
    }

    .user-menu.active .user-menu-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .dropdown-user-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .dropdown-user-email {
        font-size: 0.8rem;
        color: var(--gray);
    }

    .dropdown-menu {
        padding: 0.5rem;
        list-style: none;
    }

    .dropdown-item {
        margin: 0.125rem 0;
    }

    .dropdown-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: var(--dark);
        text-decoration: none;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .dropdown-link:hover {
        background: var(--light);
    }

    .dropdown-link i {
        width: 20px;
        color: var(--gray);
    }

    .dropdown-divider {
        height: 1px;
        background: rgba(0, 0, 0, 0.05);
        margin: 0.5rem 0;
    }

    .dropdown-link.danger {
        color: var(--danger);
    }

    .dropdown-link.danger:hover {
        background: rgba(239, 68, 68, 0.1);
    }

    /* Notification Dropdown */
    .notification-dropdown {
        position: absolute;
        top: calc(100% + 0.5rem);
        right: 0;
        width: 360px;
        max-height: 500px;
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(0, 0, 0, 0.05);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .notification-dropdown.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .notification-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .notification-list {
        flex: 1;
        overflow-y: auto;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .notification-item {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .notification-item:hover {
        background: var(--light);
    }

    .notification-item.unread {
        background: rgba(37, 99, 235, 0.05);
    }

    .notification-content {
        display: flex;
        gap: 1rem;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--gradient-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
    }

    .notification-text {
        flex: 1;
    }

    .notification-message {
        font-size: 0.9rem;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .notification-time {
        font-size: 0.75rem;
        color: var(--gray);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .admin-header {
            left: var(--sidebar-collapsed);
        }
    }

    @media (max-width: 768px) {
        .admin-header {
            left: 0;
            padding: 0 1rem;
        }

        .mobile-menu-btn {
            display: block;
        }

        .header-search {
            display: none;
        }

        .user-menu-info {
            display: none;
        }

        .notification-dropdown,
        .user-menu-dropdown {
            right: -1rem;
            width: calc(100vw - 2rem);
            max-width: 360px;
        }
    }
</style>

<header class="admin-header">
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Menü">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Search Bar -->
    <div class="header-search">

    </div>

    <!-- Header Actions -->
    <div class="header-actions">
        <!-- Quick Add -->
        <button class="header-action" title="Hızlı Ekle">
            <i class="fas fa-plus"></i>
        </button>

        <!-- Notifications -->
        <div class="header-action" style="position: relative;" onclick="toggleNotifications()">
            <i class="fas fa-bell"></i>
            <span class="notification-count">5</span>

            <!-- Notification Dropdown -->
            <div class="notification-dropdown" id="notification-dropdown">
                <div class="notification-header">
                    <span class="notification-title">Bildirimler</span>
                    <a href="#" style="font-size: 0.8rem; color: var(--primary); text-decoration: none;">
                        Tümünü Oku
                    </a>
                </div>
                <ul class="notification-list">
                    <li class="notification-item unread">
                        <div class="notification-content">
                            <div class="notification-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="notification-text">
                                <div class="notification-message">Yeni iletişim mesajı alındı</div>
                                <div class="notification-time">5 dakika önce</div>
                            </div>
                        </div>
                    </li>
                    <li class="notification-item unread">
                        <div class="notification-content">
                            <div class="notification-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <div class="notification-text">
                                <div class="notification-message">Yeni proje oluşturuldu</div>
                                <div class="notification-time">1 saat önce</div>
                            </div>
                        </div>
                    </li>
                    <li class="notification-item">
                        <div class="notification-content">
                            <div class="notification-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="notification-text">
                                <div class="notification-message">Yeni müşteri kaydı</div>
                                <div class="notification-time">3 saat önce</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Settings -->
        <button class="header-action" title="Ayarlar">
            <i class="fas fa-cog"></i>
        </button>

        <!-- User Menu -->
        <div class="user-menu" onclick="toggleUserMenu()">
            <button class="user-menu-toggle">
                <div class="user-menu-avatar">AY</div>
                <div class="user-menu-info">
                    <span class="user-menu-name">Admin User</span>
                    <span class="user-menu-role">Süper Admin</span>
                </div>
                <i class="fas fa-chevron-down" style="color: var(--gray); font-size: 0.8rem;"></i>
            </button>

            <!-- User Dropdown -->
            <div class="user-menu-dropdown" id="user-menu-dropdown">
                <div class="dropdown-header">
                    <div class="dropdown-user-name">Admin User</div>
                    <div class="dropdown-user-email">admin@coresoftdigital.com</div>
                </div>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <a href="#" class="dropdown-link">
                            <i class="fas fa-user"></i>
                            Profilim
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="#" class="dropdown-link">
                            <i class="fas fa-cog"></i>
                            Ayarlar
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="#" class="dropdown-link">
                            <i class="fas fa-question-circle"></i>
                            Yardım
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="dropdown-item">
                        <a href="{{ route('home') }}" class="dropdown-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            Siteyi Görüntüle
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="dropdown-item">
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-link danger" style="width: 100%; background: none;">
                                <i class="fas fa-sign-out-alt"></i>
                                Çıkış Yap
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    // Toggle User Menu
    function toggleUserMenu() {
        const menu = document.querySelector('.user-menu');
        menu.classList.toggle('active');

        // Close notification if open
        document.getElementById('notification-dropdown').classList.remove('active');
    }

    // Toggle Notifications
    function toggleNotifications() {
        const dropdown = document.getElementById('notification-dropdown');
        dropdown.classList.toggle('active');

        // Close user menu if open
        document.querySelector('.user-menu').classList.remove('active');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.user-menu')) {
            document.querySelector('.user-menu').classList.remove('active');
        }
        if (!event.target.closest('.header-action') || !event.target.closest('[onclick="toggleNotifications()"]')) {
            document.getElementById('notification-dropdown').classList.remove('active');
        }
    });
</script>
