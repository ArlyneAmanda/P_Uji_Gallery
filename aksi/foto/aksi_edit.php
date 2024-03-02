<?php

require_once '../../config/koneksi.php';

$uploadDir = "../../assets/"; // Direktori tempat menyimpan file
$namaFile = basename($_FILES["fotobaru"]["name"]);
$uploadFile = $uploadDir . $namaFile;

// Periksa apakah file gambar
$imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
// Format File yang diharuskan
$allowedExtensions = array("jpg", "jpeg", "png", "gif");

if (in_array($imageFileType, $allowedExtensions)) {
    // Pindahkan file ke direktori yang ditentukan
    if (move_uploaded_file($_FILES["fotobaru"]["tmp_name"], $uploadFile)) {

        $judulFoto = $_POST['judulFoto'];
        $deskripsiFoto = $_POST['deskripsiFoto'];
        $user_id = $_POST['user_id'];
        $foto_id = $_POST['foto_id'];
        $album_id = $_POST['album_id'];

        $tglSekarang = date('Y-m-d');

        mysqli_query($link, "UPDATE foto SET judulFoto='$judulFoto' , deskripsiFoto='$deskripsiFoto' , tanggalUnggahan='$tglSekarang' , lokasiFile='$namaFile' WHERE foto_id='$foto_id'");

        header('location: ../../fotoalbum.php?album_id=<?=$album_id?>');

    } else {
        echo "Gagal mengunggah foto.";
    }
} else {
    echo "Hanya file gambar dengan ekstensi JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
}

