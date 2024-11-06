<?php
include('../includes/dbconnect.php');
//through help of ?insert_category in index.php we are able to access this page(I dont know how it actually works)

//insert_brand is the name of the button and brand_title is the name of the input field
if(isset($_POST['insert_brand'])){
    $brand_title = $_POST['brand_title'];

    $select_query = "SELECT * FROM brands WHERE brand_title='$brand_title '";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);

    //checking if brand is empty and if it is already in the database
    if($brand_title ==''){
        echo "<script>alert('Please fill all the fields')</script>";
        //exit();
    }else{
        if($number>0){
            echo "<script>alert('Brand is already in Database')</script>";
            //exit();
        }else{
        $insert_query= "INSERT INTO brands (brand_title) VALUES('$brand_title ')";
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









<h2 class="text-center">Insert Brand</h2>

<form action="" method="POST" class="mb-2">

    <div class="input-group w-90 mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-soli fa-receipt"></i></span>
        </div>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brands" aria-label="brands" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
     <input type="submit" class="bg-info border-0 p-2 m-y3" value="Insert Brand" name="insert_brand" placeholder="Insert Brand" aria-label="Username" aria-describedby="basic-addon1"> 
    <!-- <button class="bg-info p-2 my-3 border-0">Insert Brands</button> -->
    </div>
</form>