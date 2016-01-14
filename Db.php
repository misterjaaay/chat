<?php
/**
 * Created by PhpStorm.
 * User: jay
 * Date: 14.01.16
 * Time: 12:07
 */

class Db {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;

	function __construct($params=array()) {
		$this->conn = false;
		$this->host = 'localhost';
		$this->user = 'root';
		$this->password = '1';
		$this->baseName = 'chat';
		$this->connect();
	}


	function __destruct() {
		$this->disconnect();
	}
}