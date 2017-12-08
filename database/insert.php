<?php
    $title = join(",",$_POST['title']);
    $value = join(",",$_POST['data']);
    $tableName=$_POST['table'];
    include_once("./connect.php");
    $result=$db->prepare("INSERT INTO $tableName($title) VALUES (:value)");
    $result->bindValue('value',$value);
	$result->execute();
?>