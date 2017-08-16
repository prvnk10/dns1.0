<?php

require_once('require/connection.php');

if(isset($_SESSION['username']))
{
  require_once('require/redirect_user_to_profile_page.php');
}

else
{
  header('Location: login.php');
}

?>
