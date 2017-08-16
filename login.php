<?php
// include the connection file
require_once('require/connection.php');

if(isset($_SESSION['username']))
{
  require_once('require/redirect_user_to_profile_page.php');
}

require_once('require/header.php');

$usernameErr = $login_result = '';
$show_form = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_POST['submit'])){
   extract($_POST);

// inclue the test_input file to validate user input
   require("require/test_input.php");

   $username = test_input($username);
   $password = $password;

/*   if(!is_numeric($rollno)){
     $rollnoErr = "Please enter a valid roll no.";
     $show_form = true;
   } */

   if(!$show_form){
     $password = sha1($password);
     $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password' ";
     $q_result = $conn->query($query);

     if( $q_result->num_rows == 1 ){        # login ok

      $show_form = false;

      $q_data = $q_result->fetch_assoc();

      $_SESSION['user_category'] = $q_data['category'];
      $_SESSION['username'] = $username;

      $redirect_url =  $_SESSION['user_category'] . '_profile.php';

      require_once('require/get_user_info.php');

      header("Location: ". $redirect_url);
     }
      else {
        $login_result =  "Invalid credentials";
        $show_form = true;
      }
   }
 }
} else { $show_form = true;}

if($show_form){

 if($login_result != ''){ ?>
  <div class="alert alert-danger alert-dismissable fade in text-center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close"> x </a>
  <?php echo $login_result; ?>
  </div>
 <?php } ?>

<div class="container">
<form class="form-horizontal" method="post" action="">

 <div class="form-group">
   <label class="control-label col-xs-12 col-sm-4 col-md-4" for="username"></label>
   <div class="col-xs-12 col-sm-3 col-md-3">
     <input type="text" name="username" class="form-control" required="required" placeholder="Enter your username here"/>
   </div>
   <div class="col-sm-4"> </div>
 </div>

 <div class="form-group">
   <label class="control-label col-xs-12 col-sm-4 col-md-4" for="password">  </label>
   <div class="col-xs-12 col-sm-3 col-md-3">
     <input type="password" name="password" class="form-control" required="required" placeholder="Enter your password here" />
   </div>
   <div class="col-sm-4"></div>
 </div>

 <div class="form-group">
   <div class="col-sm-offset-4 col-sm-8">
   <button type="submit" id="login_btn" name="submit" class="btn btn-info" />
   Log In
   </button>
   </div>
 </div>

</form>
</div>

<?php
}

require_once('require/footer.php');

?>
