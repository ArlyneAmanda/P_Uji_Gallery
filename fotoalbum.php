<?php 
// session_start();
// $user_id = $_SESSION["user_id"];
include 'config/koneksi.php';
$getUserPhotoSql = "SELECT * FROM foto INNER JOIN user ON user.user_id = foto.user_id LEFT JOIN likefoto ON likefoto.foto_id = foto.foto_id LEFT JOIN komentarfoto ON komentarfoto.foto_id = foto.foto_id";
$resultGetUserPhoto = mysqli_query($link, $getUserPhotoSql);
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
        <a href="profile.php" class="p=0 bg=transparent mr-2">
          <span class="text-white">&#8592;</span>
        </a>
        Album 1
      </header>
      <?php
        while ($row = mysqli_fetch_array($resultGetUserPhoto))  {
          $photoId = $row['foto_id'];
          $getLikeCountSql = "SELECT * FROM likefoto WHERE likefoto.foto_id ='$photoId'";
          $likesResult = mysqli_query($link, $getLikeCountSql);
          $likeCount = mysqli_num_rows($likesResult);
      ?>
      <div class="m-2 p-2 border rounded-2">
        <div class="p-2">
          <div class="d-flex">
            <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
            <div class="ml-2">
                <b><?php echo  $row['username']; ?></b>
                <span><?php echo  $row['tanggalUnggahan']; ?></span>
                <div><?php echo  $row['deskripsiFoto']; ?></div>
            </div>
          </div>
          <div class="mb-2 mt-2">
            <img src="assets/<?php echo  $row['lokasiFile']; ?>" class="w-100" alt="..." style="object-fit: cover; height: 500px; border-radius: 10px;">
          </div>
        </div>
        <div class="action-buttons mb-4 mt-1 " style="">
          <button class="btn btn-outline-danger"><i class="fas fa-heart"></i> Like</button>
          <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal"><i class="fas fa-comment"></i> Comment</button>
          <div class="like-count mt-1 d-flex" style="border-bottom: 2px solid #ccc;"><?php echo $likeCount ?> likes
            <!-- Tambahkan tautan untuk mengedit album -->
            <a href="edit_album.php?id=<?= $itemAlbum['album_id'] ?>" class="text-primary mr-3 ml-auto mb-2" style="font-size: 20px;">
              <i class="fas fa-edit"></i>
            </a>
            <!-- Tambahkan tautan dan tombol untuk menghapus album -->
            <a href="hapus_album.php?id=<?= $itemAlbum['album_id'] ?>" class="text-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')" style="font-size: 20px;">
              <i class="fas fa-trash"></i>
            </a>
          </div>
          <?php include 'partials/comment.php'; ?>
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