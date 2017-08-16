<?php
require_once('connection.php');

$topic_id = $_POST['topic_id'];

$msg = $_POST['suggestion_msg'];

if(strlen($msg) <= 0)
{
  echo "Please enter any message";
  $show_form = true;
  die();
}

$username = $_SESSION['username'];

$query = "INSERT INTO suggestions(topic_id, submitted_by_username, message) VALUES('$topic_id', '$username', '$msg')";

$q_processing = $conn->query($query);

if($q_processing === TRUE)
{
  echo "Suggestion submitted successfully";
}

else
{
  echo "There is some error. Please try after some time";
}

?>
