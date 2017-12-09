<?php
    $title = join(",",$_POST['title']);
    $value = join("','",$_POST['data']);
    $value = "'".$value."'";
    $tableName=$_POST['table'];
    include_once("./connect.php");
    $result=$db->prepare("INSERT INTO $tableName($title) VALUES ($value)");
    // $result->bindValue('val',$value);
    $result->execute();
    // var_dump($_POST);
?>