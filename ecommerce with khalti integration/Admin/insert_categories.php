<?php
include('../includes/dbconnect.php');

//through help of ?insert_category in index.php we are able to access this page(I dont know how it actually works)

//insert_cat is the name of the button and cat_title is the name of the input field
if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];

    $select_query = "SELECT * FROM categories WHERE category_title='$category_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);

    //checking if category is empty and if it is already in the database
    if($category_title==''){
        echo "<script>alert('Please fill all the fields')</script>";
        //exit();
    }else{
        if($number>0){
            echo "<script>alert('Category is already in Database')</script>";
            //exit();
        }else{
        $insert_query= "INSERT INTO categories (category_title) VALUES('$category_title')";
        $result = mysqli_query($conn, $insert_query);

            if($result){
                echo "<script>alert('Category has been inserted successfully')</script>";
            }
            else{
                echo "<script>alert('Failed to insert to Database')</script>";
            }
        }
    }
}
?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="POST" class="mb-2">

    <div class="input-group w-90 mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-soli fa-receipt"></i></span>
        </div>
        <input type="text" class="form-control" placeholder="Category name" name="cat_title" placeholder="Insert Category" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="bg-info border-0 p-2 my-3" value="Insert Categories" name="insert_cat" placeholder="Insert Category" aria-label="Username" aria-describedby="basic-addon1"> 
    <!-- <button class="bg-info p-2 my-3 border-0">Insert Category</button> -->
    </div>
</form>