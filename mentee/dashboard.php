<?php

error_reporting(E_ERROR | E_PARSE);

include '../connection/db.php';

session_start();

if(!$_SESSION['mentee']) {
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
        $id = $_SESSION['id'] ;
        $image = $_SESSION['image'];

        $sql = $conn->query("SELECT * FROM mentee WHERE email = '$email'");

        //Grab the details of the row returned 
        while($row = $sql->fetch_object()){
            $mentor_id =  $row->mentor_id; 
        }

        //Get the associated mentor details
        $sql = $conn->query("SELECT * FROM mentor WHERE id = '$mentor_id'");

        //Grab the details of the row returned 
        while($row = $sql->fetch_object()){
            $mentor_firstName =  $row->firstName; 
            $mentor_lastName =   $row->lastName; 
            $mentor_email =  $row->email; 
            $mentor_userName =  $row->userName; 
            $mentor_phone = $row->phone;
            $mentor_gender =  $row->gender; 
            $mentor_role =  $row->role; 
        }

        

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentee</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
<div class="card-container">
	<img class="round" src="../images/<?php echo $image; ?>" alt="user-photo" width='150' height='150' />
	<h3><?php echo ucfirst($firstName).' '. ucfirst($lastName);  ?></h3>
	<h4><?php echo $email;  ?></h4>
	<p>The mentor assigned to you is <b class='mentee-details'><?php echo ucfirst($mentor_firstName).' '. ucfirst($mentor_lastName); ?></b></p>

	<div class="skills">
		<h3>Your Details as a MENTEE</h3>
		<ul>
			<li>Username: <b class='mentee-details'><?php echo $userName; ?></b></li>
			<li>Phone Number: <b class='mentee-details'><?php echo $phone; ?></b></li>
			<li>Gender: <b class='mentee-details'><?php echo $gender; ?></b></li>
        </ul>
        <hr>
        <h3>Your MENTOR'S Details</h3>
		<ul>
			<li>Email: <b class='mentee-details'><?php echo $mentor_email; ?></b></li>
			<li>Phone Number: <b class='mentee-details'><?php echo $mentor_phone; ?></b></li>
			<li>Gender: <b class='mentee-details'><?php echo $mentor_gender; ?></b></li>
        </ul>
            <a href='../logout.php' class='logout' name='btn-logout'>Logout</a>
	</div>
</div>
</body>
</html>