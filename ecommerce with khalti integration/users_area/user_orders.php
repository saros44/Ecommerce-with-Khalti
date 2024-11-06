<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!--Boostrap Css-->
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">

<!--FontAwesome Css--->
<link rel="stylesheet" href="../CSS/all.min.css">

<!--Google Font--->
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

<!--Custom Css-->
<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
<?php 
            $username = $_SESSION['username'];
            $get_user = "SELECT * FROM `user_table` WHERE `user_name` = '$username'";
            $result = mysqli_query($conn,$get_user);
            $row_fetch = mysqli_fetch_assoc($result);
            $user_id = $row_fetch['user_id'];
            //echo $user_id;
?>


    <h3 class="text-success">All Orders</h3>
    <table class="table table-bordered mt-5 text-center">
        <thead class="bg-info">
            <tr>
                <th>Sl no.</th>
                <th>Amount Due</th>
                <th>Total products</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
 <?php
  $number=1;
 $get_order_details = "SELECT * FROM `user_orders` WHERE `user_id` = '$user_id'";
 $result_orders = mysqli_query($conn,$get_order_details); 
 while($row_data = mysqli_fetch_assoc($result_orders)){
     $order_id = $row_data['order_id'];
     $amount_due = $row_data['amount_due'];
     $total_products = $row_data['total_products'];
     $invoice_number = $row_data['invoice_number'];
     $order_status = $row_data['order_status'];
     $order_date = $row_data['order_date'];
     

     if($order_status == 'pending'){
         $order_status = "<span class='text-success'>Incomplete</span>";
     }
     else{
        $order_status = "<span class='text-danger'>complete</span>";
     }
    

         

     echo "<tr>
     <td>$number</td>
     <td>$amount_due</td>
     <td>$total_products</td>
     <td>$invoice_number</td>
     <td>$order_date</td>
     <td>$order_status</td>";
     ?>
     <?php

     //php code to display paid if order is complete and confirm if order is pending
     //select order_status from users_table
        //if order_status is complete then echo paid
        //else echo confirm
        $select_order_status = "SELECT `order_status` FROM `user_orders` WHERE `order_id` = '$order_id'";
        $result_order_status = mysqli_query($conn,$select_order_status);
        $row_fetch = mysqli_fetch_assoc($result_order_status);
        $order_status = $row_fetch['order_status'];
        echo $order_status;


        if($order_status=='complete'){
            echo "<td>Paid</td>";
        }
        else{
            echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
            </tr>";
        } 

     
    $number++;
 }
?>
        </tbody>
    </table>

</body>

































</html>