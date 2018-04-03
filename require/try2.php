<?php

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

?>
