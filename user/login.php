<?php
    require_once ('../database/config.php');

    session_start();

    error_reporting(0);
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $regex = "/[a-z].[a-z0-9]+@st.usth.edu.vn/";

        $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);

        $sql = "SELECT * FROM info WHERE email='$email' AND password='$pass'";

        $result=mysqli_query($conn, $sql);

        if(empty(trim($_POST['email']))){
            $errors['email']['required'] = "Email must be fill";
        }else{
            if(!preg_match($regex,$_POST['email'])){
                $errors['email']['regex'] = "Invalid email please try again ";
            }
        }

        if(empty(trim($_POST['password']))){
            $errors['password']['required'] = "Password must be fill";
        }else{
            if(strlen($_POST['password']) < 7){
                $errors['password']['length'] = "Password length more than 7";
            }
        }

        if(empty($errors)){
            if($result->num_rows > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['login'] = $row;
                header('Location: ../layout.php?page_layout=home');
            }else{
                echo "<script>alert('Email or password incorrect! Please try again !')</script>";
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <div class="container" style="overflow: auto;">
            <div class="panel-body">
                <h2 style="font-weight: bold; color:#77D5CB ;" class="login-title"><img src="../databaseUser/upload/usth.png" alt="logo" />USTH Hospital</h2>
                <form method="POST" action="">
                    <div class="form-group mt-3">
                        <h3>Sign in</h3>
                    </div>
                    <div class="form-group mt-4">
                        <i class='bx bxs-user'></i>
                        <label class="control-label" id="required" for="signupUName">Email Address:</label>
                        <input id="signinName" type="text" maxlength="50" class="form-control" name="email" placeholder="Enter your Username and Email Address here" >
                        <?php
                        echo (!empty($errors['email']['required']))?'<span style="color: red">'.$errors['email']['required'].'</span>':false;
                        echo (!empty($errors['email']['regex']))?'<span style="color: red">'.$errors['email']['regex'].'</span>':false;
                        ?>
                    </div>
                    <div class="form-group">
                        <i class='bx bxs-lock-alt' ></i>
                        <label class="control-label" id="required" for="signupPassword">Password:</label>
                        <input id="signinPassword" type="password" maxlength="25" name="password" class="form-control" placeholder="Enter your Password here">
                        <?php
                            echo (!empty($errors['password']['required']))?'<span style="color: red">'.$errors['password']['required'].'</span>':false;
                            echo (!empty($errors['password']['length']))?'<span style="color: red">'.$errors['password']['length'].'</span>':false;
                        ?>
                    </div>
                    <br>
                    <div class="form-group ">
                        <button name="submit" class="btn btn-info btn-login mb-3">Login</button>
                    </div>
                </form>
            </div>
    </div>
</div>
</body>
