<script src="script/change_password.js"></script>

<?php

# require_once('test_input.php');

# echo var_dump($_POST);

# $username = $_SESSION['username'];
# $password = $_POST['data']['current_password'];

function check_current_password($username, $password)
{
  $conn = new mysqli(servername , username, password , db_name);
  $username = test_input($username);
  $password = test_input($password);
  $password = sha1($password);

  $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
  $q_processing = $conn->query($query);

  if($q_processing->num_rows == 1)
  {
    return True;
  }
  else
  {
    return False;
  }

}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{
    require_once('connection.php');
    require_once('test_input.php');

    $current_password =  $_POST['current_password'];
    $username = $_SESSION['username'];

    $result = check_current_password($username, $current_password);
    # echo $result;

    if($result)
    {
      ?>

      <div class="container">

       <form action="" method="post" class="form-horizontal" id="form_enter_new_pw">
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

    else
    {
      echo "<p class='alert alert-danger'> Invalid password. </p>";
    }
}



?>
