<div id="content">
  <div id="inner_div">

<!-- <script src="script/change_password.js" type="text/javascript"></script>  -->

<?php
// include the connection file
require_once('require/connection.php');

// checks if the user's logged in or not and redirect user to login.php is user's not logged
require_once('require/prevent_invalid_access.php');

require_once('require/get_user_info.php');

require_once('require/test_input.php');
require_once('require/check_current_password.php');
require_once('require/update_password.php');

$show_form = $show_update_form = false;
$password_changed_successfully = '';
$password_not_changed_successfully = '';

$username = $_SESSION['username'];

// find hash of current password, grab username from session, query the database checking validity of credentials
if(isset($_POST['change_password'])){
  extract($_POST);

  $password = $current_password;

  $is_correct_current_password = check_current_password($username, $password);

  if($is_correct_current_password)
  {
    $show_update_form = true;
    $show_form = false;
  }
  else
  {
    $password_not_changed_successfully = 'Incorrect password';
    $show_form = true;
    $show_update_form = false;
  }

} else { $show_form = true; }


if(isset($_POST['update_password'])){
  extract($_POST);

  $password = $new_password;

  $password_updated = update_password($username, $password);

  if($password_updated)
  {
    $show_form = false;
    $password_changed_successfully = "Password updated successfully";
    $show_update_form = false;
  }
  else
  {
    $password_not_changed_successfully = "Some error occured. Please try after some time";
    $show_update_form = true;
    $show_form = false;
  }
}

// shows the message to the user
if($password_changed_successfully != '')
{
  echo "<div class='alert alert-success alert-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . $password_changed_successfully . "</div>";
}

if($password_not_changed_successfully != '')
{
  echo "<div class='alert alert-danger alert-dismissable'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . $password_not_changed_successfully . "</div>";
}

# code block given below shows the form to enter the current password and is used to verify the identity of the user
if($show_form){
 ?>

<div class="container">

<form action="" method="post" class="form-horizontal" id="form_check_current_pw">
  <div class="form-group">
    <label class="control-label col-sm-6" for="password"> Please enter your current password </label>
    <div class="col-sm-6">
      <input type="password" class="form-control" name="current_password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-6 col-sm-6">
    <button class="btn btn-info" type="submit" name="change_password"> Continue </button>
    </div>
  </div>
</form>

</div>

<?php
}

# code block given below(shows the form to enter the new password) gets executed when the user identity is verified
if($show_update_form){

 ?>

<div class="container">

 <form action="" method="post" class="form-horizontal">
   <div class="form-group">
     <label class="control-label col-sm-4" for="password"> New Password </label>
     <div class="col-sm-6">
       <input type="password" class="form-control" name="new_password">
     </div>
   </div>

   <div class="form-group">
     <div class="col-sm-offset-4 ">
     <button class="btn btn-info " type="submit" name="update_password"> Change Password </button>
     </div>
   </div>

 </form>

</div>

<?php
 }
?>

</div>
</div>
