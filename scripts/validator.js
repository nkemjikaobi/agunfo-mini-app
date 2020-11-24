// Defining a function to display error message
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var firstName = document.registerForm.firstName.value;
    var lastName = document.registerForm.lastName.value;
    var email = document.registerForm.email.value;
    var userName = document.registerForm.userName.value;
    var phone = document.registerForm.phone.value;
    var gender = document.registerForm.gender.value;
    var role = document.registerForm.role.value;
    var password = document.registerForm.password.value;
    var confirmPassword = document.registerForm.confirmPassword.value;


	// Defining error variables with a default value
    var firstNameErr = lastNameErr = emailErr = userNameErr =  phoneErr = roleErr = genderErr = passwordErr = confirmPasswordErr =  true;

    // Validate firstName
    if(firstName == "") {
        printError("firstNameErr", "Please enter your first name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if(regex.test(firstName) === false) {
            printError("firstNameErr", "Please enter a valid first name");
        } else {
            printError("firstNameErr", "");
            firstNameErr = false;
        }
    }

     // Validate lastName
     if(lastName == "") {
        printError("lastNameErr", "Please enter your last name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if(regex.test(lastName) === false) {
            printError("lastNameErr", "Please enter a valid last name");
        } else {
            printError("lastNameErr", "");
            lastNameErr = false;
        }
    }
    
    // Validate Email
    if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }

     // Validate Username
     if(userName == "") {
        printError("userNameErr", "Please enter your username");
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if(regex.test(userName) === false) {
            printError("userNameErr", "Please enter a valid username");
        } else {
            printError("userNameErr", "");
            userNameErr = false;
        }
    }
    
    // Validate phone number
    if(phone == "") {
        printError("phoneErr", "Please enter your phone number");
    } else {
        var regex = /^[0-9]\d{10}$/;
        if(regex.test(phone) === false) {
            printError("phoneErr", "Please enter a valid 11 digit phone number");
        } else{
            printError("phoneErr", "");
            phoneErr = false;
        }
    }
    
    
    // Validate gender
    if(gender == "") {
        printError("genderErr", "Please select your gender");
    } else {
        printError("genderErr", "");
        genderErr = false;
    }

      // Validate role
      if(role == "") {
        printError("roleErr", "Please select your role");
    } else {
        printError("roleErr", "");
        roleErr = false;
    }


    //Validate password
    if(password == ""){
        printError("passwordErr", "Please enter your password");
    }else{
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/
        if(regex.test(password) === false) {
            printError("passwordErr", "Password must have a minimum of 8 characters, a numeric digit, a lowercase letter and an uppercase letter");
        } else{
            printError("passwordErr", "");
            passwordErr = false;
        }
    }

    //Validate confirm password
    if(confirmPassword == ""){
        printError("confirmPasswordErr", "Please confirm your password");
    }else{
        var password = password
        if(confirmPassword !== password ) {
            printError("confirmPasswordErr", "Passwords don't match");
        } else{
            printError("confirmPasswordErr", "");
            confirmPasswordErr = false;
        }
    }
    
    // Prevent the form from being submitted if there are any errors
    if((firstNameErr || lastNameErr || emailErr || userNameErr || phoneErr || roleErr || genderErr || passwordErr || confirmPasswordErr ) == true) {
       return false;
    }
};