<?php

    require_once ("./database/dbhelp.php");

    function search() {
        if(isset($_GET["search"])){
            $sql = 'select * from patient where name like "%'.$_GET["search"].'%"';
        }else{
            $sql = 'select * from patient';
        }

        $user = executeResult($sql);

        return $user;
    }
?>