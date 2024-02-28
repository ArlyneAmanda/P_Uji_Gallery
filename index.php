<!DOCTYPE html>
<html lang="en">
  <!-- NOTE Ngerun Session -->
<?php session_start() ?>
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
    <div class="p-2">
      <div class="d-flex">
        <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;">  -->
        <div class="ml-2">
          <b>Arlyne Amanda Raihanah</b>
          <span>27/02/2024</span>
          <div>taehyung</div>
        </div>
      </div>
      <div class="mb-2 mt-2">
        <img src="assets/taehyung.jpg" class="w-100" alt="..."
          style="object-fit: cover; height: 500px; border-radius: 10px;">
      </div>
    </div>
    <div class="action-buttons container mb-4 mt-1" style="">
      <button class="btn btn-outline-danger"><i class="fas fa-heart"></i> Like</button>
      <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal"><i
          class="fas fa-comment"></i> Comment</button>
      <div class="like-count mt-1" style="border-bottom: 2px solid #ccc;">11170 likes</div>
    </div>
    <?php include 'partials/comment.php'; ?>

    <div class="p-2">
      <div class="d-flex">
        <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 50px;"> -->
        <div class="ml-2">
          <b>Arlyne Amanda Raihanah</b>
          <span> 27/02/2024</span>
          <div>taehyung</div>
        </div>
      </div>
      <div class="mb-2 mt-2">
        <img src="assets/taehyung.jpg" class="w-100" alt="..."
          style="object-fit: cover; height: 500px; border-radius: 10px;">
      </div>
    </div>
    <div class="action-buttons container mb-4 mt-1" style="">
      <button class="btn btn-outline-danger"><i class="fas fa-heart"></i> Like</button>
      <button class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#commentModal"><i
          class="fas fa-comment"></i> Comment</button>
      <div class="like-count mt-1" style="border-bottom: 2px solid #ccc;">11170 likes</div>
    </div>
    <?php include 'partials/comment.php'; ?>
  </div>



  <?php include 'partials/rightbar.php'; ?>

  <!-- Script Bootstrap (Popper.js, jQuery, Bootstrap JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>