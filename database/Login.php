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
    setCookie("login",md5($record['l_username']),time()+3600);
    echo md5($record['l_username']);
?>