<?php
//connect to database
//include('includes/dbconnect.php');

//geeting products

function getproducts()
{
  global $conn;

  //condition to check if category is set or not
  if (!isset($_GET['category'])) {

    if (!isset($_GET['brand'])) {


      $select_query = "SELECT * FROM products order by RAND() limit 0,3";
      $result_query = mysqli_query($conn, $select_query);

      while ($row_data = mysqli_fetch_assoc($result_query)) {
        $product_id = $row_data['product_id'];
        $product_title = $row_data['product_title'];
        $product_description = $row_data['product_description'];
        $product_keyword = $row_data['product_keywords'];
        $product_image1 = $row_data['product_image1'];
        $product_price = $row_data['product_price'];
        $category_id = $row_data['category_id'];
        $brand_id = $row_data['brand_id'];

        echo "
      <div class='col-md-4 mb-4'>
      <div class='card' style='width: 18rem;''>
        <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
    </div>";
      }
    }
  }
}








///geeting all products for display_all.php
function get_all_products()
{
  global $conn;

  //condition to check if category is set or not
  if (!isset($_GET['category'])) {

    if (!isset($_GET['brand'])) {


      $select_query = "SELECT * FROM products order by RAND() ";
      $result_query = mysqli_query($conn, $select_query);

      while ($row_data = mysqli_fetch_assoc($result_query)) {
        $product_id = $row_data['product_id'];
        $product_title = $row_data['product_title'];
        $product_description = $row_data['product_description'];
        $product_keyword = $row_data['product_keywords'];
        $product_image1 = $row_data['product_image1'];
        $product_price = $row_data['product_price'];
        $category_id = $row_data['category_id'];
        $brand_id = $row_data['brand_id'];

        echo "
    <div class='col-md-4 mb-4'>
    <div class='card' style='width: 18rem;''>
      <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <p class='card-text'>$product_price</p>
        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
        <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
    </div>
  </div>";
      }
    }
  }
}






//geeting unique categories

function get_unique_categories()
{
  global $conn;

  //condition to check if category is set or not
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];



    $select_query = "SELECT * FROM products WHERE category_id='$category_id'";
    $result_query = mysqli_query($conn, $select_query);

    $num_rows = mysqli_num_rows($result_query);

    if ($num_rows == 0) {
      echo "<h2 class='text-center text-danger'>Sorry,No products found of this category</h2>";
    }

    while ($row_data = mysqli_fetch_assoc($result_query)) {
      $product_id = $row_data['product_id'];
      $product_title = $row_data['product_title'];
      $product_description = $row_data['product_description'];
      $product_keyword = $row_data['product_keywords'];
      $product_image1 = $row_data['product_image1'];
      $product_price = $row_data['product_price'];
      $category_id = $row_data['category_id'];
      $brand_id = $row_data['brand_id'];

      echo "
    <div class='col-md-4 mb-4'>
    <div class='card' style='width: 18rem;''>
      <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <p class='card-text'>$product_price</p>
        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
        <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
    </div>
  </div>";
    }
  }
}






//geeting unique brands

function get_unique_brand()
{
  global $conn;

  //condition to check if category is set or not
  if (isset($_GET['brand'])) {
    $brand_id = $_GET['brand'];



    $select_query = "SELECT * FROM products WHERE brand_id='$brand_id'";
    $result_query = mysqli_query($conn, $select_query);

    $num_rows = mysqli_num_rows($result_query);

    if ($num_rows == 0) {
      echo "<h2 class='text-center text-danger'>Sorry,No products found of this Brand</h2>";
    }

    while ($row_data = mysqli_fetch_assoc($result_query)) {
      $product_id = $row_data['product_id'];
      $product_title = $row_data['product_title'];
      $product_description = $row_data['product_description'];
      $product_keyword = $row_data['product_keywords'];
      $product_image1 = $row_data['product_image1'];
      $product_price = $row_data['product_price'];
      $category_id = $row_data['category_id'];
      $brand_id = $row_data['brand_id'];

      echo "
    <div class='col-md-4 mb-4'>
    <div class='card' style='width: 18rem;''>
      <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <p class='card-text'>$product_price</p>
        <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
        <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
    </div>
  </div>";
    }
  }
}





//displaying brands in sidebar
function getbrands()
{
  global $conn;
  $select_brands = "SELECT * FROM brands";
  $result_brands = mysqli_query($conn, $select_brands);
  while ($row_data = mysqli_fetch_assoc($result_brands)) {
    $brand_title = $row_data['brand_title'];
    $brand_id = $row_data['brand_id'];
    echo  "<li class='nav-item'>
              <a href='index.php?brand=$brand_id' class='nav-llink text-light'><h4>$brand_title</h4></a>
    
            </li>";
  };
}






//displaying categories in sidebar
function getcategories()
{
  global $conn;
  $select_categories = "SELECT * FROM categories";
  $result_categories = mysqli_query($conn, $select_categories);
  while ($row_data = mysqli_fetch_assoc($result_categories)) {
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];
    echo  "<li class='nav-item'>
              <a href='index.php?category=$category_id' class='nav-llink text-light'><h4>$category_title</h4></a>
            </li>";
  }
}










//searching products function

function search_product()
{
  global $conn;
  //condition to check if search button is clicked or not                         
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];

    $search_query = "SELECT * FROM products where product_keywords like '%$search_data_value%' ";
    $result_query = mysqli_query($conn, $search_query);

    //counting number of rows in search query and displaying message if no rows found
    $num_rows = mysqli_num_rows($result_query);

    if ($num_rows == 0) {
      echo "<h2 class='text-center text-danger'>Nothing found from your search</h2>";
    }

    //displaying products if rows found

    while ($row_data = mysqli_fetch_assoc($result_query)) {
      $product_id = $row_data['product_id'];
      $product_title = $row_data['product_title'];
      $product_description = $row_data['product_description'];
      $product_keyword = $row_data['product_keywords'];
      $product_image1 = $row_data['product_image1'];
      $product_price = $row_data['product_price'];
      $category_id = $row_data['category_id'];
      $brand_id = $row_data['brand_id'];

      echo "
      <div class='col-md-4 mb-4'>
      <div class='card' style='width: 18rem;''>
        <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
        </div>
      </div>
    </div>";
    }
  }
}










  //-------------------------view details function
  function view_details()
  {

    global $conn;

    //condition to check if category is set or not
    if (isset($_GET['product_id'])) {


      if (!isset($_GET['category'])) {

        if (!isset($_GET['brand'])) {

          $product_id = $_GET['product_id'];

          $select_query = "SELECT * FROM products WHERE product_id=$product_id";
          $result_query = mysqli_query($conn, $select_query);

          while ($row_data = mysqli_fetch_assoc($result_query)) {
            $product_id = $row_data['product_id'];
            $product_title = $row_data['product_title'];
            $product_description = $row_data['product_description'];
            $product_keyword = $row_data['product_keywords'];
            $product_image1 = $row_data['product_image1'];
            $product_image2 = $row_data['product_image2'];
            $product_image3 = $row_data['product_image3'];
            $product_price = $row_data['product_price'];
            $category_id = $row_data['category_id'];
            $brand_id = $row_data['brand_id'];

            echo "
      <div class='col-md-4 mb-4'>
      <div class='card' style='width: 18rem;''>
        <img class='card-img-top' src='./Admin/product_images/$product_image1' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text'>$product_price</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='index.php' class='btn btn-secondary'>Go Home</a>
        </div>
      </div>
    </div>

    <div class='col-mid-8'>
    <!---related card---->
    <div class='row'>
        <div class='col-md-12'>
            <h4 class='text-center'>Related Products</h4>
        </div>
        <div class='col-md-6'>
            <img class='card-img-top' src='./Admin/product_images/$product_image2' alt='$product_title'>

        </div>
        <div class='col-md-6'>
            <img class='card-img-top' src='./Admin/product_images/$product_image3' alt='$product_title'>

        </div>
    </div>


</div>
    
    ";
          }
        }
      }
    }
  }











  //ip address function
  function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$ip = getIPAddress();  
echo 'User Real IP Address - '.$ip;  










//--------------------------cart function
function cart()
{
  global $conn;
  if (isset($_GET['add_to_cart'])) {
    $ip = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];

    // $product_quantity = $_POST['product_quantity'];
    // $product_size = $_POST['product_size'];
    // $product_color = $_POST['product_color'];

    $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip' AND product_id='$get_product_id'";
    $result_query = mysqli_query($conn, $select_query);
    $num_rows = mysqli_num_rows($result_query);

    if ($num_rows > 0) {
      echo "<script>alert('Already in the cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    } else {
      $insert_query = "INSERT INTO cart_details (product_id,ip_address,quantity) VALUES ('$get_product_id','$ip',0)";
      $result_query = mysqli_query($conn, $insert_query);
      echo "<script>alert('Product added to cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}




//function to get cart items number

function cart_item(){
  
  if (isset($_GET['add_to_cart'])) {
    global $conn;
    $ip = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
    $result_query = mysqli_query($conn, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
  }
   else {    
    global $conn;
    $ip = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
    $result_query = mysqli_query($conn, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
  }


  //total price function
  function total_cart_price(){
    global $conn;
    $get_ip_add = getIPAddress();
    $total_price = 0;
    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($conn, $cart_query);

    while($row_data = mysqli_fetch_assoc($result_query)){
      $product_id = $row_data['product_id'];
      // $product_quantity = $row_data['quantity'];
      $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
      $result_products = mysqli_query($conn, $select_products);

      while($row_data2 = mysqli_fetch_assoc($result_products)){
        $product_price = array($row_data2['product_price']);
        $product_value= array_sum($product_price);
        $total_price += $product_value;
          }
    }
    echo $total_price;
  }


//get user order detail
function get_user_order_detail(){
  global $conn;
  $usename= $_SESSION['username'];  
  $get_details= "SELECT * FROM user_table WHERE user_name='$usename'";
  $result_query = mysqli_query($conn,$get_details);
  while($row_query= mysqli_fetch_assoc($result_query)){
    $user_id = $row_query['user_id'];
    if(!isset($_GET['edit_account'])){
      if(!isset($_GET['my_orders'])){
        if(!isset($_GET['delete_account'])){
          $get_orders = "SELECT * FROM user_orders WHERE user_id='$user_id' AND order_status='pending'";
          $result_orders_query= mysqli_query($conn,$get_orders);
          $row_count = mysqli_num_rows($result_orders_query);
          if($row_count>0){
            echo "<h3 class=' mt-5 text-center text-success'>You have <span class='text-danger'>$row_count</span> pending orders</h3>

            <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
          }else{
            echo "<h3 class=' mt-5 text-center text-success'>You don't have any pending orders</h3>

            <p class='text-center'><a href='../index.php?my_orders' class='text-dark'>Explore Products</a></p>";

          }
        }      
      }
    }  
  }





  //-------------------------------------Might work for better user experience in future----------------//
  // $get_ip_add = getIPAddress();
  // $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
  // $result_query = mysqli_query($conn, $select_query);

  // while($row_data = mysqli_fetch_assoc($result_query)){
  //   $product_id = $row_data['product_id'];
  //   $product_quantity = $row_data['quantity'];
  //   $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
  //   $result_products = mysqli_query($conn, $select_products);

  //   while($row_data2 = mysqli_fetch_assoc($result_products)){
  //     $product_title = $row_data2['product_title'];
  //     $product_price = $row_data2['product_price'];
  //     $product_image = $row_data2['product_image1'];
  //     $sub_total = $product_price * $product_quantity;
  //     echo "
  //     <tr>
  //     <td>
  //         <img src='./Admin/product_images/$product_image' alt='$product_title' width='60px' height='60px'>
  //     </td>
  //     <td>
  //         $product_title
  //     </td>
  //     <td>
  //         $product_quantity
  //     </td>
  //     <td>
  //         $product_price
  //     </td>
  //     <td>
  //         $sub_total
  //     </td>
  // </tr>
  //     ";
  //   }
  // }
}
?>