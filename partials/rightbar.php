<?php
if (!isset($_SESSION['user_id'])) {
    $baca_semua_user = mysqli_query($link, "SELECT * FROM user ");
} else {
    $user_id = $_SESSION['user_id'];
    $baca_semua_user = mysqli_query($link, "SELECT * FROM user WHERE user.user_id !='$user_id' ");
}
?>
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
            width: 300px;
            /* Sesuaikan lebar konten kanan sesuai kebutuhan */
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
        <p>Account</p>
        <div class="d-flex align-items-center">
            <a href="profile.php" class="text-decoration-none text-white">
                <!-- <img src="assets/taehyung.jpg" class="rounded-circle" alt="account" style="width: 40px;"> -->
                <!-- NOTE Panggil nama lengkap dari session -->
                <?php if (isset($_SESSION['namalengkap'])) : ?>
                    <span class="" style="font-size: 18px;"><?= $_SESSION['namalengkap'] ?></span><br>
                <?php endif ?>
            </a><br>
        </div>
        <?php foreach ($baca_semua_user as $data) : ?>
            <div class="akun mb-2 border">
                <a href="fotouser.php?user_id=<?= $data['user_id'] ?>">
                    <span class="" style="font-size: 18px;"><?= $data['username'] ?></span><br>
                </a>
                <span class="" style="font-size: 14px;"><?= $data['namalengkap'] ?></span><br>
            </div>
        <?php endforeach ?>
    </main>
</body>

</html>