<?php

error_reporting(E_ERROR | E_PARSE);

include '../connection/db.php';

session_start();

if($_SESSION['mentor'] == false) {
    header("location:../login.php"); 
    die(); 
  }

    //Assign the session variables
    $userName =  $_SESSION['userName'] ;
    $firstName =  $_SESSION['firstName'];
    $lastName =  $_SESSION['lastName'];
    $email = $_SESSION['email'] ;
    $phone = $_SESSION['phone'] ;
    $gender = $_SESSION['gender'];       
    $role =  $_SESSION['role'];
    $image = $_SESSION['image'];
    
    //Get the id from the mentor table
    $sql = $conn->query("SELECT * FROM mentor WHERE email = '$email'");
     //Grab the details of the row returned 
     while($row = $sql->fetch_object()){
        $id =  $row->id; 
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
<div class="card-container">
	<img class="round" src="../images/<?php echo $image; ?>" alt="user-photo" width='150' height='150' />
	<h3><?php echo ucfirst($firstName).' '. ucfirst($lastName);  ?></h3>
    <h4><?php echo $email;  ?></h4>
    <?php 
    //Get all mentees associated with mentor
    $sql = $conn->query("SELECT * FROM mentee WHERE mentor_id = '$id'"); ?>
	<p>The mentee(s) assigned to you is/are: <br>
        <?php 
        //Grab the details of the row returned 
            while($row = $sql->fetch_object()){ ?>
               </p>

	<div class="skills">
        <h3>ALL Your MENTEE'S Details</h3>
		<ul>
            <li>Full Name: <b class='mentee-details'><?php echo ucfirst($row->firstName).' '. ucfirst($row->lastName); ?></b></li>
			<li>Email: <b class='mentee-details'><?php echo $row->email; ?></b></li>
			<li>Phone Number: <b class='mentee-details'><?php echo $row->phone; ?></b></li>
            <li>Gender: <b class='mentee-details'><?php echo $row->gender; ?></b></li>
        </ul>
        <?php } ?>
        <hr>
        <h3>Your Details as a MENTOR</h3>
		<ul>
			<li>Username: <b class='mentee-details'><?php echo $userName; ?></b></li>
			<li>Phone Number: <b class='mentee-details'><?php echo $phone; ?></b></li>
			<li>Gender: <b class='mentee-details'><?php echo $gender; ?></b></li>
        </ul>
            <a href='../logout.php' class='logout' name='btn-logout'>Logout</a>
	</div>
</div>
</body>
</html>