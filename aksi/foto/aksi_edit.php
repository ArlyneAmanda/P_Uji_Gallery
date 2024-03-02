<?php

require_once '../../config/koneksi.php';

$uploadDir = "../../assets/"; // Direktori tempat menyimpan file
$namaFile = ""; // Inisialisasi nama file kosong

// Periksa apakah file gambar dipost
if(isset($_FILES["fotobaru"]) && $_FILES["fotobaru"]["error"] == UPLOAD_ERR_OK) {
    // File gambar dipost, proses unggah file baru
    $namaFile = basename($_FILES["fotobaru"]["name"]);
    $uploadFile = $uploadDir . $namaFile;

    // Periksa apakah file gambar memiliki ekstensi yang diizinkan
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $allowedExtensions)) {
        // Pindahkan file baru ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["fotobaru"]["tmp_name"], $uploadFile)) {
            // File baru berhasil diunggah, gunakan file baru untuk pembaruan
            $tglSekarang = date('Y-m-d');
            $judulFoto = $_POST['judulFoto'];
            $deskripsiFoto = $_POST['deskripsiFoto'];
            $user_id = $_POST['user_id'];
            $foto_id = $_POST['foto_id'];
            $album_id = $_POST['album_id'];
            $foto_lama=$_POST['foto'];
            unlink("../../assets/".$foto_lama);
            mysqli_query($link, "UPDATE foto SET judulFoto='$judulFoto', deskripsiFoto='$deskripsiFoto', tanggalUnggahan='$tglSekarang', lokasiFile='$namaFile' WHERE foto_id='$foto_id' AND album_id='$album_id'");

            header("location: ../../fotoalbum.php?album_id=$album_id");
        } else {
            echo "Gagal mengunggah foto.";
        }
    } else {
        echo "Hanya file gambar dengan ekstensi JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
    }
} else {
    // File gambar tidak dipost, gunakan foto lama
    $tglSekarang = date('Y-m-d');
    $judulFoto = $_POST['judulFoto'];
    $deskripsiFoto = $_POST['deskripsiFoto'];
    $user_id = $_POST['user_id'];
    $foto_id = $_POST['foto_id'];
    $album_id = $_POST['album_id'];

    // Ambil nama file lama dari database
    $queryGetFoto = mysqli_query($link, "SELECT lokasiFile FROM foto WHERE foto_id='$foto_id'");
    $rowFoto = mysqli_fetch_assoc($queryGetFoto);
    $namaFile = $rowFoto['lokasiFile'];

    // Update data foto tanpa mengubah nama file
    mysqli_query($link, "UPDATE foto SET judulFoto='$judulFoto', deskripsiFoto='$deskripsiFoto', tanggalUnggahan='$tglSekarang' WHERE foto_id='$foto_id' AND album_id='$album_id'");

    header("location: ../../fotoalbum.php?album_id=$album_id");
}
?>
