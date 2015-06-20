<?php

//**********************************************************
// File name: AppException.class.php
// Class name: OssException
// Create date: 2009/04/08
// Update date: 2009/04/08
// Author: garyzou
// Description: �쳣������
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

class AppException extends Exception {
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
		return "ErrNo:" . $this->code . " ErrMsg:" . $this->message;
	}
}
?>
