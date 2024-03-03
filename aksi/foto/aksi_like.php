<?php
require_once '../../config/koneksi.php';
if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if (isset($_GET['table'])) {
        $table = $_GET['table'];
    }
}
$tanggal = date("y-m-d");
if ($aksi == 'tambah') {
    if ($table == 'likefoto') {
        $foto_id = $_GET['foto_id'];
        $user_id = $_GET['user_id'];
        mysqli_query($link, "INSERT INTO $table VALUES('','$foto_id','$user_id','$tanggal')");
        header("Location:../../home.php");
    }
    if ($table == 'komentarfoto') {
        $foto_id = $_POST['foto_id'];
        $user_id = $_POST['user_id'];
        $isiKomentar = $_POST['isiKomentar'];
        mysqli_query($link, "INSERT INTO komentarfoto VALUES('','$foto_id','$user_id','$isiKomentar','$tanggal')");
        header("Location:../../home.php");
    }
}
if ($aksi == 'hapus') {
    if ($table == 'likefoto') {
        $foto_id = $_GET['foto_id'];
        $user_id = $_GET['user_id'];
        mysqli_query($link, "DELETE FROM $table WHERE foto_id='$foto_id'");
        header("Location:../../home.php");
    }
    if ($table == 'foto') {
        $foto_id = $_GET['foto_id'];
        $album_id = $_GET['album_id'];
        $result = mysqli_query($link, "SELECT * FROM foto WHERE foto_id='$foto_id'");
        $foto = mysqli_fetch_assoc($result);
        unlink('../../assets/' . $foto['lokasiFile']);
        mysqli_query($link, "DELETE FROM likefoto WHERE foto_id='$foto_id'");
        mysqli_query($link, "DELETE FROM komentarfoto WHERE foto_id='$foto_id'");
        mysqli_query($link, "DELETE FROM $table WHERE foto_id='$foto_id'");
        header("Location:../../fotoalbum.php?album_id=$album_id");
    }
}
