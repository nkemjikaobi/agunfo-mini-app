<?php

error_reporting(E_ERROR | E_PARSE);

//Include connection file
include 'connection/db.php';

//start session
session_start();

if(isset($_POST['btn-submit'])){

    //assign the variables
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $userName = strip_tags($_POST['userName']);
    $email = strip_tags($_POST['email']);
    $phone = strip_tags($_POST['phone']);
    $gender = strip_tags($_POST['gender']);
    $role = strip_tags($_POST['role']);
    $password = strip_tags($_POST['password']);
    $confirmPassword = strip_tags($_POST['confirmPassword']);

    $firstName = $conn->real_escape_string($firstName);
    $lastName = $conn->real_escape_string($lastName);
    $userName = $conn->real_escape_string($userName);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);
    $gender = $conn->real_escape_string($gender);
    $role = $conn->real_escape_string($role);
    $password = $conn->real_escape_string($password);
    $confirmPassword = $conn->real_escape_string($confirmPassword);
    $hpassword = password_hash($password, PASSWORD_DEFAULT);

     //Get number of mentors registered
     $query = $conn->query("SELECT * FROM mentor");
     $numrows = mysqli_num_rows($query);

     //Allocate a random number to mentees to give them a mentor id
     $mentor_id = rand(1,$numrows);

     //Handle Image Upload
    $filename = $_FILES["image"]["name"]; 
    $tempname = $_FILES["image"]["tmp_name"];     
    $folder = "../images/".$filename; 

    //Default Image if user doesn't supply any
    if($_FILES['image']['name'] == "") {
        $filename = "../images/noimage.jpg";
    }


    $sql = $conn->query("SELECT email FROM users WHERE email = '$email'");
    $count = mysqli_num_rows($sql);

    if($count == 0){
        if($role == 2){

            $sqlUser = $conn->query("INSERT INTO users(firstName,lastName,email,userName,phone,gender,role,image,password)
                        VALUES('$firstName','$lastName','$email','$userName','$phone','$gender','$role','$filename','$hpassword')");

            $sqlMentee = $conn->query("INSERT INTO mentee(firstName,lastName,email,userName,phone,gender,role,image,password,mentor_id)
                        VALUES('$firstName','$lastName','$email','$userName','$phone','$gender','$role','$filename','$hpassword','$mentor_id')");

            //Store the images temporarily in a folder
            move_uploaded_file($tempname, $folder);

        if($sqlUser){
            if($sqlMentee){
            $message = "<div class='alert' style='background:green;'>
                        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                        Registration successful
                      </div>";
                      header("refresh:2; login.php");
        }
    }
        else{
            $message = "<div class='alert'>
            <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
            There was an error registering mentee
          </div>";
        }
    }else{

        $sqlUsers = $conn->query("INSERT INTO users(firstName,lastName,email,userName,phone,gender,role,image,password)
                    VALUES('$firstName','$lastName','$email','$userName','$phone','$gender','$role','$filename','$hpassword')");
                    
        $sqlMentor = $conn->query("INSERT INTO mentor(firstName,lastName,email,userName,phone,gender,role,image,password)
                    VALUES('$firstName','$lastName','$email','$userName','$phone','$gender','$role','$filename','$hpassword')");

        //Store the images temporarily in a folder
        move_uploaded_file($tempname, $folder);


    if($sqlUsers){
        if($sqlMentor){
            $message = "<div class='alert' style='background:green;'>
                    <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                    Registration successful
                  </div>";
                  header("refresh:2; login.php");
        }
    }
    else{
        $message = "<div class='alert'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        There was an error registering mentor
      </div>";
    }
    }
    }
    else{
        $message = "<div class='alert'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        Email already taken
      </div>";
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src='scripts/validator.js'></script>
</head>
<body>
    <header>
        <h1>Agunfon Interactivity</h1>
    </header>
    <div class='container'>
    <?php if(isset($message)){ echo $message; }  ?>
        <form name="registerForm" onsubmit="return validateForm()" action="" method="POST">
            <div class='form-group'>
                <label for="firstName">First Name</label>
                <input type="text" name='firstName' id='firstName' placeholder="Enter your first name" >
                <div class="error" id="firstNameErr"></div>
            </div>
            <div class='form-group'>
                <label for="lastName">Last Name</label>
                <input type="text" name='lastName' id='lastName' placeholder="Enter your last name" >
                <div class="error" id="lastNameErr"></div>
            </div>
            <div class='form-group'>
                <label for="email">Email</label>
                <input type="email" name='email' id='email' placeholder="Enter your email" >
                <div class="error" id="emailErr"></div>
            </div>
            <div class='form-group'>
                <label for="userName">Username</label>
                <input type="text" name='userName' id='userName' placeholder="Enter your username" >
                <div class="error" id="userNameErr"></div>
            </div>
            <div class='form-group'>
                <label for="phone">Phone Number</label>
                <input type="text" name='phone' id='phone' maxlength="11" placeholder="Enter your phone number" >
                <div class="error" id="phoneErr"></div>
            </div>
            <div class='form-group'>
                <label for="gender">Gender</label>
                <input type="radio" value='male'  name="gender" id="male"><label for="male" >Male</label>
                <input type="radio" value='female' name="gender" id="female"><label for="female" >Female</label>
                <input type="radio" value='other'  name="gender" id="other"><label for="other" >Other</label>
                <div class="error" id="genderErr"></div>
            </div>
            <div class='form-group'>
                <label for="role">What is your role?</label>
                <select name="role" id="role">
                    <option disabled selected='true' value="" >Select current role</option>
                    <option value="1" >Mentor</option>
                    <option value="2" >Mentee</option>
                </select>
                <div class="error" id="roleErr"></div>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file"  name="image" id="image">
            </div>
            <div class='form-group'>
                <label for="password">Password</label>
                <input type="password" name='password' id='password' placeholder="Enter your password" >
                <div class="error" id="passwordErr"></div>
            </div>
            <div class='form-group'>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name='confirmPassword' id='confirm_password' placeholder="Re-enter your password" >
                <div class="error" id="confirmPasswordErr"></div>
            </div>
            <div class='form-group'>
                <input type="submit" name='btn-submit' value='Register'>
            </div>
            <div class='form-group'>
                <a href='login.php' id='login'>Login</a>
            </div>
        </form>
</div>

    
</body>
</html>