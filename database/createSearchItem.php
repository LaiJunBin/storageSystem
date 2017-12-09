<?php
    include_once("./connect.php");
    $classSQL=$db->prepare("select * from storage_classlist");
    $classSQL->execute();
    while($classRecord=$classSQL->fetch(PDO::FETCH_ASSOC)){
        $searchSQL=$db->prepare("select * from storage_record where sr_location = :class");
        $searchSQL->bindValue("class",$classRecord['sc_className']);
        $searchSQL->execute();
        $bool=true;
        echo "<h3>".$classRecord['sc_className']."</h3>";
        echo "<div>";
        echo "<table border=1 align=center width=100%>";
        while($record=$searchSQL->fetch(PDO::FETCH_ASSOC)){
            $bool=false;
            echo "<tr>";
            echo "<td>".$record['sr_item']."</td>";
            echo "<td width=30%>".$record['sr_amount']." ".$record['sr_unit']."</td>";
            //echo "<td>".."</td>";
            echo "</tr>";
        }
        echo "</table>";
        if($bool){
            echo "這間教室沒有東西!";
        }
        echo "</div>";
    }
?>