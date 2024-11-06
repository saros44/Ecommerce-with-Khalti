<?php 
include('../includes/dbconnect.php');
session_start();    

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    echo $order_id;
    $select_data = "SELECT * FROM `user_orders` WHERE `order_id` = '$order_id'";
    $result= mysqli_query($conn,$select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
    echo $invoice_number;
    echo"<br>";
    echo $amount_due;
    // die;
}

if(isset($_POST['confirm_payment'])){
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO user_payments(order_id, invoice_number, amount, payment_mode) VALUES ($order_id,$invoice_number,$amount,'$payment_mode')";
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

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cofirm Page</title>

       <!--Boostrap Css-->
       <link rel="stylesheet" href="../CSS/bootstrap.min.css">

        <!--FontAwesome Css--->
        <link rel="stylesheet" href="../CSS/all.min.css">

        <!--Google Font--->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

        <!--Custom Css-->
        <link rel="stylesheet" href="../CSS/style.css">

</head>
<body class="bg-secondary">
    <div class="container my-5">
         <h1 class="text-center text-light">Confirm Payment</h1>
         <form action="" method="POST">


            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" readonly
                value ="<?php echo $invoice_number?>">
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" readonly
                value ="<?php echo $amount_due?>">
            </div>
<!---------------------------------here I need to have address form for offline/COD payment----------------------->
            <div class="form-outlinemy-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto" id="">
                    <option value="">Select Payment Mode</option>
                    <option value="COD">Cash on Delivery</option>

                </select>
            </div>
<!-----------------------------------------khalti------------------------------------------------------------------------>
            <div class="col-md-6">
                <a href="#" id="payment-button">
                    <img src="../images/khalti.png" id="payment-button" alt="khalti">
                </a>
            </div> 
           

<!----------------------------------------------------------------------------------------------------------------->


            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>


        </form>
    </div>



    
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 



<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>



<script>
    
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_b955e4fc64dc4ca69ca521f556f044a2",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                  window.location.href = "khalti.php?token=" + payload.token + "&amount=" + payload.amount + "&order_id=<?php echo $order_id; ?>";
                },
                onError (error) {
                    
                    console.log(error);
                alert("Payment failed. Please try again.");
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: <?php echo ($amount_due*100)?>});
        }
    </script>
<script>




</script>






































































    
</body>
</html>