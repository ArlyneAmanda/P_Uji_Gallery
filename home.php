<?php
include 'config/koneksi.php';
$user_id = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
header('Location:login.php');
}
$sql = mysqli_query($link, "SELECT * FROM foto,user,album WHERE foto.user_id=user.user_id AND foto.album_id=album.album_id ORDER BY foto.tanggalUnggahan AND foto.user_id='$user_id' DESC");
?>
<!DOCTYPE html>
<html lang="en">
<!-- NOTE Ngerun Session -->


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Link CSS Bootstrap -->
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
      /* Warna latar belakang header */
      color: white;
      padding: 0;
      margin: 0;
      /* Mengatur margin menjadi 0 */
      display: flex;
      align-items: center;
    }

    .content {
      flex: 1;
      padding: 0;
      margin: 0;
      /* Mengatur margin menjadi 0 */
    }
  </style>
</head>

<body>


  <!-- Konten utama website Anda akan ditempatkan di sini -->
  <?php include 'partials/sidebar.php' ?>
  <div class="w-75">
    <header class="p-3 d-flex justify-item-center gap-5">
      Home
    </header>
    <?php foreach ($sql as $data) : ?>
      <div class="p-2 border">
        <div class="d-flex">
          <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
          <div class="ml-2">
            <a href="fotouser.php?user_id=<?=$data['user_id']?>"  style="color: black;">
            <b><?= $data['username'] ?></b>
            </a>
            <span><?= $data['tanggalUnggahan'] ?></span>
            <div><?= $data['deskripsiFoto'] ?></div>
          </div>
        </div>
        <div class="mb-2 mt-2">
          <img src="assets/<?= $data['lokasiFile'] ?>" class="w-100" alt="..." style="object-fit: cover; height: 500px; border-radius: 10px;">
        </div>
        <div class="action-buttons container mb-4 mt-1" style="">
          <?php
          $foto_id = $data['foto_id'];
          $query_like_1 = mysqli_query($link, "SELECT * FROM likefoto,foto,user WHERE likefoto.foto_id=foto.foto_id AND likefoto.user_id=user.user_id AND foto.foto_id='$foto_id' AND user.user_id='$user_id'");
          $result = mysqli_num_rows($query_like_1);
          $komen = mysqli_query($link, "SELECT * FROM komentarfoto,foto WHERE komentarfoto.foto_id=foto.foto_id AND foto.foto_id='$foto_id'");
          $qount_komen = mysqli_num_rows($komen);
          if ($result >= 1) : ?>
            <a href="aksi/foto/aksi_like.php?aksi=hapus&table=likefoto&foto_id=<?= $data['foto_id'] ?>&user_id=<?= $user_id ?>" class="btn btn-outline-danger btn-like"><i class="fas fa-heart"></i> Like</a>
          <?php else : ?>
            <a href="aksi/foto/aksi_like.php?aksi=tambah&table=likefoto&foto_id=<?= $data['foto_id'] ?>&user_id=<?= $user_id ?>" class="btn btn-outline-danger btn-like"><i class="fas fa-heart"></i> belum Like</a>
          <?php endif ?>
          <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModalHome<?= $data['foto_id'] ?>"><i class="fas fa-comment"></i> Comment</button>
          <div class="ms-3 komen_li">
            <span>
              <?php
              $like = mysqli_query($link, "SELECT * FROM likefoto,foto WHERE likefoto.foto_id=foto.foto_id AND foto.foto_id='$foto_id'");
              $qount_like = mysqli_num_rows($like);
              ?><?=$qount_like?> Like
            </span> <br>
            <span><?= $qount_komen ?> Comment</span>
          </div>
        </div>
      </div>
      <?php include 'partials/modals.php'; ?>
    <?php endforeach; ?>
  </div>

  <?php include 'partials/rightbar.php'; ?>
  <!-- Script Bootstrap (Popper.js, jQuery, Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>