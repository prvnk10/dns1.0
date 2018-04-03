<?php
require_once('connection.php');
require_once('test_input.php');

$topic_id = $_GET['topic_id'];

$msg = $_GET['suggestion_msg'];
$msg = test_input($msg);

if(strlen($msg) <= 0)
{
  echo "Please enter any message";
  $show_form = true;
  die();
}


$username = $_SESSION['username'];

$query = "INSERT INTO suggestions(s_topic_id, s_by_username, s_message) VALUES('$topic_id', '$username', '$msg')";
$q_processing = $conn->query($query);

if($q_processing === TRUE)
{
  echo "<p class='alert alert-success'> Suggestion submitted successfully </p>";
}

else
{
  echo "<p class='alert alert-danger'> There is some error. Please try after some time </p>";
}

?>
