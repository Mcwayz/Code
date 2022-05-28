<?php

$dbuser="root";
$dbpass="";
$host="localhost";
$db="mwsc_it_helpdesk";
$mysqli = new mysqli($host,$dbuser, $dbpass, $db);

class DBconnection{

    protected $db;

 public function getConnection()
    {
       return $this->connect();
    }

  public function connect(){
   
    $conn = NULL;
        try{
            $conn = new PDO("mysql:host=localhost;dbname=mwsc_it_helpdesk", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage();
                }   
            $this->db = $conn;
            return $this->db;
    }
   
  }

?>