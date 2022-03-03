<?php
    require_once('config.php');

    // Dùng cho insert và update
    function execute($sql){
        $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);

        mysqli_query($conn, $sql);

        mysqli_close($conn);
    }

    // Dùng cho post
    function executeResult($sql){
        $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);

        $resultset = mysqli_query($conn, $sql);

        $list = [];

        while ($row = mysqli_fetch_array($resultset, 1)){
            $list[] = $row;
        }

        mysqli_close($conn);

        return $list;
    }

?>