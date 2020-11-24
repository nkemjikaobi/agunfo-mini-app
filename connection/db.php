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

$sql = "CREATE TABLE users (
    id int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    userName varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    gender varchar(255) NOT NULL,
    role varchar(255) NOT NULL,
    image blob NOT NULL,
    password varchar(255) NOT NULL
)";
 
 $sql1 = "CREATE TABLE mentor (
    id int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    userName varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    gender varchar(255) NOT NULL,
    role varchar(255) NOT NULL,
    image blob NOT NULL,
    password varchar(255) NOT NULL
)";

$sql2 = "CREATE TABLE mentee (
    id int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(255) NOT NULL,
    lastName varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    userName varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    gender varchar(255) NOT NULL,
    role varchar(255) NOT NULL,
    image blob NOT NULL,
    password varchar(255) NOT NULL,
    mentor_id int(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "users created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
if ($conn->query($sql1) === TRUE) {
    echo "mentor created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  if ($conn->query($sql2) === TRUE) {
    echo "mentee created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

$conn->close();



?>