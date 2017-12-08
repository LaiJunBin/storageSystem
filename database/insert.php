<?php
    $title = join(",",$_POST['title']);
    $value = join(",",$_POST['data']);
    $tableName=$_POST['table'];
    include_once("./connect.php");
    $result=$db->prepare("INSERT INTO :tableName(:title) VALUES (:value)");
	$result->bindValue('tableName',$tableName);
    $result->bindValue('title',$title);
    $result->bindValue('value',$value);
	$result->execute();
    // var_dump($result);
?>