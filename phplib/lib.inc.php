<?php
/**
 * 通用库和函数
 */
$libdir = ROOT_PATH . DS . 'phplib';
require_once $libdir . '/libdefines.inc.php';

if (ENVIRONMENT === 'development') {
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	ini_set('display_errors', 1);
}
function __autoload($classname) {
	global $libdir;
	$basefile = $libdir . '/base/' . $classname . '.class.php';
	$logicfile = $libdir . '/logic/' . $classname . '.class.php';
	$smartyfile = $libdir . '/smarty/' . $classname . '.class.php';
	if (file_exists($basefile)) {
		require $basefile;
		//echo 'require ['.$basefile.'] success!<br/>';
	} else
		if (file_exists($logicfile)) {
			require $logicfile;
			//echo 'require ['.$logicfile.'] success!<br/>';
		} else
			if (file_exists($smartyfile)) {
				require $smartyfile;
				//echo 'require ['.$smartyfile.'] success!<br/>';
			}

}

//传入一个自定义的应用类名称
function RUN_APP($CGI_APP_TYPE) {
	$evalstr = "\$app = new $CGI_APP_TYPE();";
	//echo $evalstr."<br/>";
	eval ($evalstr);
	$app->Run();
}

function g_iconv($in_charset, $out_charset, $str) {
	return iconv($in_charset, $out_charset, $str);
}

function G_INIT_LOGGER($logtype = ROLL_FILE_LOGGER, $dir = NULL, $filename = NULL, $maxsize = DEFAULT_LOG_MAX_SIZE, $filenum = DEFALUT_LOG_SAVE_NUM) {
	Logger :: Instance()->initLogger($logtype, $dir, $filename, $maxsize, $filenum, $maxsize, $filenum);
}

function G_SET_NULL_LOGGER($loglevel) {
	Logger :: Instance()->setNullLoger($loglevel);
}

function G_LOG($codefilename, $codefileline, $loglevel, $log) {
	Logger :: Instance()->writeLog($codefilename, $codefileline, $loglevel, $log);
}

function G_LOG_PLAT($codefilename, $codefileline, $loglevel, $actid, $platname, $log) {
	Logger :: Instance()->writePlatLog($codefilename, $codefileline, $loglevel, $actid, $platname, $log);
}

function G_EVENT($begin_time, $end_time, $id, $result) {
	$res = '0x' . sprintf('%x', $result);
	$msg = "$begin_time || $end_time || $id || $res";
	$inBufLen = strlen($msg);
	$_udpLogPlat = new UdpLogger("10.157.1.28", 6666);
	$_udpLogPlat->setLogType(0x01);
	$_udpLogPlat->setPlatName("PHP");
	$_udpLogPlat->setSuccFlag($result);
	$_udpLogPlat->logComm(intval($id), $begin_time, $end_time, $msg);
	return 0;
}
?>