<?php

//**********************************************************
// File name: DateTime.class.php
// Class name: DateTime
// Create date: 2011/03/25
// Update date: 2011/03/25
// Author: gary
// Description: Ê±¼ä¼ÆËã
// Example:
//**********************************************************

class Time {
	/*
	public function __construct($time) {
	$this->time = $time;
	}
	*/

	public static function GetCurTime() {
		list ($usec, $sec) = explode(" ", microtime());
		return strftime('%Y-%m-%d %H:%M:%S', $sec) . ':' . $usec * 1000 * 1000;
	}
}
?>
