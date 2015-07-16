<?php namespace App;

class Helpers {

	public static function getResiStatus($status){
		switch($status){
			case 0 : return 'Pending';break;
			case 1 : return 'Muat';break;
			default: return 'Status tidak diketahui';
		}
	}

	public static function getQuoteStatus($status){
		switch($status){
			case 0 : return 'Pending';break;
			case 1 : return 'Process';break;
			default: return 'Status tidak diketahui';
		}
	}
}