<?php
function tanggal_indo($tanggal){
    $format = date('d-m-Y', strtotime($tanggal ));
    // $hasil = number_format ($angka,0,',','.');
    return $format;
}