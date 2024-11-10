<?php
function uang_db($angka){
    $hasil= str_replace(".", "", $angka);
    // $hasil = number_format ($angka,0,',','.');
    return $hasil;
}