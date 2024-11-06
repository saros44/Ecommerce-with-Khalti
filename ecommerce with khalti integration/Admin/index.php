<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
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
    <!----------------------------------Navbar------------------------------->
    <div class="container-fluid p-0">
        <!-------------------First Child-------------------->
        <nav class="navbar navbar-expand-sm navbar-dark bg-info pl-5 fixd-top">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand"><span id="shop">Shop</span>now... </a>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome Guest</a>
                        </li>
                    </ul>                                     
                </nav>
            </div>
        </nav>

        <!------------------------Second Child------------------->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!------------------------Third Child------------------->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1">
                <div class="p-1 ">
                    <a href="#"><img src="../images/img3.jpg" alt="" class="admin_img"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>

                <!------------------------Buttons---------->
                <div class="button text-center">

                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Product</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">View Products</a></button>

                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">View Categories</a></button>
                                        
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">All orders</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">All payments</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">List Users</a></button>

                    <button><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>

            </div>
        </div>

    <!----Fourth Chld----->
    

    <!---Here we are passing accessing insert_category.php & insert_brands.php 
        page through help of (?insert_category,brand)--->
    <div class="container my-3">
        <?php 
            if(isset($_GET['insert_category'])){
                include("insert_categories.php");
            }  
            
            if(isset($_GET['insert_brand'])){
                include("insert_brands.php");
            }  
        
        ?>
    </div>

    


    <!-----------------footer------------------------->
        <div class="bg-info p-3 text-center">
      <p class="">Lorem ipsum dolor velit.</p>
    </div>



  <!---------------Javascript---------------->
  <script src="../JS/jquery.min.js"> </script>
  <script src="../JS/pooper.min.js"> </script>
  <script src="../JS/bootstrap.min.js"> </script>
  <script src="../JS/all.min.js"> </script>
</body>
</html>