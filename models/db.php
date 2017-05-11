<?php
/**
 * Created by PhpStorm.
 * User: thangnm
 * Date: 12/17/2016
 * Time: 8:44 PM
 */

class DB{

    public $servername = 'localhost';
    public $username = 'root';
    public $password = '';
    public $dbname = 'webbanhang';
    public $conn;
    public $table_name_error = 'Please check string query!';
    public $db_connect_error = 'Please check server info!';

    public function __construct()
    {

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($this->conn, 'utf8');
        if($this->conn->connect_errno){
            echo $this->db_connect_error; die;
        }
    }

    public function executeQuery($str_query){
        $rows = [];
        if($str_query){
            $result = $this->conn->query($str_query);
        }
        if($result && $result->num_rows > 0){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
//            echo $this->table_name_error;die;
        }
        return $rows;
    }

    //insert new record
    public function insertNew($str_query){
        $result = $this->conn->query($str_query);
        return $result;
    }


    //count Rows
    public function countRow($str_query){
        $result = $this->conn->query($str_query);
        $result_row = $result->num_rows;
        return $result_row;
    }

    //delete record - gửi lên server
    public function delete($str_query){
        $result = $this->conn->query($str_query);
        return $result;
    }

    public function updateQuery($str_query){
        $result = $this->conn->query($str_query);
        return $result;
    }
}
//$db = new DB();
?>