<?php
/**
 *  CGIÊä³ö²Ù×÷Àà
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
define('WT_SELF', 0);
define('WT_PARENT', 1);
define('WT_TOP', 2);

function ConvertWinowTypeToString($iWinType) {
	switch ($iWinType) {
		case WT_SELF :
			return "self";
		case WT_TOP :
			return "top";
		case WT_PARENT :
			return "parent";
		default :
			return "self";
	};
}

class CGIOutput {
	const DEFAULT_CONTENT_TYPE = "text/html";
	const DEFAULT_DOMAIN = "qq.com";

	public function SetContentType($sContentType = self :: DEFAULT_CONTENT_TYPE) {
		return $this->SetHeaderContent("Content-Type", $sContentType);
	}

	public function SetCacheSec($iSecond = 3600) {
		return $this->SetHeaderContent("Cache-Control", "max-age=" . $iSecond);
	}

	public function SetCookie($sName, $sValue, $iExpireSec = 0, $sDomain = NULL, $sPath = "/", $bSecure = false) {
		if ($sDomain == NULL)
			$sDomain = $_SERVER["SERVER_NAME"];
		$sNameRep = $sName;
		$sNameRep = str_replace(";", "%3B", $sNameRep);
		$sNameRep = str_replace("=", "%3D", $sNameRep);
		$ssCookie = $sNameRep . "=" . CookieCoder :: Encode($sValue);

		if ($iExpireSec != 0) {
			$tTime = time() + $iExpireSec;
			$ssCookie .= gmdate("%a, %d %b %Y %H:%M:%S %Z", $tTime);
		}

		if (!$sPath != "") {
			$ssCookie .= " path=" . $sPath . ";";
		}

		if (!$sDomain != "") {
			$ssCookie .= " domain=" . $sDomain . ";";
		}

		if ($bSecure) {
			$ssCookie .= " secure;";
		}

		return $this->HandleHeader("Set-Cookie", $ssCookie);
	}

	public function ClearCookie($sName, $sDomain = NULL, $sPath = "/") {
		if ($sDomain == NULL)
			$sDomain = $_SERVER["SERVER_NAME"];
		return SetCookie($sName, "", -86400 * 365, $sDomain, $sPath);
	}

	public function SetHeader($sName, $sValue) {
		if ($this->m_bIsHeaderEnd == true) {
			throw new OssException("set http header [$sName: $sValue] error.\n");
		}
		$this->SetHeaderContent($sName, $sValue);
	}

	public function EndHeader() {
		if ($this->m_bIsHeaderEnd == false) {
			foreach ($this->m_mHeadInfo as $key => $value) {
				$this->HandleHeader($key, $value);
			}
			unset ($this->m_mHeadInfo);
			$this->m_pOutputStream .= "\r\n";
			$this->m_bIsHeaderEnd = true;
			return $this->m_pOutputStream;
		}
		return "";
	}

	public function GetOutputStream() {
		return $this->EndHeader();
	}

	public function MessageBox($sMsg) {
		//echo "asdfasd fasdf"."<br/>";
		//echo $sMsg."<br/>";
		$out = $this->GetOutputStream();
		//$sMsg = oss_iconv(ICONV_FROM, ICONV_TO, $sMsg);
		$out .= "<script>alert('" . $sMsg . "');</script>\r\n";
		echo $out;
	}

	public function GoUrl($sUrl = "", $iWinType = WT_SELF) {
		if ($sUrl == "") {
			$this->GoHistory(-1, $iWinType);
			return;
		}
		$out = $this->GetOutputStream();
		$out .= "<script>location.href='" . $sUrl;
		$StartPos = strpos($sUrl, "?", 0);
		if ($StartPos === false) {
			$out .= "?PcacheTime=" . time();
		} else {
			$out .= "&PcacheTime=" . time();
		}

		$out .= "'</script>\r\n";
		echo $out;
		return;
	}

	public function GoHistory($iIndex, $iWinType = WT_SELF) {
		$out = $this->GetOutputStream();
		$out .= "<script>" . ConvertWinowTypeToString($iWinType) . ".history.go(" . $iIndex . ");</script>\r\n";
		echo $out;
		return;
	}

	public function CloseWindow($iWinType = WT_SELF) {
		$out = $this->GetOutputStream();
		$out .= "<script>" . ConvertWinowTypeToString($iWinType) . ".close();</script>\r\n";
		echo $out;
		return;
	}

	public function Refresh($iWinType = WT_SELF, $bUseCache = true) {
		$out = $this->GetOutputStream();
		if ($bUseCache) {
			$out .= "<script>" . ConvertWinowTypeToString($iWinType) . ".location=";
			$out .= ConvertWinowTypeToString($iWinType) << ".location;";
			$out .= "</script>\r\n";
		} else {
			$out .= "<script>";
			$out .= ConvertWinowTypeToString($iWinType) << ".location.reload(true)";
			$out .= "</script>\r\n";
		}
		echo $out;
		return;
	}

	function __construct() {
		$this->m_mHeadInfo = array ();
	}

	function __destruct() {
	}

	private function SetHeaderContent($sTarget, $sValue) {
		$this->m_mHeadInfo[$sTarget] = $sValue;
		if (array_key_exists($param, $this->m_mHeadInfo)) {
			return 0;
		}
		return -1;
	}

	private function HandleHeader($sName, $sValue) {
		if ($this->m_bIsHeaderEnd == true) {
			throw new OssException("set http header [$sName: $sValue] error.\n");
		}
		$this->m_pOutputStream .= $sName . ": " . $sValue . "\r\n";
		return 0;
	}

	private $m_bIsHeaderEnd;
	private $m_fd;
	private $m_pOutputStream;
	private $m_mHeadInfo;
};

class CookieCoder {
	public static function Encode($sSrc) {
		preg_match_all("/[\x80-\xff].|[\x01-\x7f]+/", $str, $r);
		$ar = $r[0];
		foreach ($ar as $k => $v) {
			if (ord($v[0]) < 128) {
				$ar[$k] = rawurlencode($v);
			} else {
				$ar[$k] = "%u" . bin2hex(iconv("GB2312", "UCS-2", $v));
			}
		}
		return join("", $ar);
	}

	public static function Decode($sSrc) {
		$str = rawurldecode($str);
		preg_match_all("/(?:%u.{4})|.+/", $str, $r);
		$ar = $r[0];
		foreach ($ar as $k => $v) {
			if (substr($v, 0, 2) == "%u" && strlen($v) == 6) {
				$ar[$k] = iconv("UCS-2", "GB2312", pack("H4", substr($v, -4)));
			}
		}
		return join("", $ar);
	}
};
?>