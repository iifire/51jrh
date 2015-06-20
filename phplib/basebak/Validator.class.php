<?php
/**
 * 验证异常类
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
class ValidateException extends Exception {
	private $validate_config;
	private $default_message;

	function __construct($validate_config) {
		$this->validate_config = array ();
		if (isset ($validate_config))
			$this->validate_config = $validate_config;
		$this->default_message = array (
			VALIDATE_ERROR_EXIST => "%name%不能为空",
			VALIDATE_ERROR_MIN => "%name%必须大于或等于%min%",
			VALIDATE_ERROR_MAX => "%name%必须小于或等于%max%",
			VALIDATE_ERROR_MINLEN => "%name%的长度必须大于或等于%minlen%",
			VALIDATE_ERROR_MAXLEN => "%name%的长度必须小于或等于%maxlen%",
			VALIDATE_ERROR_WRONG_FORMAT => "%name%的格式不正确",
			VALIDATE_ERROR_INCLUDE_VALUE => "无效的%name%",
			VALIDATE_ERROR_EXCLUDE_VALUE => "无效的%name%",
			VALIDATE_ERROR_CUSTOM => "%name%的格式不正确"
		);
		$msg = $this->validate_config["msg"];
		if (!isset ($msg))
			$msg = $this->default_message[$validate_config["type"]];
		foreach ($this->validate_config as $key => $value) {
			$msg = str_replace('%' . $key . '%', $value, $msg);
		}
		$this->message = $msg;
	}
	public function getField() {
		$field = $this->validate_config["field"];
		return (isset ($field) ? $field : "");
	}
	public function getFieldName() {
		$name = $this->validate_config["name"];
		return (isset ($name) ? $name : "");
	}
	public function getType() {
		$type = $this->validate_config["type"];
		return (isset ($type) ? $type : "");
	}
	public function getValue() {
		$value = $this->validate_config["value"];
		return (isset ($value) ? $value : "");
	}
}

class Validator {
	private $config;
	private $validator_config;
	private $custom_config;
	private $default_message;
	private $exception_list;
	private $stop_on_error;
	function __construct($config = array ()) {
		$this->config = $config;
		$this->validator_config = array (
			VALIDATE_DATATYPE_INT => '_validateInt',
			VALIDATE_DATATYPE_STRING => '_validateString',
			VALIDATE_DATATYPE_UIN => '_validateUin',
			VALIDATE_DATATYPE_EMAIL => '_validateEmail',
			VALIDATE_DATATYPE_URL => '_validateUrl',
			VALIDATE_DATATYPE_TEL => '_validateTel',
			VALIDATE_DATATYPE_MOBILE => '_validateMobile',
			VALIDATE_DATATYPE_ZIPCODE => '_validateZipCode',
			VALIDATE_DATATYPE_NUMBER => '_validateNumber',
			VALIDATE_DATATYPE_DATETIME => '_validateDatetime',
			VALIDATE_DATATYPE_CUSTOM => '_validateCustom'
		);
		$this->custom_config = array ();
		$this->exception_list = array ();
		$this->stop_on_error = false;
	}

	public function Validate($data) {
		$this->exception_list = array ();
		if (isset ($data)) {
			foreach ($this->config as $conf) {
				$field = $conf["field"];
				$datatype = $conf["datatype"];
				$required = $conf["required"];
				$include_values = $conf["include_values"];
				$exclude_values = $conf["exclude_values"];

				if (isset ($field) && isset ($datatype)) {
					$value = $data[$field];
					if (isset ($required) && $required == true) {
						$ret = $this->_validateExist($value, $conf);
						if (!$ret && $this->stop_on_error)
							return false;
					}

					if (isset ($include_values)) {
						$ret = $this->_validateIncludeValues($value, $conf);
						if (!$ret && $this->stop_on_error)
							return false;
					}
					if (isset ($exclude_values)) {
						$ret = $this->_validateExcludeValues($value, $conf);
						if (!$ret && $this->stop_on_error)
							return false;
					}
					if ($value == "")
						continue;

					$validator_config = $this->validator_config;
					$custom_config = $this->custom_config;

					$custom_validator = $custom_config[$datatype];
					if (isset ($value) && isset ($custom_validator) && is_callable($custom_validator)) {
						$ret = $custom_validator ($value, $conf);
						if (!$ret && $this->stop_on_error)
							return false;
					} else {
						$validator = $validator_config[$datatype];
						if (isset ($value) && isset ($validator)) {
							$ret = $this-> $validator ($value, $conf);
							if (!$ret && $this->stop_on_error)
								return false;
						}
					}
				} else {
					throw new Exception("field和datatype不能为空");
				}
			}
			if (!empty ($this->exception_list))
				return false;
		}
		return true;
	}

	public function AddConfig($config) {
		$this->config[] = $config;
	}

	public function GetErrorList() {
		return $this->exception_list;
	}

	public function SetStopError($stop) {
		if ($stop) {
			$this->stop_on_error = true;
		} else {
			$this->stop_on_error = false;
		}
	}

	public function RegisterValidator($type, $validator) {
		$this->custom_config[$type] = $validator;
	}

	private function _addError($exception) {
		array_push($this->exception_list, $exception);
	}

	private function _validateExist($data, $config) {
		if (!isset ($data) || $data == "") {
			$config["type"] = VALIDATE_ERROR_EXIST;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return true;
	}
	private function _validateInt($data, $config) {
		if (!(is_numeric($data) && ((int) $data) == $data)) {
			$config["type"] = VALIDATE_ERROR_WRONG_FORMAT;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return $this->_validateRange($data, $config);
	}
	private function _validateString($data, $config) {
		if (!is_string($data)) {
			$config["type"] = VALIDATE_ERROR_WRONG_FORMAT;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return $this->_validateLength($data, $config);
	}
	private function _validateUin($data, $config) {
		return $this->_validateRegexp($data, $config, '/^\d{5,10}$/');
	}
	private function _validateUrl($data, $config) {
		return $this->_validateRegexp($data, $config, '/^http:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/');
	}
	private function _validateEmail($data, $config) {
		return $this->_validateRegexp($data, $config, '/^(?:[\w-]+\.?)*[\w-]+@(?:[\w-]+\.)+[\w]{2,3}$/');
	}
	private function _validateTel($data, $config) {
		return $this->_validateRegexp($data, $config, '/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/');
	}
	private function _validateMobile($data, $config) {
		return $this->_validateRegexp($data, $config, '/^1[358]\d{9}$/');
	}
	private function _validateZipCode($data, $config) {
		return $this->_validateRegexp($data, $config, '/^(\d){6}$/');
	}
	private function _validateNumber($data, $config) {
		if (!$this->_validateRegexp($data, $config, '/^\d*$/')) {
			return false;
		}
		return $this->_validateLength($data, $config);
	}
	private function _validateDatetime($data, $config) {
		if ($data == "0000-00-00 00:00:00" || $data == "0000-00-00")
			return;
		$stamp = strtotime($data);
		if ($stamp == false) {
			$config["type"] = VALIDATE_ERROR_WRONG_FORMAT;
			$this->_addError(new ValidateException($config));
			return false;
		}

		$month = date('m', $stamp);
		$day = date('d', $stamp);
		$year = date('Y', $stamp);
		if (!checkdate($month, $day, $year)) {
			$config["type"] = VALIDATE_ERROR_WRONG_FORMAT;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return $this->_validateDatetimeRange($stamp, $config);
	}
	private function _validateCustom($data, $config) {
		$validator = $config["validator"];
		if (!$validator ($data, $config)) {
			$config["type"] = VALIDATE_ERROR_CUSTOM;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return true;
	}
	private function _validateRange($data, $config) {
		$min = $config["min"];
		$max = $config["max"];
		if ($min && $data < $min) {
			$config["type"] = VALIDATE_ERROR_MIN;
			$this->_addError(new ValidateException($config));
			return false;
		}
		if ($max && $data > $max) {
			$config["type"] = VALIDATE_ERROR_MAX;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return true;
	}
	private function _validateDatetimeRange($data, $config) {
		$min = strtotime($config["min"]);
		$max = strtotime($config["max"]);
		if ($min && $data < $min) {
			$config["type"] = VALIDATE_ERROR_MIN;
			$this->_addError(new ValidateException($config));
			return false;
		}
		if ($max && $data > $max) {
			$config["type"] = VALIDATE_ERROR_MAX;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return true;
	}
	private function _validateLength($data, $config) {
		$minlen = $config["minlen"];
		$maxlen = $config["maxlen"];
		$strlen = mb_strlen($data, "ASCII");
		if ($minlen && $strlen < $minlen) {
			$config["type"] = VALIDATE_ERROR_MINLEN;
			$this->_addError(new ValidateException($config));
			return false;
		}
		if ($maxlen && $strlen > $maxlen) {
			$config["type"] = VALIDATE_ERROR_MAXLEN;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return true;
	}
	private function _validateRegexp($data, $config, $regexp) {
		if (preg_match($regexp, $data) <= 0) {
			$config["type"] = VALIDATE_ERROR_WRONG_FORMAT;
			$this->_addError(new ValidateException($config));
			return false;
		}
		return true;
	}
	private function _validateIncludeValues($data, $config) {
		$values = $config["include_values"];
		foreach ($values as $value) {
			if ($value == $data)
				return true;
		}
		$config["type"] = VALIDATE_ERROR_INCLUDE_VALUE;
		$this->_addError(new ValidateException($config));
		return false;
	}
	private function _validateExcludeValues($data, $config) {
		$values = $config["exclude_values"];
		foreach ($values as $value) {
			if ($value == $data) {
				$config["type"] = VALIDATE_ERROR_EXCLUDE_VALUE;
				$this->_addError(new ValidateException($config));
				return false;
			}
		}
		return true;
	}
}
?>
