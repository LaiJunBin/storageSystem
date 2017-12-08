<?php
    if(isset($_POST['autoLoginValue']) && check($_POST['autoLoginValue'])){
        echo (bool)true;
    }elseif(isset($_COOKIE['login']) && check($_COOKIE['login'])){
        echo (bool)true;
    }else{
        echo (bool)false;
    }
    return;
    function check($value){
        include_once("./connect.php");
        $result=$db->prepare("select * from loginData where l_checkUser = :username");
        $result->bindValue('username',$value);
        $result->execute();
        $record = $result->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
?>