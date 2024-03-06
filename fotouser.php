<?php
// session_start();
// $user_id = $_SESSION["user_id"];
include 'config/koneksi.php';
$user_id = $_GET['user_id'];
$getUserPhotoSql = "SELECT * FROM foto,album,user WHERE foto.user_id=user.user_id AND foto.album_id=album.album_id AND user.user_id='$user_id'";
$resultGetUserPhoto = mysqli_query($link, $getUserPhotoSql);
$nama_user = mysqli_query($link, "SELECT * FROM user WHERE user_id='$user_id'");
$tampil_nama_user = mysqli_fetch_assoc($nama_user);
// var_dump($resultGetUserPhoto);
// die();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery - Album</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Link Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      min-height: 100vh;
    }

    header {
      background-color: #1B1A55;
      color: white;
      padding: 0;
      margin: 0;
      display: flex;
      align-items: center;
    }

    .right-content {
      background-color: #070F2B;
      color: #fff;
      padding: 20px;
      width: 300px;
    }

    .search-container {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .search-input {
      flex: 1;
      padding: 8px;
      margin-right: 8px;
      border: none;
      border-radius: 4px;
    }

    .search-button {
      padding: 8px 12px;
      background-color: #1B1A55;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <?php include 'partials/sidebar.php'; ?>
  <div class="w-100">
    <header class="p-3 d-flex justify-item-center gap-5">
      <a href="index.php" class="p=0 bg=transparent mr-2">
        <span class="text-white">&#8592;</span>
      </a>
      <?= $tampil_nama_user['username'] ?>
    </header>
    <?php
    while ($row = mysqli_fetch_array($resultGetUserPhoto)) {
      $photoId = $row['foto_id'];
      $getLikeCountSql = "SELECT * FROM likefoto WHERE likefoto.foto_id ='$photoId'";
      $likesResult = mysqli_query($link, $getLikeCountSql);
      $likeCount = mysqli_num_rows($likesResult);
    ?>
      <div class="m-2 p-2 border rounded-2">
        <div class="p-2">
          <div class="d-flex">
            <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
            <div class="d-flex justify-content-between w-100">
              <div class="ml-2">
                <b><?php echo  $row['username']; ?></b>
                <span><?php echo  $row['tanggalUnggahan']; ?></span>
                <div><?php echo  $row['deskripsiFoto']; ?></div>
              </div>
            </div>
          </div>
          <div class="mb-2 mt-2">
            <img src="assets/<?php echo  $row['lokasiFile']; ?>" class="w-100" alt="..." style="object-fit: cover; height: 500px; border-radius: 10px;">
          </div>
        </div>
        
      </div>
    <?php
    }
    ?>
  </div>





  <!-- Script Bootstrap (Popper.js, jQuery, Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>