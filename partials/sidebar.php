<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Your Gallery Website</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #070F2B;
            /* Mengubah warna latar belakang sidebar */
            color: white;
            /* padding-top: 80px; */
            transition: min-width 0.5s, max-width 0.5s;

        }

        .sidebar.collapsed {
            min-width: 50px;
            max-width: 50px;
        }

        .logo {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
        }

        li {
            text-align: center;
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
            /* margin: 5px; */

        }

        li:hover {
            color: #000;
            background-color: #9370DB;
            text-decoration: none;
            width: 100%;
        }

        .menu-items {
            text-decoration: none;
            color: white;
            font-size: 1.2em;
            transition: color 0.3s ease, background-color 0.3s ease;
            /* display: block; */
            width: 100%;
            padding: 10px;
            margin-bottom: 100rem;
            /* margin-left: 10px;
            margin-right: 10px; */
            border-radius: 5px;
        }

        .menu-items:hover {
            color: #000;
            /* background-color: #9370DB; */
            text-decoration: none;
            width: 100%;

        }

        /* .content {
            flex: 1;
            padding: 20px;
        } */

        .burger-menu {
            cursor: pointer;
            /* position: fixed;
            top: 20px;
            left: 20px;
            z-index: 2; */
            font-size: 24px;
            color: white;
        }

        .sidebar-menu {
            /* display: block; */
            /* position: fixed; */
            /* width: 100%; */
        }

        .sidebar.collapsed .sidebar-menu {
            display: none;
        }

        .sidebar-text {
            display: block;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }
    </style>
</head>

<body class="d-flex">


    <nav class="sidebar p-2">
        <div class="burger-menu" onclick="toggleSidebar()">☰</div>
        <ul class="sidebar-menu">
            <!-- <div class="logo my-4">Logo</div> -->
            <!-- <li><a href="profile.php" class="menu-items">Profile</a></li> -->
            <!-- <li><a href="fotoalbum.php" class="menu-items">Foto Album</a></li> -->
            <?php if (!isset($_SESSION['username'])) : ?>
                <li><a href="index.php" class="menu-items">Home</a></li>
                <li><a href="login.php" class="menu-items">Login</a></li>
                <?php else : ?>
                    <li><a href="home.php" class="menu-items">Home</a></li>
                    <li><a href="aksi/logout.php" class="menu-items">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        }
    </script>

</body>

</html>