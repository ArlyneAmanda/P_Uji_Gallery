<?php

// NOTE untuk Memanggil koneksi
require_once "../../config/koneksi.php";

// NOTE masukin semua data input ke variabel
$namaAlbum = $_REQUEST['nama_album'];
$deskripsiAlbum = $_REQUEST['deskripsi_album'];

// NOTE ambil id user yang login
$idUser = $_SESSION['user_id'];

$tglSekarang = date('Y-m-d');

mysqli_query($link, "INSERT INTO album VALUES (NULL, '$namaAlbum', '$deskripsiAlbum', '$tglSekarang', '$idUser')");

// NOTE kembali ke halaman profile
header('location: ../../profile.php');