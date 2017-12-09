<?php
    include_once("./connect.php");
    $result=$db->prepare("select sc_className from storage_classlist");
    $result->execute();
    $bool = true;
    $n = 1;
    while($record=$result->fetch(PDO::FETCH_ASSOC)){
        if($n==1){
            echo "選擇教室：<br>";
        }
        $bool=false;
        ?>
            <input type="radio" va=<?php echo $record['sc_className'];?> name="class" id="c<?php echo $n;?>" <?php if($n==1){ ?> checked <?php } ?>>
            <label for="c<?php echo $n;?>">
                <?php echo $record['sc_className'];?>
            </label>
            <!-- <br> -->
        <?php
        $n++;
    }
    if ($bool){
        echo "還沒有任何教室!";
    }
?>