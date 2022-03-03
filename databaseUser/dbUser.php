<?php
    require_once ('../database/config.php');

    session_start();

    error_reporting(0);
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);

        $sql = "SELECT * FROM info WHERE email='$email' AND password='$pass'";

        $result=mysqli_query($conn, $sql);

        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['login'] = $row;
            header('Location: ../layout.php?page_layout=home');
        }else{
            echo "<script>alert('Wrong')</script>";
        }
    }





?>