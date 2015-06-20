<?php

require_once dirname(__FILE__).'/common.php';
require_once dirname(__FILE__).'/../lib/httpsqs_client.php';
require_once dirname(__FILE__).'/../exception/seriousException.class.php';
require_once dirname(__FILE__).'/../exception/normalException.class.php';

class MyServer extends httpsqs{
	//改成习惯的方法名，对http_get和http_post添加抛出异常

	public function __construct($server_name){
		$config = get_queue_config();
		$host = $config[$server_name]['httpsqs_host'];
		$port = $config[$server_name]['httpsqs_port'];
		$auth = $config[$server_name]['httpsqs_auth'];
		$charset = $config[$server_name]['httpsqs_charset'];
		unset($config);
		parent::__construct($host, $port, $auth, $charset);
	}

	public function http_getn($query)        //By georgehuang
	{
		$socket = fsockopen($this->httpsqs_host, $this->httpsqs_port, $errno, $errstr, 5);
		if (!$socket)
		{
			throw new SeriousException(SOCKET_OPEN_ERROR, SOCKET_OPEN_ERROR_CODE);
			return false;
		}
		$host = $this->httpsqs_host;
		$out = "GET ${query} HTTP/1.1\r\n";
		$out .= "Host: ${host}\r\n";
		$out .= "Connection: close\r\n";
		$out .= "\r\n";
		$frst = fwrite($socket, $out);
		if (!$frst)
		{
			throw new SeriousException(SOCKET_WRITE_ERROR, SOCKET_WRITE_ERROR_CODE);
			return false;
		}

		$line = trim(fgets($socket));
		$header = $line;
		list($proto, $rcode, $result) = explode(" ", $line);
		$len = -1;
		$pos_value = 0;
		while (($line = trim(fgets($socket))) != "")
		{
			$header .= $line;
			if (strstr($line, "Content-Length:"))
			{
				list($cl, $len) = explode(" ", $line);

			}
			if (strstr($line, "Pos:"))
			{
				list($pos_key, $pos_value) = explode(" ", $line);
			}
			if (strstr($line, "Connection: close"))
			{
				$close = true;
			}
		}
		if ($len < 0)
		{
			throw new SeriousException(CONTENT_LEN_ERROR, CONTENT_LEN_ERROR_CODE);
			return false;
		}

		$body = fread($socket, $len);
		if (!$body)
		{
			throw new SeriousException(SOCKET_READ_ERROR, SOCKET_READ_ERROR_CODE);
			return false;
		}
		$fread_times = 0;
		while(strlen($body) < $len){
			$body1 = fread($socket, $len);
			if (!$body1)
			{
				throw new SeriousException(SOCKET_READ_ERROR, SOCKET_READ_ERROR_CODE);
				return false;
			}
			$body .= $body1;
			unset($body1);
			if ($fread_times > 100) {
				break;
			}
			$fread_times++;
		}

		fclose($socket);
		return $body;
    }

    public function http_get($query){
    	//重写这个方法，添加抛出异常
    	$socket = fsockopen($this->httpsqs_host, $this->httpsqs_port, $errno, $errstr, 5);
    	if (!$socket)
    	{
    		throw new SeriousException(SOCKET_OPEN_ERROR, SOCKET_OPEN_ERROR_CODE);
    		return false;
    	}
    	$host = $this->httpsqs_host;
    	$out = "GET ${query} HTTP/1.1\r\n";
    	$out .= "Host: ${host}\r\n";
    	$out .= "Connection: close\r\n";
    	$out .= "\r\n";
    	$frst = fwrite($socket, $out);
    	if (!$frst)
    	{
    		throw new SeriousException(SOCKET_WRITE_ERROR, SOCKET_WRITE_ERROR_CODE);
    		return false;
    	}
    	$line = trim(fgets($socket));
    	$header = $line;
    	list($proto, $rcode, $result) = explode(" ", $line);
    	$len = -1;
    	$pos_value = 0;
    	while (($line = trim(fgets($socket))) != "")
    	{
    		$header .= $line;
    		if (strstr($line, "Content-Length:"))
    		{
    			list($cl, $len) = explode(" ", $line);
    		}
    		if (strstr($line, "Pos:"))
    		{
    			list($pos_key, $pos_value) = explode(" ", $line);
    		}
    		if (strstr($line, "Connection: close"))
    		{
    			$close = true;
    		}
    	}
    	if ($len < 0)
    	{
    		throw new SeriousException(CONTENT_LEN_ERROR, CONTENT_LEN_ERROR_CODE);
    		return false;
    	}

    	$body = fread($socket, $len);
    	if (!$body)
    	{
    		throw new SeriousException(SOCKET_READ_ERROR, SOCKET_READ_ERROR_CODE);
    		return false;
    	}
    	$fread_times = 0;
    	while(strlen($body) < $len){
    		$body1 = fread($socket, $len);
    		if (!$body1)
    		{
    			throw new SeriousException(SOCKET_READ_ERROR, SOCKET_READ_ERROR_CODE);
    			return false;
    		}
    		$body .= $body1;
    		unset($body1);
    		if ($fread_times > 100) {
    			break;
    		}
    		$fread_times++;
    	}
    	$test_body = fread($socket, 10);
    	//echo "test:${test_body};test end\r\n";
    	//if ($close) fclose($socket);
    	fclose($socket);
    	$result_array["pos"] = (int)$pos_value;
    	$result_array["data"] = $body;
    	return $result_array;
	}

	public function http_post($query, $body){
		//重写这个方法，添加抛出异常
		$socket = fsockopen($this->httpsqs_host, $this->httpsqs_port, $errno, $errstr, 1);
		if (!$socket)
		{
			throw new SeriousException(SOCKET_OPEN_ERROR, SOCKET_OPEN_ERROR_CODE);
			return false;
		}
		$host = $this->httpsqs_host;
		$out = "POST ${query} HTTP/1.1\r\n";
		$out .= "Host: ${host}\r\n";
		$out .= "Content-Length: " . strlen($body) . "\r\n";
		$out .= "Connection: close\r\n";
		$out .= "\r\n";
		$out .= $body;
		$frst = fwrite($socket, $out);
		if (!$frst)
		{
			throw new SeriousException(SOCKET_WRITE_ERROR, SOCKET_WRITE_ERROR_CODE);
			return false;
		}
		$line = trim(fgets($socket));
		$header = $line;
		list($proto, $rcode, $result) = explode(" ", $line);
		$len = -1;
		$pos_value = 0;
		while (($line = trim(fgets($socket))) != "")
		{
			$header .= $line;
			if (strstr($line, "Content-Length:"))
			{
				list($cl, $len) = explode(" ", $line);
			}
			if (strstr($line, "Pos:"))
			{
				list($pos_key, $pos_value) = explode(" ", $line);
			}
			if (strstr($line, "Connection: close"))
			{
				$close = true;
			}
		}
		//		echo $header;
		if ($len < 0)
		{
			throw new SeriousException(CONTENT_LEN_ERROR, CONTENT_LEN_ERROR_CODE);
			return false;
		}
		$body = fread($socket, $len);
		if (!$body)
		{
			throw new SeriousException(SOCKET_READ_ERROR, SOCKET_READ_ERROR_CODE);
			return false;
		}
		//if ($close) fclose($socket);
		fclose($socket);
		$result_array["pos"] = (int)$pos_value;
		$result_array["data"] = $body;
		return $result_array;
	}

	public function put_msg($queue_name, $queue_data){
		//队列满时抛出异常
		$rst = $this->put($queue_name, $queue_data);
		if ($rst === 'HTTPSQS_PUT_END'){
			throw new NormalException(QUEUE_FULL_ERROR, QUEUE_FULL_ERROR_CODE);
		}
		return $rst;
	}

	public function getn_msg($queue_name, $count, &$array){
		//取多个消息
		$rst = '';
        $m = intval($count/1000);
        $n = $count%1000;
        for ($i=0; $i<$m; $i++){
            $str = $this->http_getn("/?auth=".$this->httpsqs_auth."&charset=".
            $this->httpsqs_charset."&name=".$queue_name."&opt=getn&num=1000");
            if ($str == false || $str === 'HTTPSQS_ERROR') {
                return false;
            }
            $rst .= $str;
        }
        if ($n > 0){
            $str = $this->http_getn("/?auth=".$this->httpsqs_auth."&charset=".
            $this->httpsqs_charset."&name=".$queue_name."&opt=getn&num=".strval($n));
            if ($str == false || $str === 'HTTPSQS_ERROR') {
                return false;
            }
            $rst .= $str;
        }
        $rst_array = explode(";;_div_;;", $rst);
        $len = count($rst_array);
        $array = array_slice($rst_array, 0, --$len);
        return $len;
	}

	public function get_msg_content($queue_name, $socket){
		$result = $this->http_get("/?auth=".$this->httpsqs_auth."&charset=".
		$this->httpsqs_charset."&name=".$queue_name."&opt=get");
		if ($result == false || $result["data"] == "HTTPSQS_ERROR" || $result["data"] == false) {
			return false;
		}
		return $result["data"];
	}

	public function get_queue_status($queue_name){
		return $this->status($queue_name);
	}

	public function get_queue_status_json($queue_name){
		return $this->status_json($queue_name);
	}
	
	public function get_unread_count($queue_name){
		$rst = json_decode($this->status_json($queue_name));
		return $rst->unread;
	}

	public function view_msg($queue_name, $queue_pos){
		return $this->view_msg($queue_name, $queue_pos);
	}

	public function reset_queue($queue_name){
		return $this->reset($queue_name);
	}

	public function set_queue_max_length($queue_name, $num){
		return $this->maxqueue($queue_name, $num);
	}

	public function set_sync_time($num){
		return $this->synctime($num);
	}
}

?>