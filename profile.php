<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Link CSS Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <header class="p-3 d-flex justify-item-center gap-5">
      <a href="" class="p=0 bg=transparent mr-2">
        <span class="text-white">&#8592;</span>
      </a>
      Profile
      <button type="button" class="btn btn-outline-light rounded-pill ml-auto" data-toggle="modal"
        data-target="#addPhotoModal">+ Foto</button>
    </header>
    <div class="profile-container m-5">
      <!-- <div class="profile-picture" style="">
            <img src="assets/taehyung.jpg" alt="Profile Picture">
        </div> -->
      <div class="biodata">
        <h2>
          <!-- NOTE Panggil nama lengkap dari session -->
          <?= $_SESSION['namalengkap'] ?>
        </h2>
        <!-- Tambahkan data biodata lainnya sesuai kebutuhan -->
      </div>
    </div>
    <div class="postingan">
      <div class="text-center" style="border-bottom: 2px solid #ccc; border-top: 2px solid #ccc;">
        <!-- FIXME data-target tolong dikasih nama yang sesuai -->
        <a href="" class="btn btn-outline-light text-primary" data-toggle="modal" data-target="#commentModal"
          style="font-size: 25px;">+</a>
        <!-- Modal untuk Album -->
        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Tambah Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left">
                <!-- NOTE tambahin url, dan method post -->
                <form action="aksi/album/aksi_tambah.php" method="post">
                  <div class="mb-3">
                    <label for="">Nama Album :</label>
                    <!-- NOTE kasih name="" di input -->
                    <input type="text" class="form-control" name="nama_album">
                  </div>
                  <div class="mb-3">
                    <label for="">Deskripsi :</label>
                    <!-- NOTE kasih name="" di textarea -->
                    <textarea class="form-control" name="deskripsi_album" id="" cols="30" rows="5"></textarea>
                  </div>
                  <div class="modal-footer">
                    <!-- NOTE ubah type button jadi submit, 
                    dan data-dismiss di hapus supaya modal nya engga ketutup sebelum ngirim data -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      // NOTE Ambil data menggunakan function yang dibuat
      $dataAlbum = query('SELECT * FROM album');

      // NOTE Cek apakah datanya tidak ada
      if (empty($dataAlbum)): ?>
        <div class="m-2 p-2 border rounded-2">
          <p class="text-center">
            Tidak Ada Data Album
          </p>
        </div>
      <?php endif;

      // NOTE looping data yang diambil
      foreach ($dataAlbum as $itemAlbum): ?>
        <div class="m-2 p-2 border rounded-2">
          <a href="fotoalbum.php" class="text-dark text-decoration-none">
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
      <?php endforeach; ?>

    </div>
  </div>

  <!-- Modal untuk Tambah Foto -->
  <div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="addPhotoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPhotoModalLabel">Tambah Foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form tambah foto bisa ditambahkan di sini -->
          <form>
            <div class="form-group">
              <label for="photoFile">Pilih Foto:</label>
              <input type="file" class="form-control-file" id="photoFile">
            </div>
            <div class="form-group">
              <label for="photoCaption">Title:</label>
              <input type="text" class="form-control" id="photoCaption" placeholder="Masukkan caption foto">
            </div>
            <div class="mb-3">
              <label for="">Caption :</label>
              <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label for="photoAlbum">Album:</label><br>
              <select name="" id="" class="form-select">
                <option value="">Album 1</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Upload Foto</button>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Script Bootstrap (Popper.js, jQuery, Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>

</html>