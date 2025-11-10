<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Canteenly</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #f5f8fd;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      margin: 0;
      padding: 50px 0;
    }

    .auth-container {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
      width: 400px;
      padding: 50px 40px;
      text-align: center;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .title {
      font-size: 20px;
      font-weight: 600;
      color: #2E80FF;
      margin-bottom: 5px;
    }

    .subtitle {
      color: #666;
      font-size: 14px;
      margin-bottom: 25px;
    }

    input {
      width: 100%;
      padding: 12px 14px;
      border: 2px solid #e8ecf4;
      border-radius: 10px;
      margin-bottom: 15px;
      outline: none;
      font-size: 14px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #2E80FF;
    }

    .btn-primary {
      width: 100%;
      background-color: #2E80FF;
      color: white;
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background-color: #1E60CC;
    }

    .divider {
      margin: 20px 0;
      color: #aaa;
      font-size: 14px;
      position: relative;
    }

    .divider::before,
    .divider::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 40%;
      height: 1px;
      background: #ddd;
    }

    .divider::before { left: 0; }
    .divider::after { right: 0; }

    .btn-google {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      border: 2px solid #e8ecf4;
      border-radius: 10px;
      padding: 10px;
      width: 100%;
      text-decoration: none;
      color: #444;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-google img {
      width: 22px;
      margin-right: 10px;
    }

    .btn-google:hover {
      background-color: #f5f8fd;
    }

    .bottom-text {
      margin-top: 25px;
      font-size: 14px;
      color: #333;
    }

    .bottom-text a {
      color: #2E80FF;
      font-weight: 600;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    @yield('content')
  </div>
</body>
</html>
