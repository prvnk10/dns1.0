<?php
# require_once('require/connection.php');
# require_once('test_input.php');


function update_password($username, $password)
{
  $conn = new mysqli(servername , username, password , db_name);
  $username = test_input($username);
  $password = test_input($password);
  $new_password = sha1($password);

  $query = "UPDATE login SET password = '$new_password' , password_last_updated_on = NOW() WHERE username = '$username' LIMIT 1";
  $q_processing = $conn->query($query);

  if($q_processing === true)
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

    $new_password =  $_POST['new_password'];
    $username = $_SESSION['username'];

    $result = update_password($username, $new_password);
    # echo $result;

    if($result)
    {
      echo "<p class='alert alert-success'> Password updated successfully </p>";
    }

    else
    {
      echo "<p class='alert alert-danger col-sm-4'> Invalid password. </p>";
    }

}


?>
