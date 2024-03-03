<?php

// NOTE untuk Memanggil koneksi
require_once "../../config/koneksi.php";

// NOTE masukin semua data input ke variabel
$namaAlbum = $_POST['nama_album'];
$deskripsiAlbum = $_POST['deskripsi_album'];

$album_id = $_POST['album_id'];

mysqli_query($link, "UPDATE album SET namaAlbum = '$namaAlbum', deskripsi = '$deskripsiAlbum' WHERE album_id = '$album_id'");

// NOTE kembali ke halaman profile
header('location: ../../profile.php?berhasil_edit');