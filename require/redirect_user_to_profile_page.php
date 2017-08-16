<?php
// if username and user_category is set, then redirect user to correct profile page

if(isset($_SESSION['username'] , $_SESSION['user_category'])){
  $redirect_url =  $_SESSION['user_category'] . '_profile.php';

  header("Location: ". $redirect_url);
}

?>
