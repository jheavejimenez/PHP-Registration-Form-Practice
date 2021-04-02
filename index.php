 <?php
  require_once 'core/init.php';
  if (Input::exists()){
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array(
        'name' => 'Username',
        'required' => true,
        'min' => 2,
        'max' => 20,
        'unique' => 'users',

      ),
      'password' => array(
        'required' => true,
        'min' => 6,
      ),
      'confirmpassword' => array(
        'required' => true,
        'matches' => 'password',
      ),
      'name' => array(
        'required' => true,
        'min' => 2,
        'max' => 50
      ),
      
    ));
    if($validation->passed()){
      echo "passed";
    }else {
      foreach($validation->errors() as $error) {
        echo $error, '<br>';
      }
    }

  }
?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="statics/style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
            </div>
          </form>

<!-- Signup/Register -->

          <form method= "post" action= "" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" id="username" value="<?php echo Input::get('username');?>" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="name" id="name"  value="<?php echo Input::get('password');?>" placeholder="name" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" />
            </div>
            <input type="submit" name="signup"class="btn" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
            </div>
          </form>

<!--End of Signup/Register -->

        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image"/>
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image"/>
        </div>
      </div>
    </div>
    <script src="statics/app.js"></script>
  </body>
</html>
