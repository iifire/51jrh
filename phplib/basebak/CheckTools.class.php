<?php
/**
 *  check工具源文件
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
define('DIRTY_WORDS_LIST_FILE', "/usr/local/oss_dev/config/dirty.txt");
class CheckTools {
	public static function IsDirtyWords($src, $dirtyfile = "") {
		$handle = @ fopen(DIRTY_WORDS_LIST_FILE, "r");
		if ($handle) {
			while (!feof($handle)) {
				$line = trim(fgets($handle, 32));
				if (empty ($line)) {
					continue;
				}
				if (stristr($src, $line)) {
					return true;
				}
			}
		}

		if (file_exists($dirtyfile)) {
			$handle = @ fopen($dirtyfile, "r");
			if ($handle) {
				while (!feof($handle)) {
					$line = trim(fgets($handle, 32));
					if (empty ($line)) {
						continue;
					}
					if (stristr($src, $line)) {
						return true;
					}
				}
			}
		}

		return false;
	}

	public static function CheckRefererByHost($domain = "qq.com") {
		$referer = $_SERVER["HTTP_REFERER"];
		if (!$referer)
			return false;
		$host = parse_url($referer, PHP_URL_HOST);
		if (!$host)
			return false;

		if (preg_match('/' . $domain . '/', $referer) <= 0) {
			return false;
		}
	}
}
?>