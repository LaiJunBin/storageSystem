<?php
    include_once("./connect.php");
    $tableName=$_POST['table'];
    $title = $_POST['title'];
    $target = $_POST['data'];
    $result=$db->prepare("delete from $tableName where 	$title = :match");
    $result->bindValue('match',$target);
    $result->execute();
    var_dump($_POST);
?>