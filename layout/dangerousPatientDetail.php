<?php
require_once "database/dbhelp.php";

$id = $_GET['id'];

if(isset($_GET['id'])){
    $sql = "select * from patient where id=$id";

    $user = executeResult($sql);



    foreach ($user as $std){
        echo "<h2 class='text-center mt-5'>Patient dangerous detail</h2>";
        $std['date'] = date("D Y-m-d");
        echo '
                        <div class="row box-detail">
                          <div class="col-6">
                            <h4>ID : '.$std['id'].'</h4>
                            <p class="mt-4"><strong>Full Name</strong> : '.$std['name'].'</p>
                            <p><strong>Age</strong>  : '.$std['age'].'</p>
                            <p><strong>Gender</strong> : '.$std['gender'].'</p>
                            <p><strong>Phone number</strong> : '.$std['phonenumber'].'</p>
                            <p><strong>Time</strong> : '.$std['date'].'</p>
                            <p><strong>Address</strong> : '.$std['address'].'</p>
                            <p><strong>Description</strong> : '.$std['description'].'</p>
                          </div>
                          <div class="col-6">
                            <img class="card-img-top" src="database/upload/' . $std['picture'] . '" alt="Card image">
                          </div>
                        </div>
                      ';
    }
}
?>
