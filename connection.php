<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$db ="sign_up";


// signup USER
if (isset($_POST['signup'])) {
    // receive all input values from the form
    $username = ($_POST['username']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $confirmpassword = ($_POST['confirmpassword']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $confirmpassword) {
        array_push($errors, "The two passwords do not match");
      }
    
  
    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    
    
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
  
        $query = "INSERT INTO users "." ('username', 'password', 'email') "."
                  VALUES "."('$username', '$password', '$email')";
                  mysqli_query($dbname, $query);

                  $_SESSION['username'] = $username;
                  $_SESSION['success'] = "You are now logged in";
                
          } 
          echo "sign up success\n";
          mysqli_close($conn);
          }
    
?>
