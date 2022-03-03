<?php

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        require_once('../database/dbhelp.php');

        $sql = 'delete from patient where id ='.$id;
        execute($sql);

    }


?>