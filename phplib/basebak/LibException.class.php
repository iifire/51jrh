<?php

//**********************************************************
// File name: exception.class.php
// Class name: LibException
// Author: gary
// Description: �쳣������
//**********************************************************
class LibException extends Exception {
	const DEFAULT_USER_VISIBLE_MSG = "ϵͳ��æ�����Ժ����ԣ�";

	// �ض��幹����ʹ message ��Ϊ���뱻ָ��������
	public function __construct($message, $code = 0) {
		//"/usr/local/xxx/yyy/abc.log"
		$this->file = basename($this->file); // $file is set to "abc.log"

		// ȷ�����б���������ȷ��ֵ
		parent :: __construct($message, $code);
	}

	// �Զ����ַ����������ʽ */
	public function __toString() {
		return "ErrNo:" . $this->code . " ErrMsg:" . $this->message;
	}

	public function GetUserVisibleMsg() {
		return self :: DEFAULT_USER_VISIBLE_MSG;
	}

}
?>
