<?php

// NOTE Untuk ngerun session
session_start();

$link = mysqli_connect('localhost', 'root', '', 'uji_gallery');

// NOTE Buat function untuk ngambil data secara efisien, $sql itu namanya parameter
function query($sql)
{
    // NOTE buat agar variabel $link bisa diakses disini 
    global $link;

    // NOTE run query dari sql yang didapet dari parameter dan masukkan ke variabel $query
    $query = mysqli_query($link, $sql);

    // NOTE buat array kosong
    $rows = [];

    // NOTE Setiap baris data yang berasal dari variabel $query akan di loop/diulangi program di bawahnya
    while ($row = mysqli_fetch_assoc($query)) {
        // NOTE masukkan setiap baris data ke variabel $rows yang sebelumnya kosong
        $rows[] = $row;
    }

    // NOTE function ini akan mengembalikan/menghasilkan nilai ini
    return $rows;
}
