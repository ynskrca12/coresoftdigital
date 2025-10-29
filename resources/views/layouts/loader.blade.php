<style>
    /* Page Loader */
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .page-loader.hidden {
        opacity: 0;
        visibility: hidden;
    }

    .loader-content {
        text-align: center;
    }

    .loader-logo {
        font-size: 3rem;
        font-weight: 800;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 2rem;
        animation: pulse 1.5s ease-in-out infinite;
    }

    .spinner {
        width: 60px;
        height: 60px;
        border: 4px solid rgba(37, 99, 235, 0.2);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .loader-text {
        margin-top: 1.5rem;
        color: rgba(248, 250, 252, 0.7);
        font-size: 1rem;
        animation: pulse 1.5s ease-in-out infinite;
    }
    .loader-logo img {
        height: 35px;
        width: auto;
        transition: all 0.3s ease;
    }
</style>

<div class="page-loader" id="pageLoader">
    <div class="loader-content">
        <div class="loader-logo">
            <img src="{{ asset('/public/images/logos/coresoftdigital-blank2.png') }}" alt="CoreSoft Digital Logo">
            <span class="logo-text">CoreSoft Digital</span>
        </div>
        <div class="spinner"></div>
        <div class="loader-text">Yükleniyor...</div>
    </div>
</div>

<script>
    // Hide loader when page is fully loaded
    window.addEventListener('load', function() {
        const loader = document.getElementById('pageLoader');
        setTimeout(() => {
            loader.classList.add('hidden');
            // Remove from DOM after animation
            setTimeout(() => {
                loader.remove();
            }, 500);
        }, 500);
    });
</script>
