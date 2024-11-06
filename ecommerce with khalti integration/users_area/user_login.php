<?php
include('../includes/dbconnect.php');
include('../functions/common_function.php');

@session_start();
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

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
        <h2 class="text-center">Log in</h2>
        <div class="row d-flex align-item-center justify-content-center">
            <div class="lg-12 col-xl-6">


                <!---Start Registration Form-->
                <form action="" method="POST">
                    <!--Name input-->

                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your name" required autocomplete="off">
                    </div>

                    <!--Email input-->
                    <!-- <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" required autocomplete="off">
                </div> -->

                    <!--Passowrd input-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">User Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required>
                    </div>

                    <!--Submit button-->
                    <div class="mt-4 pt-2">
                        <input type="submit" name="user_login" class="btn btn-primary" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="user_registration.php" class="text-danger"> Register</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <?php
    if (isset($_POST['user_login'])) {
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];
        //$user_password=md5($user_password);

        $select_query = "SELECT * FROM `user_table` WHERE `user_name`='$user_username'";
        $result = mysqli_query($conn, $select_query);
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        $user_ip = getIPAddress();


        //----------------Accessing cart item------------------
        $select_query_cart = "SELECT * FROM `cart_details`
        WHERE `ip_address`='$user_ip'";
        $select_cart = mysqli_query($conn, $select_query_cart);
        $row_count_cart = mysqli_num_rows($select_cart);


        if ($row_count > 0) {
            $_SESSION['username']=$user_username;

            if (password_verify($user_password, $row_data['user_password'])) {

                if ($row_count == 1 and $row_count_cart == 0) {
                    $_SESSION['username']=$user_username;
                    echo "<script>alert('Login successful')</script>";
                    echo "<script>window.open('profile.php','_self')</script>";
 
                } else {
                    $_SESSION['username']=$user_username;
                    echo "<script>alert('Login successful')</script>";
                    echo "<script>window.open('payment.php','_self')</script>";
                }

            } else {
                echo "<script>alert('Username or Password is incorrect')</script>";
            }
        } else {
            echo "<script>alert('Username or Password is incorrect')</script>";
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