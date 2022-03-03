<?php
    require_once 'database/config.php';
    require_once('database/dbhelp.php');

    session_start();

    if(!isset($_SESSION['login'])){
        header('Location: ./user/login.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/addPatient.css">
    <link rel="stylesheet" href="style/patient.css">
    <title>Manage Xray Picture</title>
</head>
<body>

    <div class="row home" style="height: 100%; margin: 0">
        <div class="col-md-2 home-side">
            <div class="text-center " >
                <img src="databaseUser/upload/doctor.png">
                <h4 class="text-center text-white mt-3">Username : <?php
                        if(isset($_SESSION["login"])){
                            echo $_SESSION['login']['username'];
                        }
                    ?></h4>
            </div>
            <div class="home-menu mt-3">
                <a href="layout.php?page_layout=home" class="home-menu-content">Home</a>
                <a href="layout.php?page_layout=dangerousPatient" class="home-menu-content">Dangerous patients</a>
                <a href="layout.php?page_layout=pictureXray" class="home-menu-content">X-ray image data</a>
                <a href="layout.php?page_layout=addPatient" class="home-menu-content">Add a patient</a>

            </div>
        </div>
        <div class="col-md-10 " style="padding: 0">
            <div class="home-header">
                <div class="home-header-username">
                    <p class="text-white"><?php
                            if(isset($_SESSION["login"])){
                                echo $_SESSION['login']['username'];
                            }
                        ?></p>
                </div>
                <div class="home-header-username">
                    <a href="databaseUser/logout.php" class="text-dark" style="text-decoration: none; background: #f9f9f9; padding: 5px">Logout</a>
                </div>
            </div>
                <?php
                    if(isset($_GET['page_layout'])){
                        switch ($_GET['page_layout']) {
                            case 'home' :
                                require_once 'home.php';
                                break;
                            case 'statusPatient':
                                require_once 'layout/statusPatient.php';
                                break;
                            case 'dangerousPatient':
                                require_once 'layout/dangerousPatient.php';
                                break;
                            case 'dangerousPatientDetail':
                                require_once 'layout/dangerousPatientDetail.php';
                                break;
                            case 'addPatient' :
                                require_once 'function/addPatient.php';
                                break;
                            case 'pictureXray' :
                                require_once 'layout/PictureOfXrayPatient.php';
                                break;
                            case 'patient' :
                                require_once 'layout/patient.php';
                                break;
                            case 'editPatient' :
                                require_once 'function/editPatient.php';
                                break;
                            default :
                                require_once 'home.php';
                                break;
                        }
                    }else{
                        require_once 'home.php';
                    }
                ?>
        </div>
    </div>

</body>
</html>

