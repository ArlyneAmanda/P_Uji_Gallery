<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Link CSS Bootstrap -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

    .profile-container {
      text-align: center;
    }

    .profile-picture {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto;
    }

    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .biodata {
      margin-top: 20px;
    }

    .upload-form {
      display: none;
      position: fixed;
      top: 0;
      right: -100%;
      height: 100%;
      width: 300px;
      background-color: #fff;
      box-shadow: -2px 0px 5px rgba(0, 0, 0, 0.1);
      transition: right 0.3s ease-in-out;
    }

    .upload-form.open {
      right: 0;
    }
  </style>
</head>

<?php

// NOTE panggil koneksi
require_once('config/koneksi.php');
?>

<body>

  <?php include 'partials/sidebar.php'; ?>

  <div class="w-100">
    <header class="p-3 d-flex justify-item-center gap-1">
      <a href="home.php" class="p=0 bg=transparent mr-2">
        <span class="text-white">&#8592;</span>
      </a>
      Profile
      <button type="button" class="btn btn-outline-light rounded-pill ml-auto" data-toggle="modal" data-target="#addPhotoModal">+ Foto</button>
    </header>
    <div class="profile-container m-5">
      <!-- <div class="profile-picture" style="">
            <img src="assets/taehyung.jpg" alt="Profile Picture">
        </div> -->
      <div class="biodata">
        <h2>
          <!-- NOTE Panggil nama lengkap dari session -->
          <?= $_SESSION['username'] ?>
        </h2>
        <h6>
          <?= $_SESSION['namalengkap'] ?>
        </h6>
        <p>
          <!-- NOTE Panggil nama lengkap dari session -->
          alamat: <?= $_SESSION['alamat'] ?>
        </p>
        <!-- Tambahkan data biodata lainnya sesuai kebutuhan -->
      </div>
    </div>
    <div class="postingan">
      <div class="text-center" style="border-bottom: 2px solid #ccc; border-top: 2px solid #ccc;">
        <!-- FIXME data-target tolong dikasih nama yang sesuai -->
        <a href="" class="btn btn-outline-light text-primary" data-toggle="modal" data-target="#commentModal" style="font-size: 25px;">+</a>
        <?php if (isset($_GET['errorFoto'])) : ?>
          <!-- <p>coba aja ini mah</p> -->
        <?php endif; ?>
      </div>
      <?php if (isset($_GET['berhasil_tambah'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa-solid fa-check pe-2"></i>
          Berhasil Tambah Album
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (isset($_GET['berhasil_tambah_foto'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa-solid fa-check pe-2"></i>
          Berhasil Tambah Foto
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (isset($_GET['berhasil_hapus'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa-solid fa-check pe-2"></i>
          Berhasil Hapus Album
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if (isset($_GET['berhasil_edit'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa-solid fa-check pe-2"></i>
          Berhasil Edit Album
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php
      // NOTE Ambil data menggunakan function yang dibuat
      $dataAlbum = query("SELECT * FROM album  WHERE album.user_id = '$_SESSION[user_id]'");

      // NOTE Cek apakah datanya tidak ada
      if (empty($dataAlbum)) : ?>
        <div class="m-2 p-2 border rounded-2">
          <p class="text-center">
            Tidak Ada Data Album
          </p>
        </div>
      <?php endif;

      // NOTE looping data yang diambil
      $index = 0;
      foreach ($dataAlbum as $itemAlbum) : ?>
        <div class="m-2 p-2 border rounded-2 d-flex justify-content-between align-items-center">
          <div>
            <a href="fotoalbum.php?album_id=<?= $itemAlbum['album_id'] ?>" class="text-dark text-decoration-none">
              <h5>
                <?= $itemAlbum['namaAlbum'] ?>
              </h5>
            </a>
            <p>
              <?= $itemAlbum['deskripsi'] ?>
            </p>
            <small class="font-italic">
              <!-- NOTE ubah format tanggal yang tadinya 2024-02-28 menjadi 28 February 2024 -->
              <?php $tgl = new DateTime($itemAlbum['tanggalDibuat']);
              echo $tgl->format('d F Y'); ?>
            </small>
          </div>
          <div class="d-flex align-items-center pr-3">
            <!-- Tambahkan tautan untuk mengedit album -->
            <!-- <a href="edit_album.php?id=<?= $itemAlbum['album_id'] ?>" class="text-primary mr-3" style="font-size: 20px;">
              <i class="fas fa-edit"></i>
          </a> -->
          <a href="" type="button" class="mr-3 text-primary" data-toggle="modal" data-target=<?= "#editPhotoModal" . $index ?> style="font-size: 20px;"><i class="fas fa-edit"></i></a>
            <!-- Tambahkan tautan dan tombol untuk menghapus album -->
            <a href="aksi/album/aksi_hapus.php?album_id=<?= $itemAlbum['album_id'] ?>" class="text-danger" data-bs-toggle="modal" data-bs-target="#hapus_album<?= $itemAlbum['album_id'] ?>" style="font-size: 20px;">
              <i class="fas fa-trash"></i>
            </a>
          </div>
        </div>

        <?php include 'partials/modals.php'; ?>
        
        <?php $index++; ?>
      <?php endforeach; ?>

    </div>
  </div>

  
  
  
  
  
  

  <!-- Script Bootstrap (Popper.js, jQuery, Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>

</html>