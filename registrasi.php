<?php

include 'config/koneksi.php';

if (isset($_POST['btn_register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $namalengkap = $_POST ['namalengkap'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $alamat = $_POST ['alamat'];

    // menambahkan data ke tabel user
    $sql = "INSERT INTO user(username,password,email,namalengkap,alamat) VALUES ('$username', '$hashed_password', '$email','$namalengkap','$alamat')";
    mysqli_query($link, $sql);
    header('location: ./login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Login Page</title>
  <style>
    body {
      height: 100vh;
      background-color: #f8f9fa;
    }

    .card-login {
      max-width: 400px;
      width: 100%;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-login .card-header {
      background-color: white;
      color: #1B1A55;
      border-radius: 15px 15px 0 0;
      text-align: center;
    }

    .card-login .card-body {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-register {
      background-color: #1B1A55;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
    }

    .btn-register:hover {
      background-color: #070F2B;
      color: white;
    }

    .forgot-password {
      text-align: right;
      color: #1B1A55;
    }
  </style>
</head>

<body class="d-flex align-items-center justify-content-center">
  <div class="container">
    <div class="card card-login">
      <div class="card-header">
        <h2 class="mb-0">Registrasi Akun</h2>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="namalengkap">Nama Lengkap</label>
            <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Masukan Nama Lengkap" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" required>
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email" required>
          </div>
          <div class="form-group">
            <label for="alamat">alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat" required>
          </div>
          <div class="form-group">
            <a href="login.php" class="forgot-password">Sudah punya akun? Login</a>
          </div>
          <button type="submit" name="btn_register" class="btn btn-register btn-block">Registrasi</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
