<?php
    include_once("./connect.php");
    $result=$db->prepare("select * from loginData where l_username = :username");
	$result->bindValue('username',$_POST['username']);
	$result->execute();
    $record = $result->fetch(PDO::FETCH_ASSOC);
    $password = md5($_POST['password']);
    if(!$record || $record['l_password']!=$password){
        echo "false";
        return;
    }
    $value = md5($record['l_username']);
    setCookie("login",$value,time()+3600);
    echo $value;
?>