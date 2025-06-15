<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Toko Kue</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #ffffff 0%, #fdf2f8 100%);
            box-shadow: 2px 0 15px rgba(236, 72, 153, 0.1);
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid #fce7f3;
            text-align: center;
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
            margin-bottom: 10px;
        }

        .sidebar-header h2 {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-header h2 {
            font-size: 0;
        }

        .sidebar-header .cake-icon {
            font-size: 2rem;
            color: white;
            margin-bottom: 8px;
            display: block;
        }

        .toggle-btn {
            position: absolute;
            top: 20px;
            right: -15px;
            background: #ec4899;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 10px rgba(236, 72, 153, 0.3);
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background: #db2777;
            transform: scale(1.1);
        }

        .nav-menu {
            padding: 0;
            list-style: none;
        }

        .nav-item {
            margin: 5px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #6b7280;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
            color: #ec4899;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-link {
            padding: 15px;
            justify-content: center;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #fdf2f8 0%, #ffffff 100%);
        }

        .sidebar.collapsed+.main-content {
            margin-left: 70px;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(236, 72, 153, 0.1);
            display: flex;
            justify-content: between;
            align-items: center;
            border-left: 4px solid #ec4899;
        }

        .welcome-text {
            flex: 1;
        }

        .welcome-text h1 {
            color: #374151;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .welcome-text p {
            color: #6b7280;
            font-size: 1rem;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #db2777 0%, #ec4899 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);
        }

        .content-area {
            padding: 30px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .dashboard-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(236, 72, 153, 0.1);
            border: 1px solid #fce7f3;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(236, 72, 153, 0.15);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .card-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .card-description {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .top-bar {
                padding: 15px 20px;
            }

            .welcome-text h1 {
                font-size: 1.4rem;
            }

            .content-area {
                padding: 20px;
            }
        }

        /* Scrollbar Custom */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #fdf2f8;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #ec4899;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #db2777;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-chevron-left" id="toggle-icon"></i>
            </button>

            <div class="sidebar-header">
                <i class="fas fa-birthday-cake cake-icon"></i>
                <h2>Sweet Bakery</h2>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active" onclick="setActive(this)">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-birthday-cake"></i>
                        <span>Data Kue</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tambah Kue</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-users"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-chart-bar"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-tags"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <i class="fas fa-cogs"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="welcome-text">
                    <h1>Selamat Datang, Admin!</h1>
                    <p>Kelola toko kue Anda dengan mudah dan efisien</p>
                </div>
                <form method="POST" action="#" style="display: inline;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <div class="dashboard-cards">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <div class="card-title">Total Kue</div>
                        <div class="card-description">Kelola semua produk kue yang tersedia di toko Anda</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-title">Pesanan Hari Ini</div>
                        <div class="card-description">Pantau pesanan yang masuk hari ini</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-title">Total Pelanggan</div>
                        <div class="card-description">Lihat data pelanggan yang terdaftar</div>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-title">Penjualan</div>
                        <div class="card-description">Analisis penjualan dan revenue toko</div>
                    </div>
                </div>

                <!-- Content will be loaded here based on navigation -->
                <div id="dynamic-content">
                    <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 20px rgba(236, 72, 153, 0.1);">
                        <h2 style="color: #374151; margin-bottom: 20px; font-size: 1.5rem;">Dashboard Utama</h2>
                        <p style="color: #6b7280; line-height: 1.6;">
                            Selamat datang di panel admin toko kue! Dari sini Anda dapat mengelola semua aspek toko kue Anda,
                            mulai dari menambah produk kue baru, mengelola pesanan pelanggan, hingga melihat laporan penjualan.
                        </p>
                        <br>
                        <p style="color: #6b7280; line-height: 1.6;">
                            Gunakan menu navigasi di sebelah kiri untuk mengakses fitur-fitur yang tersedia.
                            Dashboard ini dirancang untuk memberikan pengalaman yang mudah dan menyenangkan dalam mengelola bisnis kue Anda.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');

            sidebar.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }
        }

        function setActive(element) {
            // Remove active class from all nav links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => link.classList.remove('active'));

            // Add active class to clicked element
            element.classList.add('active');

            // You can add logic here to load different content based on the clicked menu
            const menuText = element.querySelector('span').textContent;
            console.log('Menu clicked:', menuText);
        }

        // Auto-collapse sidebar on mobile
        function checkScreenSize() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');

            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            }
        }

        // Check screen size on load and resize
        window.addEventListener('load', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);
    </script>
</body>

</html>