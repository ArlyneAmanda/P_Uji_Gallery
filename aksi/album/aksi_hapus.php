<?php

// NOTE untuk Memanggil koneksi
require_once "../../config/koneksi.php";

$album_id = $_GET['album_id'];


$dataFoto = query("SELECT * FROM foto WHERE album_id = '$album_id'");

var_dump($dataFoto);

// if($dataFoto != null){
//     for($i = 0; $i < count($dataFoto); $i++){
//         query("DELETE FROM album WHERE album_id = '$dataFoto[$i]['album_id']'");
//     }

//     query("DELETE FROM album WHERE album_id = '$album_id'");
// } else {
//     header('location: ../../profile.php?errorFoto=true');
// }



// // NOTE kembali ke halaman profile
// header('location: ../../profile.php');