<?php

//Initialize the connection variables
// $localhost =  'localhost';
// $username = 'root';
// $password = '';
// $database = 'agunfon-app';

$localhost = 'us-cdbr-east-02.cleardb.com';
$username = 'b8b035cab1256e';
$password = 'b3b80b4d';
$database  = 'heroku_e873ece68f86724';


//Create the connection
$conn = new mysqli($localhost, $username, $password, $database);

//Output an error message if there is no connection
if($conn->connect_errno){
    die("Error: ".'<span style=color:red;>'.$conn->connect_error.'</span>');
}





?>