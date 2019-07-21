<?php
// Create Database connection

class DBconn
{
	private $host = '127.0.0.1';
	private $user = 'root';
	private $password = '';
	private $dbname = 'staff';
	private $conn;
	
	public function db_connection()
	{
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

		if ($this->conn->connect_error)
		{
			die('Connection to database could not be destabilised' . $this->conn->connect_error);
		}
		
		return $this->conn;
	}
}
?>