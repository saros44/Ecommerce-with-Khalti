<?php 
include('../includes/dbconnect.php');

if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_Keyword = $_POST['product_Keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status='true';

    //accessing images  
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    //accessing image temp names
    $temp_name1 = $_FILES['product_image1']['tmp_name'];
    $temp_name2 = $_FILES['product_image2']['tmp_name'];
    $temp_name3 = $_FILES['product_image3']['tmp_name'];

    //checking if category is empty and if it is already in the database
    if($product_title=='' OR $product_description=='' OR $product_Keyword=='' OR $product_categories==''
     OR $product_brands=='' OR $product_price=='' OR $product_image1=='' OR $product_image2=='' 
     OR $product_image3==''){
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    }else{
        //uploading images to its folder
        move_uploaded_file($temp_name1, "product_images/$product_image1");
        move_uploaded_file($temp_name2, "product_images/$product_image2");
        move_uploaded_file($temp_name3, "product_images/$product_image3");

        $insert_query = "INSERT INTO products (product_title, product_description, product_keywords, 
        category_id, brand_id, product_image1, product_image2, product_image3, 
        product_price, datee, statuss)
         VALUES ('$product_title', '$product_description', '$product_Keyword', '$product_categories',
         '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price',TIMESTAMP(CURRENT_TIMESTAMP),'$product_status')";

        $result = mysqli_query($conn, $insert_query);

        if($result){
            echo "<script>alert('Product has been inserted successfully')</script>";
        }
        else{
            echo "<script>alert('Failed to insert to Database')</script>";
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>

      <!--Boostrap Css-->
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">

    <!--FontAwesome Css-->
    <link rel="stylesheet" href="../CSS/all.min.css">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!---Custom Css-->
    <link rel="stylesheet" href="../CSS/style.css">

</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>

        <!----------Form------------->

        <form action="" method="POST" enctype="multipart/form-data">
             <!----------title------------->
            <div class="form-outline mb-3 w-50 m-auto">
                <label for="product_title" class="form-label mt-3">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" required>
            </div>

             <!----------description------------->
             <div class="form-outline mb-3 w-50 m-auto">
                <label for="product_description" class="form-label mt-3">Product description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter Product description" required>
            </div>

             <!----------Keyword------------->
             <div class="form-outline mb-3 w-50 m-auto">
                <label for="product_Keyword" class="form-label mt-3">Product Keyword</label>
                <input type="text" name="product_Keyword" id="product_Keyword" class="form-control" placeholder="Enter Product Keyword" required>
            </div>    

             <!----------Categories------------->
             <div class="form-outline mb-3 w-50 m-auto">
             <label for="product_categories" class="form-label mt-3">Choose a Category</label>
                <select name="product_categories" id="product_categories" class="form-select">
                    <option value="">Select a category</option>
                    <?php 
                            $select_query = "Select * from categories";
                            $result_query = mysqli_query($conn, $select_query);
                            while($row = mysqli_fetch_assoc($result_query)){
                                $category_id = $row['category_id'];
                                $category_title = $row['category_title'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                         ?>

                    <!-- <option value="">Category1</option>
                    <option value="">Category2</option>
                    <option value="">Category3</option>
                    <option value="">Category4</option> -->
                </select>
            </div> 

             <!----------Brands------------->
             <div class="form-outline mb-3 w-50 m-auto">
             <label for="product_brands" class="form-label mt-3">Choose a Brand</label>
                <select name="product_brands" id="product_brands" class="form-select">
                    <option value="">Select a brand</option>


                    <?php 
                            $select_query = "Select * from brands";
                            $result_query = mysqli_query($conn, $select_query);
                            while($row = mysqli_fetch_assoc($result_query)){
                                $brand_id = $row['brand_id'];
                                $brand_title = $row['brand_title'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                         ?>

<!-- 
                    <option value="">brand1</option>
                    <option value="">brand2</option>
                    <option value="">brand3</option>
                    <option value="">brand4</option> -->
                </select>
            </div>                   


             <!----------Image 1------------->
             <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_image1" class="form-label mt-3">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control">
            </div>   
             <!----------Image 2------------->
             <div class="form-outline mb-2 w-50 m-auto">
                <label for="product_image2" class="form-label mt-3">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control">
            </div> 
             <!----------Image 3------------->
             <div class="form-outline mb-3 w-50 m-auto">
                <label for="product_image3" class="form-label mt-3">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control">
            </div>   
            
             <!----------Price------------->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label mt-3">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" required>
            </div>  

             <!----------Submit_Button------------->
             <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" id="insert_product" value="Insert Products" class="btn btn-info px-2 border-4">
            </div>              
                      

            
        </form>
    </div>
    
















<!---------------Javascript---------------->
  <script src="../JS/jquery.min.js"> </script>
  <script src="../JS/pooper.min.js"> </script>
  <script src="../JS/bootstrap.min.js"> </script>
  <script src="../JS/all.min.js"> </script>


</body>
</html>