<?php
include('includes/dbconnect.php');
include('functions/common_function.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Cart details</title>

    <!--Boostrap Css-->
    <link rel="stylesheet" href="CSS/bootstrap.min.css">

    <!--FontAwesome Css-->
    <link rel="stylesheet" href="CSS/all.min.css">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!---Custom Css-->
    <link rel="stylesheet" href="CSS/style.css">

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
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="display_all.php" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="./users_area/user_registration.php" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="#Contact" class="nav-link">contact</a></li>
                <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping">
                        </i><sup>
                            <?php
                            cart_item();
                            ?>

                        </sup></a></li>

            </ul>
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
                <a class='nav-link' href='./users_area/user_login.php'>Login</a>";
             }else{
                echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/logout.php'>Logout</a>";
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
    <!-------------------Fourth child table-------------->


    <div class="container mb-5">
        <form action="" method="POST">
            <div class="row">
                <table class="table table-bordered text-center">
                    <!-- <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th>Operations</th>
                </tr>
            </thead> 
            <tbody>-->
                    <!----php code to display dynamic data------>
                    <?php

                    global $conn;
                    $get_ip_add = getIPAddress();
                    $total_price = 0;
                    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                    $result_query = mysqli_query($conn, $cart_query);

                    //-----------------check if cart is empty-----------------
                    $result_count = mysqli_num_rows($result_query);
                    if ($result_count > 0) {
                        echo "<thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    
                    <tbody>";


                        while ($row_data = mysqli_fetch_assoc($result_query)) {
                            $product_id = $row_data['product_id'];
                            // $product_quantity = $row_data['quantity'];
                            $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                            $result_products = mysqli_query($conn, $select_products);

                            while ($row_data2 = mysqli_fetch_assoc($result_products)) {
                                $product_price = array($row_data2['product_price']);

                                $price_table = $row_data2['product_price'];

                                $product_title = $row_data2['product_title'];

                                $product_image1 = $row_data2['product_image1'];

                                $product_value = array_sum($product_price);
                                $total_price += $product_value;

                    ?>
                                <tr>
                                    <td><?php echo $product_title ?></td>
                                    <td><img src="images/<?php echo $product_image1 ?>" alt="product" width="50px" height="50px"></td>
                                    <td><input type="text" name="qty" class="form-input w-50" min="1" max="10"></td>
                                    <?php
                                    $get_ip_add = getIPAddress();
                                    if (isset($_POST['update_cart'])) {
                                        $quantities = $_POST['qty'];
                                        echo $quantities;
                                        $update_cart = "UPDATE cart_details SET quantity='$quantities' WHERE ip_address='$get_ip_add'";
                                        $result_product_qty = mysqli_query($conn, $update_cart);
                                        $total_price = $total_price * $quantities;
                                    }




                                    ?>
                                    <td><?php echo $price_table ?></td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                    <td>
                                        <input type="submit" value="Update Cart" class="btn btn-info" name="update_cart">

                                        <input type="submit" value="Remove Cart" class="btn btn-info" name="remove_cart">


                                        <!-- <a href="#" class="btn btn-info">Update</a> -->
                                        <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "<h2 class='text-center text-danger'>Cart is Empty!</h2>";
                    }


                    ?>


                    </tbody>
                </table>
                <!---total with total and checkout button-->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-center">Total Price: <strong class="text-primary"><?php echo $total_price ?>/-</strong></h3>
                        </div>
                        <div class="col-md-4">
                            <a href="display_all.php" class="btn btn-info">Continue Shopping</a>
                            <a href="./users_area/checkout.php" class="btn btn-success">Checkout</a>
                        </div>
                    </div>
                </div>
        </form>
    </div>



    <!-------------------------function to remove item------------------------>

    <?php
    function remove_cart_item()
    {
        global $conn;
        $get_ip_add = getIPAddress();
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                $delete_product = "DELETE FROM cart_details WHERE product_id='$remove_id' AND ip_address='$get_ip_add'";
                $result_delete = mysqli_query($conn, $delete_product);
                if ($result_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }
    echo $remove_item = remove_cart_item();
    ?>
























    </div>


    <!-------------------includ Footer-------------------------->
    <?php
    include('includes/footer.php');
    ?>






    <!---------------Javascript---------------->
    <script src="JS/jquery.min.js"> </script>
    <script src="JS/pooper.min.js"> </script>
    <script src="JS/bootstrap.min.js"> </script>
    <script src="JS/all.min.js"> </script>
</body>

</html>