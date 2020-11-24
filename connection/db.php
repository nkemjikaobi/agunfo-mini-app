<?php

//Initialize the connection variables
$localhost =  'localhost';
$username = 'root';
$password = '';
$database = 'agunfon-app';

//Create the connection
$conn = new mysqli($localhost, $username, $password, $database);

//Output an error message if there is no connection
if($conn->connect_errno){
    die("Error: ".'<span style=color:red;>'.$conn->connect_error.'</span>');
}



?>