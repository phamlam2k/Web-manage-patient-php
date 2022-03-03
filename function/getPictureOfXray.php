<?php

    require_once ("./database/dbhelp.php");

    function pictureOfXray() {
        $sql = 'select * from patient';

        $user = executeResult($sql);

        return $user;
    }
?>