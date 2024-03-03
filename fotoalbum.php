<?php
// session_start();
// $user_id = $_SESSION["user_id"];
include 'config/koneksi.php';
$album_id = $_GET['album_id'];
$getUserPhotoSql = "SELECT * FROM foto,album,user WHERE foto.user_id=user.user_id AND foto.album_id=album.album_id AND foto.album_id='$album_id'";
$resultGetUserPhoto = mysqli_query($link, $getUserPhotoSql);
$nama_album = mysqli_query($link, "SELECT * FROM album WHERE album_id='$album_id'");
$tampil_nama_album = mysqli_fetch_assoc($nama_album);
// var_dump($resultGetUserPhoto);
// die();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery - Album</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
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
      <?= $tampil_nama_album['namaAlbum'] ?>
    </header>
    <?php if(isset($_GET['berhasil_hapus'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa-solid fa-check pe-2"></i>
      Berhasil Hapus Foto
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
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
              <div class="kanan">
                <a href="aksi/foto/aksi_like.php?aksi=hapus&table=foto&foto_id=<?= $row['foto_id'] ?>&album_id=<?= $row['album_id'] ?>" class="text-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')" style="font-size: 20px;">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="mb-2 mt-2">
            <img src="assets/<?php echo  $row['lokasiFile']; ?>" class="w-100" alt="..." style="object-fit: cover; height: 500px; border-radius: 10px;">
          </div>
        </div>
        <div class="action-buttons mb-4 mt-1 " style="">
          <!-- <button class="btn btn-outline-danger btn-like" onclick="toggleLike()"><i class="fas fa-heart"></i> Like</button>
          <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal"><i class="fas fa-comment"></i> Comment</button> -->
          <!-- <div class="like-count mt-1 d-flex" style="border-bottom: 2px solid #ccc;"><?php echo $likeCount ?> likes -->
          <!-- Tambahkan tautan untuk mengedit album -->
          <!-- <a href="" data-toggle="modal" data-target="#addPhotoModal<?= $row['foto_id'] ?>" class="text-primary mr-3 ml-auto mb-2" style="font-size: 20px;">
              <i class="fas fa-edit"></i>
            </a> -->
          <!-- Tambahkan tautan dan tombol untuk menghapus album -->

          <!-- </div> -->
          <script>
            function toggleLike() {
              var likeButton = document.querySelector('.btn-like');
              likeButton.classList.toggle('btn-danger'); // Toggle the class btn-danger
              likeButton.classList.toggle('btn-outline-danger'); // Toggle the class btn-outline-danger
              var heartIcon = likeButton.querySelector('i.fa-heart');
              heartIcon.classList.toggle('fas'); // Toggle the class fas (solid heart)
              heartIcon.classList.toggle('far'); // Toggle the class far (regular heart)
            }
          </script>
          <?php include 'partials/comment.php'; ?>
          <!-- Modal untuk Tambah Foto -->
          <div class="modal fade" id="addPhotoModal<?= $row['foto_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addPhotoModal<?= $row['foto_id'] ?>Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addPhotoModal<?= $row['foto_id'] ?>Label">Tambah Foto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form tambah foto bisa ditambahkan di sini -->
                  <form action="aksi/foto/aksi_edit.php?foto_id=<?= $row['foto_id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="photoFile">Pilih Foto:</label>
                      <input type="file" name="fotobaru" class="form-control-file" id="photoFile">
                      <input type="hidden" name="foto" class="form-control-file" id="photoFile" value="<?= $row['lokasiFile'] ?>">
                      <input type="hidden" name="foto_id" class="form-control-file" id="photoFile" value="<?= $row['foto_id'] ?>">
                      <input type="hidden" name="album_id" class="form-control-file" id="photoFile" value="<?= $row['album_id'] ?>">
                      <input type="hidden" name="user_id" class="form-control-file" id="photoFile" value="<?= $_SESSION['user_id'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="photoCaption">Title:</label>
                      <input type="text" name="judulFoto" class="form-control" id="photoCaption" placeholder="Masukkan caption foto" value="<?= $row['judulFoto'] ?>">
                    </div>
                    <div class="mb-3">
                      <label for="">Caption :</label>
                      <textarea class="form-control" name="deskripsiFoto" id="" cols="30" rows="5"><?= $row['deskripsiFoto'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                  </form>
                </div>
              </div>
            </div>
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