<?php
session_start();
// try{
//     $pdo=new pdo('mysql:host=localhost;dbname=smart_wallet2','root','');
// }catch(PDOExeption $e){
//     echo 'erreur'.$e->getMessage;
// }


class Database{

    private string $host = "localhost";
    private string $dbname = "smart_wallet2";
    private string $username = "root";
    private string $password = "";

    private  $pdo;

    function __construct(){
        try{
            $this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";",$this->username,$this->password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'erreur'.$e->getMessage();
        }
    }
    public function getConnection(){
        return $this->pdo;
    }

}
