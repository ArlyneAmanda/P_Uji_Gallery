<?php
include 'config/koneksi.php';
$failed_message = "";

if (isset($_POST['btn_login'])) {
  // tampung value kedalam variabel local
  $username = $_POST['username'];
  $password = $_POST['password'];
  // cek data di tabel user berdasarkan username yang dimasukan 
  $sql = "SELECT * FROM user WHERE username = '$username'";
  // eksekusi perintah SQL
  $result = mysqli_query($link, $sql);

  // cek jumlah data apakah lebih dari 0
  if (mysqli_num_rows($result) > 0) {
    // mengambil data dari perintah yang sudah di eksekusi
    $data = mysqli_fetch_array($result);
    // mengambil data password
    $user_password = $data['password'];

    if (password_verify($password, $user_password)) {
      // NOTE agar tau siapa yang login, karena best practice nya pake id, engga pake username,
      // walaupun username nya unique
      $_SESSION["user_id"] = $data['user_id'];
      $_SESSION["username"] = $data['username'];
      $_SESSION["namalengkap"] = $data['namalengkap'];
      $_SESSION["alamat"] = $data['alamat'];
      header('location: ./home.php');
    } else {
      echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
      // header('location: ./login.php');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Login Page</title>
  <style>
    body {
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
      /* Background color for the entire page */

    }

    .login-container {
      text-align: center;
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      /* Color for the login heading */
    }

    form {
      margin-top: 10px;
    }

    input {
      width: 80%;
      padding: 10px;
      margin-bottom: 20px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #A367B1;
      /* Purple color for the login button */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #5D3587;
      /* Darker purple color on hover */
    }

    .register-link {
      display: block;
      margin-top: 10px;
      color: #A367B1;
      /* Blue color for the registration link */
      text-decoration: none;
    }

    .register-link:hover {
      text-decoration: underline;
    }

    /* Style for registration button */
    .register-button {
      background-color: #A367B1;
      /* Purple color for the login button */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }

    .register-button:hover {
      background-color: #5D3587;
      /* Darker blue color on hover */
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php
    // if ($failed_message){
    // echo "<p>".$failed_message."</p>";
    // echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
    // }
    ?>
    <!-- Form login -->
    <form method="POST">
      <!-- Your login form fields go here -->
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <br>
      <a href="index.php">Masuk tanpa Login</a> <br>
      <button type="submit" name="btn_login">Login</button>
      <a href="registrasi.php" class="register-button">Register</a>
    </form>

  </div>
</body>

</html>