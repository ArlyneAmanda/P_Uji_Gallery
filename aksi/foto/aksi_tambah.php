<?php

require_once '../../config/koneksi.php';

$uploadDir = "../../assets/"; // Direktori tempat menyimpan file
$namaFile = basename($_FILES["foto"]["name"]);
$uploadFile = $uploadDir . $namaFile;

// Periksa apakah file gambar
$imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
// Format File yang diharuskan
$allowedExtensions = array("jpg", "jpeg", "png", "gif");

if (in_array($imageFileType, $allowedExtensions)) {
    // Pindahkan file ke direktori yang ditentukan
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $uploadFile)) {

        $judulFoto = $_POST['judulFoto'];
        $deskripsiFoto = $_POST['deskripsiFoto'];
        $album_id = $_POST['album'];
        $user_id = $_SESSION['user_id'];

        $tglSekarang = date('Y-m-d');

        mysqli_query($link, "INSERT INTO foto VALUES (NULL, '$judulFoto', '$deskripsiFoto', '$tglSekarang', '$namaFile', '$album_id', '$user_id')");

        header('location: ../../profile.php?berhasil_tambah_foto');

    } else {
        echo "Gagal mengunggah foto.";
    }
} else {
    echo "Hanya file gambar dengan ekstensi JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
}

