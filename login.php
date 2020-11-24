<?php
error_reporting(E_ERROR | E_PARSE);

//include connection file
include 'connection/db.php';

//start session
session_start();

if(isset($_POST['btn-login'])){

    //Grab values email and password from login form
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $hpassword = password_hash($password, PASSWORD_DEFAULT);
    
    
    //Create the query and get the number of rows returned from the query
    $sql = $conn->query("SELECT * FROM users WHERE email = '$email'");
    $count = mysqli_num_rows($sql);
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Create condition to check if there is 1 row with that email
        if($count != 0){
    
            //Grab the details of the row returned ans store in sessions
            while($row = $sql->fetch_object()){
                $_SESSION['userName'] = $row->userName;
                $_SESSION['firstName'] = $row->firstName;
                $_SESSION['lastName'] = $row->lastName;
                $_SESSION['email'] = $row->email;
                $_SESSION['phone'] = $row->phone;
                $_SESSION['gender'] = $row->gender;
                $_SESSION['role'] = $row->role;
                $_SESSION['id'] = $row->id;
                $_SESSION['image'] = $row->image;
            }

        
    //Create condition to check if email and password inputted by user are equal to the returned row

    if($email == $_SESSION['email']){
        if(password_verify($password, $hpassword)){
        
            if($_SESSION['role'] == 1){
                $_SESSION['mentor'] = true;
                header('Location:mentor/dashboard.php');
    }
             
        else if($_SESSION['role'] == 2){ 
            $_SESSION['mentee'] = true;
            header('Location:mentee/dashboard.php');
        }
        
         }
                else{
                    $message = "<div class='alert'>
                    <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                    Check your email or password again
                  </div>";
                }
            }
            else{
                $message = "<div class='alert'>
                <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                Check your email or password again
              </div>";
            }
    
        
        }
        else{
            $message = "<div class='alert'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        User not found
      </div>";
         }
    } 
    
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    
    <div class='container'>
    <?php if(isset($message)){ echo $message; }  ?>
        <form action="" method='POST'>
            <div class='form-group'>
                <label for="email">Email</label>
                <input type="email" name='email' id='email' placeholder="Enter your email" required>
            </div>
            <div class='form-group'>
                <label for="password">Password</label>
                <input type="password" name='password'  id='password' placeholder="Enter your password" required>
            </div>
            <div class='form-group'>
                <input type="submit" name='btn-login' value='Sign In'>
            </div>
            <div class='form-group'>
                <a href='index.php' id='register'>Don't have an account?</a>
            </div>
        </form>
</div>

    
</body>
</html>