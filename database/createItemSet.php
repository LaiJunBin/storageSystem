<?php
    include_once("./connect.php");
    $result=$db->prepare("select * from storage_itemlist");
    $result->execute();
    $bool = true;
    $n = 1;
    while($record=$result->fetch(PDO::FETCH_ASSOC)){
        if($n==1){
            echo "選擇物品：<br>";
        }
        $bool=false;
        ?>
            <input type="radio" va=<?php echo $record['si_item'];?> name="item" id="i<?php echo $n;?>" <?php if($n==1){ ?> checked <?php } ?>>
            <label for="i<?php echo $n;?>">
                <?php echo $record['si_item']."/".$record['si_unit'];?>
            </label>
            <!-- <br> -->
        <?php
        $n++;
    }
    if ($bool){
        echo "還沒有任何物品!";
    }
?>