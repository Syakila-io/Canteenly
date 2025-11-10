<style>
  /* === LOGO STYLE (FINAL) === */
  .logo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 10px 0;
    margin-bottom: 25px;
  }

  .logo img {
    width: 60px;
    height: 60px;
    border: 3px solid #2E80FF; /* garis biru */
    border-radius: 50%; /* bentuk bulat */
    background-color: #fff; /* putih di dalam */
    padding: 6px;
    box-shadow: 0 4px 10px rgba(46, 128, 255, 0.15);
    transition: all 0.3s ease;
  }

  .logo img:hover {
    transform: scale(1.06);
    box-shadow: 0 6px 14px rgba(46, 128, 255, 0.25);
  }

  .logo h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: #2E80FF;
    margin: 0;
    letter-spacing: 0.3px;
  }
</style>

<div class="logo">
  <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Canteenly">
  <h2>Canteenly</h2>
</div>
