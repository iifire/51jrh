<?php
/**
 *  Í³Ò»ÅäÖÃ¶ÁÈ¡
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */

class ChooseType {
	const NONE = 0;
	const RANDOM = 1;
	const FIRST = 2;
}

class CommConfigInfo {
	const COMM_CONFIG_PATH = '/usr/local/commweb/cfg/CommConfig/';
	const COMM_CONFIG_MEMCACHE_PATH = '/usr/local/commweb/cfg/CommMemcache/';
	const DB_CONFIG_FILE = 'commconf_php.cfg';
	const IDIP_CONFIG_FILE = 'commconf_php.cfg';
	const CONDITION_CONFIG_FILE = 'commconf_php.cfg';
	const MEMCACHE_CONFIG_FILE = 'apps_memcache.cfg';
	const JF_SVR_CONFIG_FILE = 'jf_svr_conf_php.cfg';

	private static $configs = array ();

	private static $file = "";
	private static $node = "";
	private static $item = "";

	private static function file($file) {
		self :: $file = $file;
	}
	private static function node($node) {
		self :: $node = $node;
	}
	private static function item($item) {
		self :: $item = $item;
	}
	private static function result() {
		if (empty (self :: $file))
			return FALSE;

		$config = array ();
		if (isset ($configs[self :: $file])) {
			$config = $configs[self :: $file];
		} else {
			$config = parse_ini_file(self :: $file, true);
			$configs[self :: $file] = $config;
		}

		if (!empty (self :: $node) && !empty ($config)) {
			$config_node = $config[self :: $node];
			if (!empty (self :: $item) && !empty ($config_node)) {
				return $config_node[self :: $item];
			} else {
				return $config_node;
			}
		} else {
			return $config;
		}
	}
	private static function getInfo($node, $item = "") {
		self :: node($node);
		self :: item($item);
		return self :: result();
	}
	private static function randomConfig($config, $choose, $keys_per_item = 2) {
		$sum = array_values(array_slice($config, 0, 1));
		if (empty ($sum))
			return FALSE;
		$sum = intval($sum[0]);

		if ($choose == ChooseType :: FIRST) {
			return array_values(array_slice($config, 1, $keys_per_item));
		} else {
			$rand = mt_rand(0, $sum -1);
			return array_values(array_slice($config, ($rand * $keys_per_item) + 1, $keys_per_item));
		}
	}

	public static function GetDBInfo($node) {
		self :: file(self :: COMM_CONFIG_PATH . self :: DB_CONFIG_FILE);
		return array (
			'ip' => self :: getInfo($node, "db_ip"),
			'port' => self :: getInfo($node, "db_port")
		);
	}

	public static function GetDBProxyInfo($node) {
		self :: file(self :: COMM_CONFIG_PATH . self :: DB_CONFIG_FILE);
		return array (
			'ip' => self :: getInfo($node, "proxy_ip"),
			'port' => self :: getInfo($node, "proxy_port")
		);
	}

	public static function GetIDIPInfo($node = "default_idip", $choose = ChooseType :: RANDOM) {
		self :: file(self :: COMM_CONFIG_PATH . self :: IDIP_CONFIG_FILE);
		switch ($choose) {
			case ChooseType :: RANDOM :
			case ChooseType :: FIRST :
				{
					$config = self :: getInfo($node);
					$rand = self :: randomConfig($config, $choose);
					return array (
						'ip' => $rand[0],
						'port' => $rand[1]
					);
				}
			case ChooseType :: NONE :
				return self :: getInfo($node);
			default :
				return self :: getInfo($node);
		}
	}

	public static function GetConditionServerInfo($node = "default_condition", $choose = ChooseType :: RANDOM) {
		self :: file(self :: COMM_CONFIG_PATH . self :: CONDITION_CONFIG_FILE);
		switch ($choose) {
			case ChooseType :: RANDOM :
			case ChooseType :: FIRST :
				{
					$config = self :: getInfo($node);
					$rand = self :: randomConfig($config, $choose);
					return array (
						'ip' => $rand[0],
						'port' => $rand[1]
					);
				}
			case ChooseType :: NONE :
				return self :: getInfo($node);
			default :
				return self :: getInfo($node);
		}
	}

	public static function GetMemcacheInfo($node = "cacheserverlist", $choose = ChooseType :: NONE) {
		self :: file(self :: COMM_CONFIG_MEMCACHE_PATH . self :: MEMCACHE_CONFIG_FILE);
		switch ($choose) {
			case ChooseType :: RANDOM :
			case ChooseType :: FIRST :
				{
					$config = self :: getInfo($node);
					$rand = self :: randomConfig($config, $choose);
					return array (
						'ip' => $rand[0],
						'port' => $rand[1]
					);
				}
			case ChooseType :: NONE :
				return self :: getInfo($node);
			default :
				return self :: getInfo($node);
		}
	}
}