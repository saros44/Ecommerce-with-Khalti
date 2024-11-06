<?php
include('../includes/dbconnect.php');
include('../functions/common_function.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']?></title>

    <!--Boostrap Css-->
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">

    <!--FontAwesome Css--->
    <link rel="stylesheet" href="../CSS/all.min.css">

    <!--Google Font--->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!--Custom Css-->
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <!----------------------------------Navbar------------------------------->

    <!---Start Navigation-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-info pl-5 fixd-top">
        <a href="index.php" class="navbar-brand"><span id="shop">Shop</span>now... </a>
        <span class="navbar-text">Online mobile shop</span>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="myMenu">
            <ul class="navbar-nav pl-5">
                <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="../display_all.php" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="user_registration.php" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="#Contact" class="nav-link">contact</a></li>
                <li class="nav-item"><a href="../cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping">
        </i><sup>
        <?php
        cart_item();
        ?>               

        </sup></a></li>

        <li class="nav-item"><a href="#Contact" class="nav-link">
                    Total Price:<?php 
            total_cart_price();          
          ?>/-
          </a></li>

            </ul>

            <form action="../search_product.php" class="d-flex" method="GET">
                <input class="form-control mr-sm-2" name="search_data" type="search" placeholder="Search" aria-label="Search">
                <input type="submit" class="btn btn-outline-dark my-2  my-sm-0" value="Search" name="search_data_product">
                <!-- <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button> -->
            </form>


        </div>
    </nav>
    <!---End Navigation-->





   <!---Calling Cart function-->
   <?php
    cart();
   ?>

    <!---------------Second child------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">



<!-----------------------Session working-------------------------->
            <?php 
                  //----------------for Welcome Guest Name------------------
                  if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                  </li>";

                 }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>";
                 };


     //----------------for Login and Logout---------------------
             if(!isset($_SESSION['username'])){

                echo "<li class='nav-item'>
                <a class='nav-link' href='./user_login.php'>Login</a>";
             }else{
                echo "<li class='nav-item'>
                <a class='nav-link' href='logout.php'>Logout</a>";
             };
            ?>
<!-------------------------------------------------------------->


        </ul>
    </nav>

    <!---------------Third child------------------->

    <div class="bg-light">
        <h3 class="text-center">Hidden Store</h3>
        <p class="text-center">am modi dignissimos eum amet mollitia veniam a cumque!</p>
    </div>

    <!--------------------Fourth Child----------------->



    <div class="div row">
        <div class="div col-md-2 ">
            <ul class="navbar-nav bg-secondary text-center" style="height: 100vh;">

                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light"><h4>Your Profile</h4></a>
                </li>

                <?php
                //php code to show user profile image
                $username=$_SESSION['username'];
                //$user_ip = getIPAddress();
                $get_user= "SELECT * FROM user_table WHERE user_name='$username'";
                $result = mysqli_query($conn,$get_user);
                $run_query = mysqli_fetch_array($result);
               // $user_id = $run_query['user_id'];
                $user_image = $run_query['user_image'];
   
                                
                ?>

                <!---image----->
                <li class="nav-item bg-dark ">
                    <img src="../users_area/user_images/<?php echo $user_image?>" class="" width="100%" height="100%">
                </li>


                <li class="nav-item ">
                    <a href="profile.php" class="nav-link text-light">Pending Orders</a>
                </li>

                <li class="nav-item bg-info">
                    <a href="profile.php?edit_account" class="nav-link text-light">Edit Account</a>
                </li>

                <li class="nav-item ">
                    <a href="profile.php?my_orders" class="nav-link text-light">My Orders</a>
                </li>

                <li class="nav-item bg-info">
                    <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
                </li>

                <li class="nav-item ">
                    <a href="logout.php" class="nav-link text-light">Logout</a>
                </li>











            </ul>

    </div>



















        <div class="div col-md-10 text-center">
             <?php get_user_order_detail();

             if(isset($_GET['edit_account'])){
                include('edit_account.php');}//I have to create this page
            
            if(isset($_GET['my_orders'])){
                include('user_orders.php');}//I have made this page
            
            ?>
        </div>
    </div>




































    <!-------------------includ Footer-------------------------->
    <?php
    include('../includes/footer.php');

    ?>






    <!---------------Javascript---------------->
    <script src="../JS/jquery.min.js"> </script>
    <script src="../JS/pooper.min.js"> </script>
    <script src="../JS/bootstrap.min.js"> </script>
    <script src="../JS/all.min.js"> </script>


    

    
</body>
</html>