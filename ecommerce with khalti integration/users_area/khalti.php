
<?php
include('../includes/dbconnect.php');


//---------------------------------------------------------------------------------------------------------------
// Retrieve token and amount and user_id from the query parameters
$token = isset($_GET['token'])?$_GET['token'] : '';
$amount = isset($_GET['amount'])?$_GET['amount'] : '';
$order_id = isset($_GET['order_id'])?$_GET['order_id'] : '';


echo "<h3>Token is:-$token </h3>";
echo"<br>";
echo "<h3>Amount Paid is:-$amount</h3>";



// Check if token and amount are provided
// if (empty($token) || empty($amount)) {
//     http_response_code(400);
//     echo 'Invalid request. Token and amount are required.';
//     exit;
// }


$args = http_build_query(array(
    'token' => $token,
    'amount'  => $amount,
    'order_id' => $order_id,

    
  ));

$url = "https://khalti.com/api/v2/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set Khalti secret key in the headers (replace with your actual secret key)
$headers = ['Authorization: Key test_secret_key_fc75da2e86e24e97bece697019fae60e'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the request
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check for errors
if ($status_code !== 200) {
    http_response_code($status_code);
    echo 'Error in API request. HTTP Status Code: ' . $status_code;
    exit;
}

// Close cURL session
curl_close($ch);

// Process the API response
$result = json_decode($response, true);

// Check if the payment verification was successful
 if ($result) {
    
    echo '<h1>Payment successful</h1>';
    echo "<br>";
    echo $token;
    echo "<br>";

    //inserting data into user_payments table---------------------------------------------------------------------------------------------------------------------------
    $insert_query = "INSERT INTO user_payments(order_id,invoice_number,amount,payment_mode) VALUES ('$order_id','$token','$amount','Khalti')";
    $result = mysqli_query($conn,$insert_query);
    $result = mysqli_query($conn,$insert_query);
    if($result){
        echo "<script>alert('Payment Confirmed')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    else{
        echo "<script>alert('Payment Not Confirmed')</script>";
        echo "<script>window.open('user_orders.php','_self')</script>";
    }
    $update_orders = "UPDATE `user_orders` SET `order_status` = 'complete' WHERE order_id = $order_id";
    $result_update = mysqli_query($conn,$update_orders);

} else {
   
    echo '<h1>Payment failed. Redirect or display an error message.</h1>';
}
?>	