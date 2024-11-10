<?php

namespace App\Helpers;
use Carbon\Carbon;

class Tanggal
{
	public static function keIndonesia($tgl)
	{
		$dt = new Carbon($tgl);
		setlocale(LC_TIME, 'IND');
		
		return $dt->formatLocalized('%d %B %Y %H:%M:%S');
    } 
    public static function keIndonesia_w_time($tgl) {
	$dt = new  \Carbon\Carbon($tgl);
	setlocale(LC_TIME, 'IND');
		
	return $dt->formatLocalized('%d %B %Y %H:%M:%S'); // Senin, 3 September 2018 00:00:00
} 
}
// ini diletakan di HELPER atau langsung di controllernya

function keIndonesia($tgl) {
	$dt = new  \Carbon\Carbon($tgl);
	setlocale(LC_TIME, 'IND');
		
	return $dt->formatLocalized('%A, %e %B %Y'); // Senin, 3 September 2018
} 


// reference time (%A, %e %B %Y %H:%M:%S) -> http://php.net/manual/en/function.strftime.php#refsect1-function.strftime-parameters