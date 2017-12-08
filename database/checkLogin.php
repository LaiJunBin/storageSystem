<?php
    if(isset($_POST['autoLoginValue']) && check($_POST['autoLoginValue'])){
        echo "true";
    }elseif(isset($_COOKIE['login']) && check($_COOKIE['login'])){
        echo "true";
    }else{
        echo "false";
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