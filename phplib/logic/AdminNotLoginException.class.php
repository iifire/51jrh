<?php

//**********************************************************
// File name: AdminNotLoginException.class.php
// Class name: AdminNotLoginException
// Create date: 2009/07/27
// Update date: 2009/07/27
// Author: garyzou
// Description: û�е�½�쳣������
//**********************************************************

/*
class Exception
{
 protected $message = 'Unknown exception'; // �쳣��Ϣ
 protected $code = 0; // �û��Զ����쳣����
 protected $file; // �����쳣���ļ���
 protected $line; // �����쳣�Ĵ����к�

 function __construct($message = null, $code = 0);

 final function getMessage(); // �����쳣��Ϣ
 final function getCode(); // �����쳣����
 final function getFile(); // ���ط����쳣���ļ���
 final function getLine(); // ���ط����쳣�Ĵ����к�
 final function getTrace(); // backtrace() ����
 final function getTraceAsString(); // �Ѹ�ɻ����ַ����� getTrace() ��Ϣ
 echo "�쳣��Ϣ��".$e->getMessage()."\\n"; //�����û��Զ�����쳣��Ϣ
 echo "�쳣���룺".$e->getCode()."\\n"; //�����û��Զ�����쳣����
 echo "�ļ�����".$e->getFile()."\\n"; //���ط����쳣��PHP�����ļ���
 echo "�쳣����������".$e->getLine()."\\n"; //���ط����쳣�Ĵ��������е��к�
 echo "����·�ߣ�";
 print_r($e->getTrace()); //��������ʽ���ظ����쳣ÿһ�����ݵ�·��
 echo $e->getTraceAsString(); //���ظ�ʽ�����ַ�����getTrace������Ϣ


 // �����صķ���
 function __toString(); // ��������ַ���
}

*/
class AdminNotLoginException extends Exception {
	const DEFAULT_USER_VISIBLE_MSG = "�Բ�����û�е�¼�����¼�����ԣ�";

	// �ض��幹����ʹ message ��Ϊ���뱻ָ��������
	public function __construct($message, $code = 0) {
		//"/usr/local/xxx/yyy/abc.log"
		$this->file = basename($this->file); // $file is set to "abc.log"
		//$file = basename ($path,".log"); // $file is set to "abc"

		// ȷ�����б���������ȷ��ֵ
		parent :: __construct($message, $code);
	}

	// �Զ����ַ����������ʽ */
	public function __toString() {
		//return __CLASS__ . " [$this->file:$this->line] $this->message ";

		//[2009-04-03 18:18:51] [DEBUG] [xxxxx.php:149] logmessage
		//$log = "[".date("Y-m-d H:i:s")."] [".__CLASS__."] [".$this->file.":".$this->line."] ErrNo:".$this->code." ErrMsg:".$this->message;
		return "ErrNo:" . $this->code . " ErrMsg:" . $this->message;
	}
	public function GetUserVisibleMsg() {
		return self :: DEFAULT_USER_VISIBLE_MSG;
	}

}
?>
