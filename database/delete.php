<?php
    include_once("./connect.php");
    $tableName=$_POST['table'];
    $target = $_POST['data'];
    $result=$db->prepare("delete from $tableName where 	sc_className = :match");
    $result->bindValue('match',$target);
    $result->execute();
    // var_dump($_POST);
?>