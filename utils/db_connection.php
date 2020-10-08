<?php
class Database
{
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "password";
    private $dbname = "mnkos_db";
    function __construct()
    {
    }
    
    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
            return;
        }
    }

    public function sanitize($var){
        $return = mysqli_real_escape_string($this->con, $var);
        return $return;
      }

    public function getConnection(){
        return $this->conn;
    }
}
