<?php
include('../includes/dbconnect.php');
include('../functions/common_function.php');


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>

    <!--Boostrap Css-->
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">

    <!--FontAwesome Css-->
    <link rel="stylesheet" href="../CSS/all.min.css">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!---Custom Css-->
    <link rel="stylesheet" href="../CSS/style.css">

</head>

<body>


<div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-item-center justify-content-center">
        <div class="lg-12 col-xl-6">

        
            <!---Start Registration Form-->
            <form action="" method="POST" enctype="multipart/form-data">
                <!--Name input-->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your name" required autocomplete="off">
                </div>

                <!--Email input-->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" required autocomplete="off">
                </div>

                <!--Image input-->
                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" name="user_image" id="user_image" class="form-control"  required >
                </div>   

                
                <!--Passowrd input-->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">User Password</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required >
                </div>  

                <!--Confirm Passowrd input-->
                <div class="form-outline mb-4">
                    <label for="conf_user_password" class="form-label">Confirm Password</label>
                    <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" placeholder="Enter your password" required >
                </div>  

                <!--Address input-->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter your address" required autocomplete="off">
                </div>

                <!--Contact input-->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" name="user_contact" id="user_contact" class="form-control" placeholder="Enter your number" required autocomplete="off">
                </div>

                <!--Submit button-->
                <div class="mt-4 pt-2">
                    <input type="submit" name="user_register" class="btn btn-primary" value="Register">
                    <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="user_login.php" class="text-danger"> Login</a></p>
                </div>
                   
            </form>
        </div>
    </div>
</div>

<?php 
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];

    $user_password=$_POST['user_password'];
    $conf_user_password=$_POST['conf_user_password'];

    $hash_password=password_hash($user_password,PASSWORD_BCRYPT);
    $user_hash_conf_password=password_hash($conf_user_password,PASSWORD_BCRYPT);

    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();

    //--------------for later if needed----------------
    // $user_role='user';
    // $user_status='pending';
    // $user_date=date('d-m-y');
    // $user_last_login=date('d-m-y');
    // $user_ip=getUserIp();
    // $hash_password=password_hash($user_password,PASSWORD_BCRYPT);
    // $user_hash_conf_password=password_hash($conf_user_password,PASSWORD_BCRYPT);

    $select_query="SELECT * FROM user_table WHERE user_email='$user_email'";
    $select_query_run=mysqli_query($conn,$select_query);
    $count=mysqli_num_rows($select_query_run);
    if($count>0){
        echo "<script>alert('Email already exists')</script>";
    }
    else{
        if($user_password==$conf_user_password){
            move_uploaded_file($user_image_tmp,"./user_images/$user_image");

            $insert_query="INSERT INTO user_table(user_name,
            user_email,user_password,
            user_image,user_ip,user_address,
            user_mobile) 
            VALUES('$user_username','$user_email','$hash_password',
            '$user_image','$user_ip','$user_address',
            '$user_contact')";

            $insert_query_run=mysqli_query($conn,$insert_query);
            // if($insert_query_run){
            //     echo "<script>alert('Registration Successful')</script>";
            //     //echo "<script>window.open('user_login.php','_self')</script>";
            // }
            // else{
            //     echo "<script>alert('Registration Failed')</script>";
            // }
        }
        else{
            echo "<script>alert('Password and Confirm Password do not match')</script>";
        }


            //selecting cart items
    $select_cart="SELECT * FROM cart_details WHERE ip_address='$user_ip'";
    $result_cart=mysqli_query($conn,$select_cart);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('Registration Successful')</script>";

        echo "<script>alert('You have items in your cart,<br> please Login ')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }
    else{
       // $_SESSION['user_name']=$user_username;
        echo "<script>alert('Registered successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }




    }
}


?>























    <!---------------Javascript---------------->
    <script src="JS/jquery.min.js"> </script>
    <script src="JS/pooper.min.js"> </script>
    <script src="JS/bootstrap.min.js"> </script>
    <script src="JS/all.min.js"> </script>
</body>

</html>