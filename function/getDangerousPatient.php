<?php

require_once ("./database/dbhelp.php");

function dangerousPatient() {
    $sql = 'select * from patient where status=1';

    $user = executeResult($sql);

    return $user;
}
?>