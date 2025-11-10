<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Canteenly - Selamat Datang</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background:#f5f8fd; margin:0; }
    .hero { max-width:1000px; margin:60px auto; background:white; border-radius:16px; padding:40px; box-shadow:0 8px 30px rgba(0,0,0,0.06); text-align:center; }
    .hero h1 { color:#2E80FF; font-size:30px; margin-bottom:8px; }
    .hero p { color:#666; margin-bottom:18px; }
    .actions { display:flex; gap:12px; justify-content:center; }
    .btn { padding:12px 20px; border-radius:10px; text-decoration:none; font-weight:700; }
    .btn-primary { background:#2E80FF; color:white; }
    .btn-outline { background:white; color:#2E80FF; border:2px solid #e8ecf4; }
  </style>
</head>
<body>
  <div class="hero">
    <h1>Selamat datang di Canteenly</h1>
    <p>Kantin digital untuk sekolah — pesan makanan dengan cepat dan mudah.</p>

    <div class="actions">
      <a class="btn btn-primary" href="{{ route('login') }}">Masuk</a>
      <a class="btn btn-outline" href="{{ route('register') }}">Daftar</a>
    </div>

    <p style="margin-top:18px; color:#999; font-size:13px;">Atau masuk sebagai tamu untuk melihat produk</p>
  </div>
</body>
</html>