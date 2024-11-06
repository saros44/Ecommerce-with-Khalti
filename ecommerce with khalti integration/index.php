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
  <title>Welcome</title>

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
        

<!-----------------------------------if user is logged in then dont show Register instead show MyAccount------------------>

<?php
if(isset($_SESSION['username'])){
  
  echo "<li class='nav-item'><a href='users_area/profile.php' class='nav-link'>My Account</a></li>";
}else{
  echo "<li class='nav-item'><a href='users_area/user_registration.php' class='nav-link'>Register</a></li>";
};

?>


<!----------------------------------------------------------------------------------------------->





        <li class="nav-item"><a href="#Contact" class="nav-link">contact</a></li>
        <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping">
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

      <form action="search_product.php" class="d-flex" method="GET">
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

  <!--------------------Fourth Child----------------->


  <div class="container-fluid">

    <!-- Main Row: Two Columns -->
    <div class="row px-1">

      <!-- First Column: Width 10 -->
      <div class="col-md-10">

        <!-- Nested Row with Three Columns -->
        <div class="row">


          <!-----Fetching data from database and displaying it in main page---->
          <?php
          //calling function from common_function.php
          getproducts();
          get_unique_categories();
          get_unique_brand();
          // getIPAddress() ;


          // $select_query = "SELECT * FROM products order by RAND() limit 0,9";
          // $result_query = mysqli_query($conn, $select_query);

          // while ($row_data = mysqli_fetch_assoc($result_query)) {
          //   $product_id = $row_data['product_id'];
          //   $product_title = $row_data['product_title'];
          //   $product_description = $row_data['product_description'];
          //   $product_keyword = $row_data['product_keywords'];
          //   $product_image1 = $row_data['product_image1'];
          //   $product_price = $row_data['product_price'];
          //   $category_id = $row_data['category_id'];
          //   $brand_id = $row_data['brand_id'];

          //   echo "
          //   <div class='col-md-4 mb-4'>
          //   <div class='card' style='width: 18rem;''>
          //     <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
          //     <div class='card-body'>
          //       <h5 class='card-title'>$product_title</h5>
          //       <p class='card-text'>$product_description</p>
          //       <a href='#' class='btn btn-info'>Add to cart</a>
          //       <a href='#' class='btn btn-secondary'>View more</a>
          //     </div>
          //   </div>
          // </div>";
          // }
          ?>
          <!------------------------------------------------------------------>


          <!---This was static data which was displayed in main page---->
          <!------------------------------->
          <!------>
          <!-- Card Column 1 -->
          <!-- <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                          <img class="card-img-top" src="./images/img97.jpg" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-info">Add to cart</a>
                            <a href="#" class="btn btn-secondary">View more</a>
                          </div>
                        </div>
                      </div> -->
          <!-------------------------------------------------->
          <!------------------------------->
          <!------>


          <!--row end-->
        </div>
        <!-- Column end -->
      </div>
      <!-- End First Column -->


      <!------------------ Second Column: Width 2 ---------------->
      <div class="col-md-2 bg-secondary ">


        <!----Brands to be displayed---->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-llink text-light">
              <h4>Delivery Brand</h4>
            </a>
          </li>


          <!----Dynamically Brands displayed in main page---->
          <?php

          getbrands();
          // $select_brands = "SELECT * FROM brands";
          // $result_brands = mysqli_query($conn, $select_brands);
          // while ($row_data = mysqli_fetch_assoc($result_brands)) {
          //   $brand_title = $row_data['brand_title'];
          //   $brand_id = $row_data['brand_id'];
          //   echo  "<li class='nav-item'>
          //             <a href='index.php?brand=$brand_id' class='nav-llink text-light'><h4>$brand_title</h4></a>
          //           </li>";
          //}
          ?>
          <!------------------------------------------------------------>


        </ul>

        <!----Category to be displayed---->
        <ul class="navbar-nav me-auto text-center mt-5">
          <li class="nav-item bg-info mt-3">
            <a href="#" class="nav-llink text-light">
              <h4>Categories</h4>
            </a>
          </li>

          <!----Dynamically Categories displayed in main page---->
          <?php

          getcategories();
          // $select_categories = "SELECT * FROM categories";
          // $result_categories = mysqli_query($conn, $select_categories);
          // while ($row_data = mysqli_fetch_assoc($result_categories)) {
          //   $category_title = $row_data['category_title'];
          //   $category_id = $row_data['category_id'];
          //   echo  "<li class='nav-item'>
          //             <a href='index.php?category=$category_id' class='nav-llink text-light'><h4>$category_title</h4></a>
          //           </li>";
          // }
          ?>
          <!------------------------------------------------------------>

        </ul>

      </div>
      <!-- End Second Column -->

    </div>
    <!-- End Main Row -->

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