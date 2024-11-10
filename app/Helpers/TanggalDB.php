<?php
function tanggal_db($tanggal){
    $format = date('Y-m-d', strtotime($tanggal ));
    // $hasil = number_format ($angka,0,',','.');
    return $format;
}