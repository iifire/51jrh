<?php

//**********************************************************
// File name: StringTools.class.php
// Class name: StringTools
// Create date: 2011/12/15
// Update date: 2011/12/15
// Author: gary
// Description: �ַ�������
//**********************************************************

class StringTools {
	public static function HexDecode($src, $decorator = "%") {
		$res = "";
		$len = strlen($src);
		for ($i = 0; $i < $len; ++ $i) {
			if ($decorator == "") {
				if (($len - $i) >= 2 && ctype_alnum($src[$i]) && ctype_alnum($src[$i +1])) {
					$res .= pack("H*", substr($src, $i, 2));
					++ $i;
				} else {
					$res .= $src[$i];
				}
			} else
				if ($src[$i] == $decorator && ($len - $i) > 2) {
					if (ctype_alnum($src[$i +1]) && ctype_alnum($src[$i +2])) {
						++ $i;
						$res .= pack("H*", substr($src, $i, 2));
						++ $i;
					} else {
						$res .= $decorator;
					}
				} else {
					$res .= $src[$i];
				}
		}
		return $res;
	}
}
?>
