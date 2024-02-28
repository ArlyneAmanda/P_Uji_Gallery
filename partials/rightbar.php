<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .right-content {
            background-color: #070F2B;
            color: #fff;
            padding: 20px;
            width: 300px; /* Sesuaikan lebar konten kanan sesuai kebutuhan */
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
    <main class="right-content">
        <!-- Konten yang terletak pada bagian paling kanan website dengan background hitam -->
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Cari...">
            <button class="search-button">Cari</button>
        </div>
        <p>Account</p>
        <div class="d-flex align-items-center">
          <a href="profile.php" class="text-decoration-none text-white">
            <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 40px;"> -->
            <!-- NOTE Panggil nama lengkap dari session -->
            <span class="" style="font-size: 18px;"><?= $_SESSION['namalengkap'] ?></span>
          </a>
        </div>
    </main>
</body>
</html>
