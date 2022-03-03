<?php
    if(!empty($_POST)){
        $s_name = $s_age = $s_address = $s_image = $s_phonenumber = $s_date = $s_gender = $s_description = "";
        $s_status = 0;

        $errors = [];

        require_once ("./database/config.php");
        require_once('./database/dbhelp.php');

        $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);

        if(isset($_POST['name'])){
            $s_name = $_POST['name'];
        }

        if(isset($_POST['age'])){
            $s_age = $_POST['age'];
        }

        if(isset($_POST['address'])){
            $s_address = $_POST['address'];
        }

        if(isset($_POST['image'])){
            $s_image = $_POST['image'];
        }

        if(isset($_POST['phonenumber'])){
            $s_phonenumber = $_POST['phonenumber'];
        }

        if(isset($_POST['date'])){
            $s_date = $_POST['date'];
        }

        if(isset($_POST['gender'])){
            $s_gender = $_POST['gender'];
        }

        if(isset($_POST['status'])){
            $s_status = $_POST['status'];
        }

        if(isset($_POST['description'])){
            $s_description = $_POST['description'];
        }

        $sql_compare = "select * from patient where address like $s_address";

        $result = mysqli_query($conn, $sql_compare);


        if(empty(trim($s_name))){
            $errors['name']['required'] = "Full name must be fill";
        }else{
            if(strlen(trim($s_name)) < 5){
                $errors['name']['min'] = "Full name length must be more than 5 ";
            }
        }

        if(empty(trim($s_age))){
            $errors['age']['required'] = "Age must be fill";
        }
        else{
            if($s_age < 0 || $s_age > 150 ){
                $errors['age']['len'] = "Age must be in range 0 to 150";
            }
        }

        if(empty(trim($s_phonenumber))){
            $errors['phonenumber']['required'] = "Phone number must be fill";
        }

        if(empty(trim($s_address))){
            $errors['address']['required'] = "Địa chỉ không được để trống";
        }

        if(empty($errors)){
            if($result->num_rows >0){
                echo "<script>alert('Address is using please try again')</script>";
            }else{
                $path = './database/upload/';
                $tmp_name = $_FILES['image']['tmp_name'];
                $s_image = $_FILES['image']['name'];

                move_uploaded_file($tmp_name,$path.$s_image);

                $sql = "insert into patient(name,picture,phonenumber ,date  ,address ,age, gender, status , description ) value ('$s_name','$s_image', '$s_phonenumber','$s_date' ,'$s_address','$s_age', '$s_gender', '$s_status', '$s_description' )";

                execute($sql);

                header('Location: ./layout.php?page_layout=home');
            }
        }
    }
?>
        <div class="container home-add-patient">
            <a href="./layout.php?page_layout=home" class=" add-patient-icon-back"><i class="fas fa-arrow-left"></i></a>
            <form method="POST" action="" enctype="multipart/form-data">
                <h3 class="text-center">Add a patient</h3>

                <div class="form-group mt-3">
                    <label>Full Name : </label>
                    <input type="text" id="name" name="name" value="<?php echo (!empty($_POST['name']))?$_POST['name']:false ?>"/>
                    <?php
                        echo (!empty($errors['name']['required']))?'<span style="color: red">'.$errors['name']['required'].'</span>':false;
                        echo (!empty($errors['name']['min']))?'<span style="color: red">'.$errors['name']['min'].'</span>':false;
                    ?>
                </div>

                <div class="form-group">
                    <label>Age : </label>
                    <input type="number" id="age" name="age" value="<?php echo (!empty($_POST['age']))?$_POST['age']:false ?>"/>
                    <?php
                        echo (!empty($errors['age']['required']))?'<span style="color: red">'.$errors['age']['required'].'</span>':false;
                        echo (!empty($errors['age']['len']))?'<span style="color: red">'.$errors['age']['len'].'</span>':false;
                    ?>
                </div>

                <div class="form-group">
                    <label>Address : </label>
                    <input type="text" id="address" name="address" value="<?php echo (!empty($_POST['address']))?$_POST['address']:false ?>"/>
                    <?php
                        echo (!empty($errors['address']['required']))?'<span style="color: red">'.$errors['address']['required'].'</span>':false;
                    ?>
                </div>

                <div class="form-group">
                    <label>Picture : </label>
                    <input type="file" id="image" name="image" />
                    <?php
                        echo (!empty($errors['image']['required']))?'<span style="color: red">'.$errors['image']['required'].'</span>':false;
                    ?>
                </div>

                <div class="form-group">
                    <label>Gender : </label>
                    <div class="add-patient-gender">
                        <label>Male </label>
                        <input type="radio" name="gender" value="male" id="male">
                    </div>
                    <div class="add-patient-gender">
                        <label>Female </label>
                        <input type="radio" name="gender" value="female" id="female">
                    </div>
                </div>

                <div class="form-group">
                    <label>Phone Number : </label>
                    <input type="number" id="phonenumber" name="phonenumber" value="<?php echo (!empty($_POST['phonenumber']))?$_POST['phonenumber']:false ?>"/>
                    <?php
                        echo (!empty($errors['phonenumber']['required']))?'<span style="color: red">'.$errors['phonenumber']['required'].'</span>':false;
                        echo (!empty($errors['phonenumber']['regex']))?'<span style="color: red">'.$errors['phonenumber']['regex'].'</span>':false;
                    ?>
                </div>

                <div class="form-group">
                    <label>Date : </label>
                    <input type="date" id="date" name="date"/>
                    <?php
                        echo (!empty($errors['date']['required']))?'<span style="color: red">'.$errors['date']['required'].'</span>':false;
                    ?>
                </div>

                <div class="form-group">
                    <label>Gravity : </label>
                    <div class="add-patient-gender">
                        <label>Yes </label>
                        <input type="radio" name="status" value=1>
                    </div>
                    <div class="add-patient-gender">
                        <label>No </label>
                        <input type="radio" name="status" value=0>
                    </div>

                </div>

                <div class="form-group">
                    <label>Description : </label>
                    <textarea name="description" rows="4" cols="50"></textarea>
                </div>

                <div class="row justify-content-center mt-5">
                    <div class="col-md-5">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>

                </div>



            </form>
        </div>


