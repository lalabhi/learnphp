<?php 

class DbConnect{
    protected $host = null;
    protected $dbname = null;
    protected $urname = null;
    protected $password = null;
    public $conn;
    
     function __construct(){

        $this->host = 'localhost';
        $this->urname= 'root';
        $this->password= 'root';
        $this->dbname = 'loginapp';
        $this->conn = mysqli_connect($this->host,$this->urname,$this->password, $this->dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else{
            //echo "Connected successfully to server";
        }
        return($this->conn);
        }
    
}
?>