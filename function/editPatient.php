<?php
    $id = $_GET['id'];

    require_once "./database/config.php";

    $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);

    $sql_up = "select * from patient where id=$id";
    $query_up = mysqli_query($conn,$sql_up);
    $row_up = mysqli_fetch_assoc($query_up);

    if(!empty($_POST)){
        $s_name = $s_age = $s_address = $s_image = $s_phonenumber = $s_date = $s_gender = $s_description =  "";

        if(isset($_POST['name'])){
            $s_name = $_POST['name'];
        }

        if(isset($_POST['age'])){
            $s_age = $_POST['age'];
        }

        if(isset($_POST['address'])){
            $s_address = $_POST['address'];
        }
        
        if(isset($_POST['description'])){
            $s_description = $_POST['description'];
        }

        if(isset($_POST['image'])){
            $s_image = $_POST['image'];
        }

        $path = './database/upload/';
        $tmp_name = $_FILES['image']['tmp_name'];
        $s_image = $_FILES['image']['name'];
        move_uploaded_file($tmp_name,$path.$s_image);

        if(isset($_POST['phonenumber'])){
            $s_phonenumber = $_POST['phonenumber'];
        }

        if(isset($_POST['date'])){
            $s_date = $_POST['date'];
        }

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
            $sql = "update patient set id='$id', name='$s_name', picture='$s_image', phonenumber='$s_phonenumber' , date='$s_date', address='$s_address',age='$s_age', description='$s_description'  where id=$id";
        }

        $query = mysqli_query($conn, $sql);
        header('Location: ./layout.php?page_layout=home');
    }
?>
    <div class="home-add-patient mt-5">
        <a href="./layout.php?page_layout=home" class="mt-5 add-patient-icon-back"><i class="fas fa-arrow-left"></i></a>
        <form method="POST" action="" enctype="multipart/form-data">

            <h3 class="text-center">Edit patient information</h3>

            <div class="form-group">
                <label>Full Name : </label>
                <input type="text" id="name" name="name" required value="<?php echo $row_up['name'] ?>"/>
                <?php
                echo (!empty($errors['name']['required']))?'<span style="color: red">'.$errors['name']['required'].'</span>':false;
                echo (!empty($errors['name']['min']))?'<span style="color: red">'.$errors['name']['min'].'</span>':false;
                ?>
            </div>

            <div class="form-group">
                <label>Age : </label>
                <input type="number" id="age" name="age" required value="<?php echo $row_up['age'] ?>"/>
                <?php
                echo (!empty($errors['age']['required']))?'<span style="color: red">'.$errors['age']['required'].'</span>':false;
                echo (!empty($errors['age']['len']))?'<span style="color: red">'.$errors['age']['len'].'</span>':false;
                ?>
            </div>

            <div class="form-group">
                <label>Address : </label>
                <input type="text" id="address" name="address" required value="<?php echo $row_up['address'] ?>"/>
                <?php
                echo (!empty($errors['address']['required']))?'<span style="color: red">'.$errors['address']['required'].'</span>':false;
                ?>
            </div>

            <div class="form-group">
                <label>Picture : </label>
                <input type="file" id="image" name="image" placeholder="Chosse the image" accept="image/jpeg" required/>
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
                <input type="number" id="phonenumber" name="phonenumber" required value="<?php echo $row_up['phonenumber'] ?>"/>
            </div>

            <div class="form-group">
                <label>Date : </label>
                <input type="date" id="date" name="date" required value="<?php echo $row_up['date'] ?>"/>
                <?php
                echo (!empty($errors['phonenumber']['required']))?'<span style="color: red">'.$errors['phonenumber']['required'].'</span>':false;
                echo (!empty($errors['phonenumber']['regex']))?'<span style="color: red">'.$errors['phonenumber']['regex'].'</span>':false;
                ?>
            </div>

            <div class="form-group">
                <label>Description : </label>
                <textarea name="description" rows="4" cols="50"><?php echo $row_up['description']?></textarea>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <button class="btn btn-primary">Edit</button>
                </div>

            </div>

        </form>
    </div>


