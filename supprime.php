<?php
include 'classUsers.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['delete_expenses'])){
        $idEx=$_POST['idEx'];
        $expenses = new expenses($pdo);
        $expenses->deleteEx($idEx);
    }

if(isset($_POST['delete_incomes'])){
    $idIn=$_POST['idIn'];
    $incomes = new Incomes($pdo);
    $incomes->deletIn($idIn);
}

}



