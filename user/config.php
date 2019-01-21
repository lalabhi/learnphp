<?php 

class DbConnect{
    protected $host = null;
    protected $dbname = null;
    protected $urname = null;
    protected $password = null;
    public $conn;
    
    public function DbConn($host, $user, $password, $dbname){

        $this->host = $host;
        $this->urname= $user;
        $this->password= $password;
        $this->dbname = $dbname;
        $this->conn = mysqli_connect($this->host,$this->urname,$this->password, $this->dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else{
            echo "Connected successfully to server";
        }
        
        return($this->conn);
        }
}
?>