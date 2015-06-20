<?php
/**
 * ��ҳ��
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
class Pager {
	function Pager($options = array ()) {
		if (get_class($this) == 'pager') {
			eval ('$this = Pager::factory($options);');
		} else { //php5 is case sensitive
			$msg = 'Pager constructor is deprecated.' .
			' You must use the "Pager::factory($params)" method' .
			' instead of "new Pager($params)"';
			trigger_error($msg, E_USER_ERROR);
		}
	}

	function & factory($options = array ()) {
		$mode = (isset ($options['mode']) ? ucfirst($options['mode']) : 'Jumping');
		$classname = 'Pager_' . $mode;
		$classfile = 'Pager' . DIRECTORY_SEPARATOR . $mode . '.php';

		if (!class_exists($classname)) {
			include_once $classfile;
		}

		// If the class exists, return a new instance of it.
		if (class_exists($classname)) {
			$pager = new $classname ($options);
			return $pager;
		}

		$null = null;
		return $null;
	}
}
?>
