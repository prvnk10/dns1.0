<?php
// if username and user_category is not set, then redirect user to login page

if(!isset($_SESSION['username'] , $_SESSION['user_category'])){
  header("Location: login.php");
}

?>
