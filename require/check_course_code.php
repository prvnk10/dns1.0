<?php

require_once('connection.php');

if(isset($_GET['cc']))
{
  // echo $_GET['cc'];

  $cc = $_GET['cc'];

  $query = "SELECT course_code FROM courses WHERE course_code = '$cc' ";
  $q_processing = $conn->query($query);

  if($q_processing->num_rows != 0)
  {
    echo "This course is already in the database";
  }
  else
  {
    echo '';
  }


}




 ?>
