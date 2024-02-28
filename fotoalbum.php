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
        <button type="button" class="btn btn-outline-light rounded-pill ml-auto" data-toggle="modal" data-target="#addPhotoModal">+ Foto</button>
      </header>
        <div class="m-2 p-2 border rounded-2">
        <div class="p-2">
        <div class="d-flex">
          <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
          <div class="ml-2">
              <b>Arlyne Amanda Raihanah</b>
              <span> 27/02/2024</span>
              <div>taehyung</div>
          </div>
        </div>
        <div class="mb-2 mt-2">
          <img src="assets/taehyung.jpg" class="w-100" alt="..." style="object-fit: cover; height: 500px; border-radius: 10px;">
        </div>
      </div>
      <div class="action-buttons container mb-4 mt-1" style="">
        <button class="btn btn-outline-danger"><i class="fas fa-heart"></i> Like</button>
        <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal"><i class="fas fa-comment"></i> Comment</button>
        <div class="like-count mt-1 d-flex" style="border-bottom: 2px solid #ccc;">11170 likes
          <!-- Tambahkan tautan untuk mengedit album -->
          <a href="edit_album.php?id=<?= $itemAlbum['foto_id'] ?>" class="text-primary mr-3 ml-auto mb-2" style="font-size: 20px;">
            <i class="fas fa-edit"></i>
          </a>
          <!-- Tambahkan tautan dan tombol untuk menghapus album -->
          <a href="hapus_album.php?id=<?= $itemAlbum['foto_id'] ?>" class="text-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')" style="font-size: 20px;">
            <i class="fas fa-trash"></i>
          </a>
        </div>
      </div>
      <?php include 'partials/comment.php'; ?>

      <div class="p-2">
        <div class="d-flex">
          <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
          <div class="ml-2">
              <b>Arlyne Amanda Raihanah</b>
              <span> 27/02/2024</span>
              <div>taehyung</div>
          </div>
        </div>
        <div class="mb-2 mt-2">
          <img src="assets/taehyung.jpg" class="w-100" alt="..." style="object-fit: cover; height: 500px; border-radius: 10px;">
        </div>
      </div>
      <div class="action-buttons container mb-4 mt-1" style="">
        <button class="btn btn-outline-danger"><i class="fas fa-heart"></i> Like</button>
        <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal"><i class="fas fa-comment"></i> Comment</button>
        <div class="like-count mt-1 d-flex" style="border-bottom: 2px solid #ccc;">11170 likes
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
    </div>
    
    <!-- Modal untuk Tambah Foto -->
    <div class="modal fade" id="addPhotoModal" tabindex="-1" role="dialog" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
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