<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteenly - Sistem Kantin Digital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f8fd 0%, #e8f2f5 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 20px 50px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(46, 128, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #2E80FF;
            font-size: 24px;
            font-weight: 700;
        }

        .logo img {
            width: 50px;
            height: 50px;
            border: 2px solid #2E80FF;
            border-radius: 50%;
            padding: 5px;
            background-color: white;
        }

        .logo span {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #2E80FF;
            font-weight: 700;
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-login {
            background: transparent;
            color: #2E80FF;
            border-color: #2E80FF;
        }

        .btn-login:hover {
            background: #2E80FF;
            color: white;
        }

        .btn-register {
            background: #2E80FF;
            color: white;
        }

        .btn-register:hover {
            background: #1E60CC;
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 100px 50px 50px;
        }

        .hero-section {
            text-align: center;
            color: #333;
            max-width: 800px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #2E80FF, #1E60CC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-description {
            font-size: 1.1rem;
            margin-bottom: 40px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta {
            padding: 15px 35px;
            font-size: 1.1rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: #2E80FF;
            color: white;
            box-shadow: 0 8px 25px rgba(46, 128, 255, 0.3);
        }

        .btn-primary:hover {
            background: #1E60CC;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(46, 128, 255, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #2E80FF;
            border: 2px solid #2E80FF;
        }

        .btn-secondary:hover {
            background: #2E80FF;
            color: white;
            transform: translateY(-3px);
        }

        /* Features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 80px;
            padding: 0 20px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: #2E80FF;
            background: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: white;
        }

        .feature-desc {
            opacity: 0.8;
            line-height: 1.5;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-element:nth-child(4) {
            top: 40%;
            right: 20%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Product Categories */
        .products-section {
            margin-top: 100px;
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2E80FF;
            margin-bottom: 50px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        .product-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 30px 20px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(46, 128, 255, 0.1);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(46, 128, 255, 0.1);
        }

        .product-card:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 25px rgba(46, 128, 255, 0.15);
        }

        .product-icon {
            font-size: 4rem;
            color: #2E80FF;
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2E80FF;
            margin-bottom: 10px;
        }

        .product-desc {
            opacity: 0.8;
            font-size: 0.9rem;
        }

        /* Testimonials */
        .testimonials-section {
            margin-top: 100px;
            text-align: center;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        @media (max-width: 1024px) {
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .testimonials-grid {
                grid-template-columns: 1fr;
            }
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            padding: 30px 25px;
            border-radius: 20px;
            border: 1px solid rgba(46, 128, 255, 0.15);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(46, 128, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .testimonial-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2E80FF, #1E60CC);
        }

        .testimonial-card:hover {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 25px rgba(46, 128, 255, 0.15);
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 15px;
            border: 3px solid #2E80FF;
            box-shadow: 0 5px 15px rgba(46, 128, 255, 0.2);
            overflow: hidden;
        }

        .testimonial-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            opacity: 0.85;
            line-height: 1.6;
            font-size: 1rem;
            color: #444;
            position: relative;
        }

        .testimonial-text::before {
            content: '"';
            font-size: 3rem;
            color: #2E80FF;
            opacity: 0.3;
            position: absolute;
            top: -15px;
            left: -10px;
            font-family: serif;
        }

        .testimonial-author {
            font-weight: 700;
            color: #2E80FF;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .testimonial-role {
            font-size: 0.9rem;
            opacity: 0.7;
            color: #666;
            font-weight: 500;
        }

        /* Enhanced Features */
        .enhanced-features {
            margin-top: 100px;
        }

        .enhanced-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        @media (max-width: 1024px) {
            .enhanced-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .enhanced-grid {
                grid-template-columns: 1fr;
            }
        }

        .enhanced-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(46, 128, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(46, 128, 255, 0.1);
        }

        .enhanced-card:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 25px rgba(46, 128, 255, 0.15);
        }

        .enhanced-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2E80FF, #1E60CC);
        }

        .enhanced-icon {
            font-size: 3.5rem;
            color: #2E80FF;
            background: white;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(46, 128, 255, 0.2);
        }

        .enhanced-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2E80FF;
        }

        .enhanced-desc {
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .enhanced-list {
            list-style: none;
            text-align: left;
        }

        .enhanced-list li {
            padding: 5px 0;
            opacity: 0.8;
            position: relative;
            padding-left: 20px;
        }

        .enhanced-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #2E80FF;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .main-content {
                padding: 80px 20px 30px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-cta {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .features {
                grid-template-columns: 1fr;
                margin-top: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Elements -->
    <div class="floating-element">
        <i class="fas fa-wine-bottle" style="font-size: 100px;"></i>
    </div>
    <div class="floating-element">
        <i class="fas fa-cookie-bite" style="font-size: 80px;"></i>
    </div>
    <div class="floating-element">
        <i class="fas fa-pen" style="font-size: 90px;"></i>
    </div>
    <div class="floating-element">
        <i class="fas fa-pills" style="font-size: 110px;"></i>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Canteenly Logo">
            <span>Canteenly</span>
        </div>
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </a>
            <a href="{{ route('register') }}" class="btn btn-register">
                <i class="fas fa-user-plus"></i> Daftar
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="hero-section">
            <h1 class="hero-title">Canteenly</h1>
            <p class="hero-subtitle">Sistem Kantin Digital Terdepan</p>
            <p class="hero-description">
                Nikmati kemudahan berbelanja di kantin sekolah dengan sistem digital yang modern. 
                Pesan makanan, minuman, dan kebutuhan sekolah dengan mudah dan praktis!
            </p>
            
            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn-cta btn-primary">
                    <i class="fas fa-rocket"></i>
                    Mulai Sekarang
                </a>
            </div>

            <!-- Product Categories -->
            <div class="products-section">
                <h2 class="section-title">Kategori Produk</h2>
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-wine-bottle"></i>
                        </div>
                        <h3 class="product-name">Minuman Kemasan</h3>
                        <p class="product-desc">Teh Botol, Air Mineral, Coca Cola, Jus Buavita</p>
                    </div>

                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-cookie-bite"></i>
                        </div>
                        <h3 class="product-name">Makanan Kemasan</h3>
                        <p class="product-desc">Roti, Qtela, Chitato, Indomie Goreng</p>
                    </div>

                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-pen"></i>
                        </div>
                        <h3 class="product-name">ATK</h3>
                        <p class="product-desc">Pensil, Pulpen, Buku Tulis, Penghapus</p>
                    </div>

                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h3 class="product-name">Obat</h3>
                        <p class="product-desc">Paracetamol, Vitamin C, Antangin, Betadine</p>
                    </div>
                </div>
            </div>

            <!-- Enhanced Features -->
            <div class="enhanced-features">
                <h2 class="section-title">Fitur Unggulan</h2>
                <div class="enhanced-grid">
                    <div class="enhanced-card">
                        <div class="enhanced-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="enhanced-title">Mudah Digunakan</h3>
                        <p class="enhanced-desc">Interface yang user-friendly dan mudah dipahami</p>
                        <ul class="enhanced-list">
                            <li>Desain intuitif dan modern</li>
                            <li>Navigasi yang sederhana</li>
                            <li>Cocok untuk semua usia</li>
                        </ul>
                    </div>

                    <div class="enhanced-card">
                        <div class="enhanced-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="enhanced-title">Hemat Waktu</h3>
                        <p class="enhanced-desc">Pesan dari kelas, ambil saat istirahat</p>
                        <ul class="enhanced-list">
                            <li>Tidak perlu antri panjang</li>
                            <li>Pre-order dari kelas</li>
                            <li>Notifikasi pesanan siap</li>
                        </ul>
                    </div>

                    <div class="enhanced-card">
                        <div class="enhanced-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="enhanced-title">Aman & Terpercaya</h3>
                        <p class="enhanced-desc">Sistem pembayaran digital yang aman</p>
                        <ul class="enhanced-list">
                            <li>Multiple payment methods</li>
                            <li>Data terenkripsi</li>
                            <li>Transaksi terjamin</li>
                        </ul>
                    </div>

                    <div class="enhanced-card">
                        <div class="enhanced-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="enhanced-title">Tracking Pesanan</h3>
                        <p class="enhanced-desc">Pantau status pesanan real-time</p>
                        <ul class="enhanced-list">
                            <li>Status pesanan live</li>
                            <li>History pembelian</li>
                            <li>Estimasi waktu siap</li>
                        </ul>
                    </div>

                    <div class="enhanced-card">
                        <div class="enhanced-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="enhanced-title">Multi User</h3>
                        <p class="enhanced-desc">Untuk siswa, guru, dan staf</p>
                        <ul class="enhanced-list">
                            <li>Role-based access</li>
                            <li>Personal dashboard</li>
                            <li>Custom preferences</li>
                        </ul>
                    </div>

                    <div class="enhanced-card">
                        <div class="enhanced-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="enhanced-title">Customer Support</h3>
                        <p class="enhanced-desc">Bantuan 24/7 untuk pengguna</p>
                        <ul class="enhanced-list">
                            <li>Live chat support</li>
                            <li>FAQ lengkap</li>
                            <li>Response cepat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Testimonials -->
            <div class="testimonials-section">
                <h2 class="section-title">Testimoni Pengguna</h2>
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('assets/img/testimonials/rafi.jpeg') }}" alt="Rafi Pratama">
                        </div>
                        <p class="testimonial-text">Canteenly sangat membantu! Sekarang saya bisa pesan makanan dari kelas tanpa harus antri panjang di kantin.</p>
                        <div class="testimonial-author">Rafi Pratama</div>
                        <div class="testimonial-role">Siswa 12 RPL 2</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('assets/img/testimonials/alya.jpeg') }}" alt="Alya Sari">
                        </div>
                        <p class="testimonial-text">Interface-nya mudah dipahami dan pembayaran digitalnya sangat praktis. Recommended banget!</p>
                        <div class="testimonial-author">Alya Sari</div>
                        <div class="testimonial-role">Siswa 12 RPL 1</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('assets/img/testimonials/joko.jpeg') }}" alt="Pak Joko Widodo">
                        </div>
                        <p class="testimonial-text">Sebagai guru, saya terbantu dengan sistem pre-order ini. Bisa pesan dari ruang guru langsung.</p>
                        <div class="testimonial-author">Pak Joko Widodo</div>
                        <div class="testimonial-role">Guru Matematika</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('assets/img/testimonials/sari.jpeg') }}" alt="Bu Sari Dewi">
                        </div>
                        <p class="testimonial-text">Fitur tracking pesanan sangat membantu. Saya tahu kapan pesanan siap diambil.</p>
                        <div class="testimonial-author">Bu Sari Dewi</div>
                        <div class="testimonial-role">Guru Bahasa Indonesia</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('assets/img/testimonials/rina.jpeg') }}" alt="Bu Rina Sari">
                        </div>
                        <p class="testimonial-text">Sistem pembayaran yang beragam membuat transaksi jadi lebih fleksibel dan mudah.</p>
                        <div class="testimonial-author">Bu Rina Sari</div>
                        <div class="testimonial-role">Staf Tata Usaha</div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <img src="{{ asset('assets/img/testimonials/bambang.jpeg') }}" alt="Pak Bambang">
                        </div>
                        <p class="testimonial-text">Aplikasi yang sangat memudahkan dalam mengelola pesanan kantin. Fitur-fiturnya lengkap dan mudah digunakan.</p>
                        <div class="testimonial-author">Pak Bambang</div>
                        <div class="testimonial-role">Staf Perpustakaan</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>