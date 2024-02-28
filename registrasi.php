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
  <link rel="stylesheet" href="styles.css">
  <title>Registration Page</title>
  <style>
    body {
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0; /* Background color for the entire page */
    }

    .registration-container {
      text-align: center;
      background-color: white;
      padding: 80px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333; /* Color for the registration heading */
    }

    form {
      margin-top: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input {
      width: 150%;
      padding: 10px;
      margin-bottom: 20px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #A367B1; /* Purple color for the registration button */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #5D3587; /* Darker purple color on hover */
    }

    /* Style for login link */
    .login-link {
      display: block;
      margin-top: 10px;
      color: #A367B1; /* Purple color for the login link */
      text-decoration: none;
    }

    .login-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="registration-container">
    <h2>Registrasi Akun</h2>
    <!-- Registration form -->
    <form method="POST">
      <!-- Registration form fields go here -->
      <input type="text" name="namalengkap" placeholder="Full Name" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="alamat" placeholder="Alamat" required>
      <br>
      <button type="submit" name="btn_register">Register</button>
      <!-- Link to login page with styled button -->
      <a href="login.php" class="login-link">Sudah Punya Akun? Login</a>
    </form>
  </div>
</body>
</html>
