<?php

//**********************************************************
// File name: ShmOpt.class.php
// Class name: ShmOpt
// Create date: 2011/11/03
// Update date: 2011/11/03
// Author: gary
// Description: 共享内存操作封装
//**********************************************************

class ShmOpt {
	const DEFAULT_SHM_SIZE = 1024;
	const DEFAULT_SHM_MODE = 0666;
	const DEFAULT_PROJ_ID = 1;

	private $_proj_id;
	private $_shm_size;
	private $_path_name;
	private $_shm_id;
	private $_shm_key;

	public function __construct($path_name, $proj_id = self :: DEFAULT_PROJ_ID, $shm_size = self :: DEFAULT_SHM_SIZE) {
		$this->_path_name = $path_name;
		$this->_proj_id = $proj_id;
		$this->_shm_size = $shm_size;
		$this->init();
	}

	public function init() {
		$this->_shm_key = $this->get_shm_key();
		if ($this->_shm_key === -1)
			return;
		$this->_shm_id = $this->shm_create($this->_shm_key, $this->_shm_size);
		if ($this->_shm_id === FALSE)
			return;
	}

	public function get_shm_key() {
		return ftok($this->_path_name, pack("c", $this->_proj_id));
	}

	public function get_shm_id() {
		return $this->_shm_id;
	}

	public function get_shm_status() {
		return intval($this->_shm_key);
	}

	public function shm_create($shm_key, $shm_size) {
		$shmid = $this->shm_open($shm_key);
		if (!$shmid) {
			if (!function_exists('shmop_open'))
				return FALSE;

			$shmid = shmop_open($shm_key, "n", self :: DEFAULT_SHM_MODE, $shm_size);
			if (!$shmid) {
				//printf( "failed to create shm %s(%d)\n ", posix_strerror(posix_errno()), posix_errno());
				return FALSE;
			}
		}
		return $shmid;
	}

	public function shm_open($shm_key) {
		if (!function_exists('shmop_open'))
			return FALSE;

		$shmid = @ shmop_open($shm_key, "w", 0, 0);
		if (!$shmid) {
			return FALSE;
		}
		return $shmid;
	}

	public function shm_write($shmid, $message, $offset = 0) {
		if (!function_exists('shmop_write'))
			return FALSE;

		if (!$shmid)
			return FALSE;
		return shmop_write($shmid, $message, $offset);
	}

	public function shm_read($shmid, $offset = 0, $size = self :: DEFAULT_SHM_SIZE) {
		if (!function_exists('shmop_read'))
			return FALSE;

		if (!$size)
			$size = shmop_size($shmid);
		return shmop_read($shmid, $offset, $size);
	}

	public function shm_close($shmid) {
		if (!function_exists('shmop_close'))
			return FALSE;

		if ($shmid < 0)
			return;
		shmop_close($shmid);
	}

	public function shm_destroy($shmid) {
		if (!function_exists('shmop_delete'))
			return FALSE;

		if ($shmid < 0)
			return;
		return shmop_delete($shmid);
	}
}
?>
