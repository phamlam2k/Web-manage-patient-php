
<?php
        require_once "database/dbhelp.php";

        $id = $_GET['id'];

        if(isset($_GET['id'])){
            $sql = "select * from patient where id=$id";

            $user = executeResult($sql);

            foreach ($user as $std){
                echo "<h2 class='text-center mt-5'>Patient Detail</h2>";
                echo '   
                        <div class="row box-detail">
                          <div class="col-4">
                            <img src="../databaseUser/upload/patient.jpg">
                          </div>
                          <div class="col-8">
                            <h3>ID : '.$std['id'].'</h3>
                            <p>Full Name : '.$std['name'].'</p>
                            <p>Age : '.$std['age'].'</p>
                            <p>Gender : '.$std['gender'].'</p>
                            <p>Phone number : '.$std['phonenumber'].'</p>
                            <p>Address : '.$std['address'].'</p>
                            <p></p>
                          </div>
                        </div>
                      ';
            }
        }
?>

