<?php

//**********************************************************
// File name: exception.class.php
// Class name: LibException
// Author: gary
// Description: 异常处理类
//**********************************************************
class LibException extends Exception {
	const DEFAULT_USER_VISIBLE_MSG = "系统繁忙，请稍后再试！";

	// 重定义构造器使 message 变为必须被指定的属性
	public function __construct($message, $code = 0) {
		//"/usr/local/xxx/yyy/abc.log"
		$this->file = basename($this->file); // $file is set to "abc.log"

		// 确保所有变量都被正确赋值
		parent :: __construct($message, $code);
	}

	// 自定义字符串输出的样式 */
	public function __toString() {
		return "ErrNo:" . $this->code . " ErrMsg:" . $this->message;
	}

	public function GetUserVisibleMsg() {
		return self :: DEFAULT_USER_VISIBLE_MSG;
	}

}
?>
