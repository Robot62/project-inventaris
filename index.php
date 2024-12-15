<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Sistem Informasi Inventaris Perangkat Teknologi Informasi DJKI</title>

  <!-- Link to external CSS for Google Fonts and icons -->
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <style>
    body {
      font-family: 'Source Sans Pro', sans-serif;
      background-image: url('gambar/sistem/gedung-djki2.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: flex-end;
      /* Menyesuaikan posisi ke kiri */
      align-items: center;
    }

    .login-box {
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 30px 40px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      /* margin-left: 20px; */
      /* Menambahkan jarak dari sisi kiri */
      height: 100%;
      /* Memastikan kotak login memanjang secara vertikal */
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    #logo {
      background-color: #fff;
      margin: 0 10% 46px;
      padding: 0 12px;
      border-radius: 8px;
    }

    .login-box img {
      width: 100%;
    }

    .login-box h4 {
      font-weight: 700;
      font-size: 22px;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    .login-box h5 {
      font-weight: normal;
      font-size: 14px;
      margin: 0 0 32px 0;
      padding: 0;
      text-align: center;
    }

    .login-box p {
      text-align: center;
      margin-bottom: 15px;
    }

    .form-group input {
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 20px;
      padding: 15px;
      width: 100%;
    }

    .btn-primary {
      background: #fed208;
      color:rgb(9, 8, 62);
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-primary:hover {
      background: #0056b3;
    }

    .alert {
      text-align: center;
      font-size: 14px;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      color: #ccc;
    }

    @media (max-width: 600px) {
      .login-box {
        padding: 20px;
      }
    }
  </style>
</head>

<body>

  <div class="login-box">
    <div class="text-center">

      <div id="logo">
        <img src="assets/logo-web.png" class="img-fluid" alt="Logo">
      </div>

      <h4>SISTEM INFORMASI INVENTARIS</h4>
      <h5>PERANGKAT TEKNOLOGI INFORMASI</h5>

      <?php
      if (isset($_GET['alert'])) {
        if ($_GET['alert'] == "gagal") {
          echo "<div class='alert alert-danger'>Login gagal! Username atau password salah!</div>";
        } else if ($_GET['alert'] == "logout") {
          echo "<div class='alert alert-success'>Anda telah berhasil logout.</div>";
        } else if ($_GET['alert'] == "belum_login") {
          echo "<div class='alert alert-warning'>Anda harus login untuk mengakses halaman admin.</div>";
        }
      }
      ?>

      <form action="periksa_login.php" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Username" name="username" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
      </form>

      <div class="footer">
        <p>&copy; DJKI | Kementrian Hukum dan HAM R.I.</p>
      </div>
    </div>
  </div>

  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>