<?php
require_once '/usr/local/ieod-web/php/oss/osslib.inc.php';
require_once dirname(__FILE__).'/../../lib/common.php';

define( 'CONFIG_PATH', dirname(__FILE__).'/../../../config/global.cfg' );
define('QUEUE_CONFIG_PATH', dirname(__FILE__).'/../config/queue_config.cfg');
define ('DIR_WORD', '-_-');
define('QUEUE_DEBUG', false);
define('FILE_MAX_LENGTH', 5*1024*1024);

//一般异常消息
define ('QUEUE_FULL_ERROR',		"Error occured when put msg because queue is full");
define ('GET_MSG_ERROR',		"Msg got not correct");
define ('STORE_MSG_ERROR',		"Msg stored not correct");
//一般异常code
define ('QUEUE_FULL_ERROR_CODE',		1);
define ('GET_MSG_ERROR_CODE',			2);
define ('STORE_MSG_ERROR_CODE',			3);

//严重异常消息
define('SOCKET_OPEN_ERROR',		"Error occured when open socket");
define('SOCKET_WRITE_ERROR',	"Error occured when write to socket");
define('CONTENT_LEN_ERROR',		"Error occured when get socket content length");
define('SOCKET_READ_ERROR',		"Error occured when read from socket");
//一般异常code
define('SOCKET_OPEN_ERROR_CODE',		 -1);
define('SOCKET_WRITE_ERROR_CODE',		 -2);
define('CONTENT_LEN_ERROR_CODE',		 -3);
define('SOCKET_READ_ERROR_CODE',		 -4);

//异常code数组
define ('SERIOUS_CODES', '	SOCKET_OPEN_ERROR_CODE,
							SOCKET_WRITE_ERROR_CODE,
							CONTENT_LEN_ERROR_CODE,
							SOCKET_READ_ERROR_CODE
							');
define ('NORMAL_CODES', '	QUEUE_FULL_ERROR_CODE,
							GET_MSG_ERROR_CODE,
							STORE_MSG_ERROR_CODE
							');
//异常消息数组
define ('SERIOUS_MSGS', '	SOCKET_OPEN_ERROR,
							SOCKET_WRITE_ERROR,
							CONTENT_LEN_ERROR,
							SOCKET_READ_ERROR
							');
define ('NORMAL_MSGS', '	QUEUE_FULL_ERROR,
							GET_MSG_ERROR,
							STORE_MSG_ERROR
							');

define ('MQ_LOG_PATH', dirname(dirname(__FILE__))."/log");
define ('MQ_LOG_FILE', "msg_queue.log");
define ('ERROR_LOG_PATH', dirname(dirname(__FILE__))."/log");
define ('ERROR_LOG_FILE', "queue_error.log");

//消息类别标识
define ('TYPE0', 'click_now');
define ('TYPE1', 'click');
define ('TYPE2', 'pop');
define ('TYPE3', 'click_area');
define ('TYPE4', 'pop_area');
define ('TYPE5', 'pop_var');
define ('TYPE6', 'click_var');

//需要存到gpm2的消息类型

function get_queue_config(){
	global $g_queue_config;
	if(!isset($g_queue_config)){
		$g_queue_config = parse_ini_file(QUEUE_CONFIG_PATH, true);
	}
	return $g_queue_config;
}

function get_time ($start, $end){
	$starttime = explode(" ",$start);
	$endtime = explode(" ",$end);
	$totaltime = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost = sprintf("%s",$totaltime);
	return $timecost;
}

function queue_out_put($var){
	if (is_array($var)){
		print_r($var);
	}elseif (is_string($var)){
		echo $var."\r\n";
	}else{}
}

?>