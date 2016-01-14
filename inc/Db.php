<?php
/**
 * Created by PhpStorm.
 * User: jay
 * Date: 14.01.16
 * Time: 12:07
 */

class Db
{
	private $_servername;
	private $_dbusername;
	private $_dbpassword;
	private $_dbName="chat";
	public  $conn;


	function __construct($_servername, $_dbusername, $_dbpassword, $_dbName){
		$this->getConfigData();
		$this->conn = mysqli_connect ( $this->_servername, $this->_dbusername, $this->_dbpassword, $this->_dbName);
	}
	protected function getConfigData(){
		$string = file_get_contents('config/config.ini');
		$arr = explode("::::", $string);
		$this->_servername = $arr[0];
		$this->_dbusername = $arr[1];
		$this->_dbpassword = $arr[2];

	}

	public function sqlQuery($sql){
		return mysqli_query($this->conn, $sql);
	}

	function __destruct() {
		return mysqli_close ( $this->conn );
	}
}