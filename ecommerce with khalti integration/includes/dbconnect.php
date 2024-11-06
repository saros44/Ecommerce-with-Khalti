<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "third";

$conn  = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    echo "Connection Failed";
}
else{
    // die("Connection Failed".mysqli_connect_error());
}
?>