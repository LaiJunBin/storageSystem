<?php
    include_once("./connect.php");
    $tableName=$_POST['table'];
    $target = $_POST['target'];
    $result=$db->prepare("select $target from $tableName ".$_POST['match']);
    $result->execute();
    $bool = $_POST['all'];
    $data = "";
    if($bool=="true"){
        while($record=$result->fetch(PDO::FETCH_ASSOC))
            $data .=$record[$target].",";
    }else{
        $data=(bool)$result->fetch(PDO::FETCH_ASSOC);
    }
    echo substr($data,0,-1);
?>