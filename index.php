<?php
include 'config/koneksi.php';
$user_id = $_SESSION['user_id'];
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
      <a href="" class="p=0 bg=transparent mr-2">
        <span class="text-white">&#8592;</span>
      </a>
      Home
    </header>
    <?php foreach ($sql as $data) : ?>
      <div class="p-2 border">
        <div class="d-flex">
          <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
          <div class="ml-2">
            <b><?= $data['username'] ?></b>
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
          <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal<?= $data['foto_id'] ?>"><i class="fas fa-comment"></i> Comment</button>
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
      <!-- Modal untuk Komentar -->
      <div class="modal fade" id="commentModal<?= $data['foto_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="commentModal<?= $data['foto_id'] ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="commentModal<?= $data['foto_id'] ?>Label">Comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="aksi/foto/aksi_like.php?aksi=tambah&table=komentarfoto" method="post">
              <div class="modal-body">
                <!-- Isi komentar atau form komentar dapat ditambahkan di sini -->
                <div class="form-group">
                  <label for="commentText">Your Comment:</label>
                  <input type="text" name="isiKomentar" class="form-control" id="comment" placeholder="Komen disini">
                  <input type="hidden" name="user_id" value="<?= $user_id ?>" class="form-control" id="comment" placeholder="Komen disini">
                  <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>" class="form-control" id="comment" placeholder="Komen disini">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <hr>
                <?php
                $foto_id = $data['foto_id'];
                $query_komen = mysqli_query($link, "SELECT * FROM komentarfoto,foto,user WHERE komentarfoto.foto_id=foto.foto_id AND komentarfoto.user_id=user.user_id AND foto.foto_id='$foto_id' ");
                foreach ($query_komen as $data) :
                ?>
                  <b style="margin-right: 5px;"><?= $data['username'] ?></b><?= $data['isiKomentar'] ?><br>
                <?php endforeach ?>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php include 'partials/comment.php'; ?>
    <?php endforeach; ?>
  </div>

  <?php include 'partials/rightbar.php'; ?>
  <!-- Script Bootstrap (Popper.js, jQuery, Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>