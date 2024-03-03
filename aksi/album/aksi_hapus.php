<?php

// NOTE untuk Memanggil koneksi
require_once "../../config/koneksi.php";

$album_id = $_GET['album_id'];

$dataFoto = query("SELECT * FROM foto WHERE album_id = $album_id");

// var_dump(count($dataFoto));    

if(count($dataFoto) != 0){
    for($i = 0; $i < count($dataFoto); $i++){
        $id = $dataFoto[$i]['foto_id'];
        
        $dataLike = query("SELECT * FROM likefoto WHERE foto_id = $id");
        $dataKomentar = query("SELECT * FROM komentarfoto WHERE foto_id = $id");
        
        if(count($dataLike) != 0){
            mysqli_query($link, "DELETE FROM likeFoto WHERE `foto_id` = $id");
        }
        
        if(count($dataKomentar) != 0){
            mysqli_query($link, "DELETE FROM komentarFoto WHERE `foto_id` = $id");
        }

        mysqli_query($link, "DELETE FROM foto WHERE `foto_id` = $id");
    }

}

mysqli_query($link, "DELETE FROM album WHERE album_id = $album_id");

// NOTE kembali ke halaman profile
header('location: ../../profile.php?berhasil_hapus');

