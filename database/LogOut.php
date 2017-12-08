<?php
    if(isset($_COOKIE['login']))
        setCookie("login",$value,time()-3600);
?>