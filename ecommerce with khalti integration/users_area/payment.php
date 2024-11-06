<?php

include('../includes/dbconnect.php');
include('../functions/common_function.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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

    <?php
    //php code to access user id
    $user_ip = getIPAddress();
    $get_user= "SELECT * FROM user_table WHERE user_ip='$user_ip'";
    $result = mysqli_query($conn,$get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];

    ?>


    <div class="container">
        <h2 class="text-center text-info">Payment options</h2>
        <div class="row d-flex justify-content-center align-item-center mt-5">

             <!-- <div class="col-md-6">
                <a href="#" >
                    <img src="../images/khalti.png" alt="khalti">
                    <button id="payment-button">Pay with Khalti</button>
                </a>
            </div>  -->

            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2 class="text-center">Pay Offline</h2>
                </a>
            </div>




        </div>
    </div>

    










</script>




















</body>
</html>  