<?php

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

?>
