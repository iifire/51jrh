<?php
/**
 * @author gary (yanggaojiao@qq.com)
 * @date 2015-5-15 
 */
ini_set('display_errors', 'on');
error_reporting(E_ERROR);
#error_reporting(E_ALL);

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('ROOT_PATH', dirname(__FILE__));
define('TMP_PATH', ROOT_PATH . '/tmp/');
define('SHELL_PATH', ROOT_PATH . '/shell/');

if (DEBUG) {
	define('HOST', 'http://localhost/myframework/');
} else {
	define('HOST', 'http://localhost/myframework/');
}
define('MEDIA_PATH', HOST . 'media/');
define('JS_PATH', MEDIA_PATH . 'js/');
define('CSS_PATH', MEDIA_PATH . 'css/');
define('IMG_PATH', MEDIA_PATH . 'images/');
define('UPLOAD_PATH', MEDIA_PATH . 'upload/');
define('CONFIG_PATH', ROOT_PATH . '/config/global.cfg');

require_once 'phplib/lib.inc.php';
require_once 'phplib/smarty/Smarty.class.php';
require_once 'lib/common.php';
require_once 'lib/constant.inc.php';

autoLoadFile(ROOT_PATH . '/lib/', '*.class.php');
autoLoadFile(ROOT_PATH . '/dao/base/', '*.php');
autoLoadFile(ROOT_PATH . '/dao/', '*.php');

if (!isset ($__noSmarty) && !isset ($TPL)) {
	$TPL = new Smarty;
	$TPL->template_dir = ROOT_PATH . '/tpl';
	$TPL->compile_dir = TMP_PATH . '/tpl_c';
	$TPL->cache_dir = TMP_PATH . '/cache';
	$TPL->assign('constant', get_defined_constants());
}

function p_autoload($class) {
	$classFileName = $class . '.php';
	$path = ROOT_PATH . '/module/';
	$paths = array (
		$path,
	);
	foreach ($paths as $path) {
		$classFile = $path . '/' . $classFileName;
		if (file_exists($classFile)) {
			require_once $classFile;
			return true;
		}
	}
	return false;
}
spl_autoload_register('p_autoload');
spl_autoload_register('__autoload');
?>
