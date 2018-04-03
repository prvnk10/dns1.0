<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{
  require_once('../require/connection.php');
  require_once('../require/test_input.php');
  # echo "sad";
  $f_id = $_SESSION['f_id'];

  $msg = test_input($_POST['message']);

  if(empty($msg)){
    $msg_send_failed = "You can't send an empty message";
  }

  # echo var_dump($_POST);

  $receivers = $_POST['receivers'];

  if(empty($receivers))
  {
    echo "<div class='alert alert-danger'> Please select the receiver(s). </div>";
    exit();
  }

  $no_of_receivers = count($receivers);

  for($i=0; $i < $no_of_receivers; $i++)
  {
    $insert_query = "INSERT INTO messages_delivered(msg_by_f_id, msg_for_subsection_id, msg ) VALUES('$f_id' , '$receivers[$i]' , '$msg')";
    $insert_query_processing = $conn->query($insert_query);

    if($insert_query_processing)
    {
      echo "<div class='alert alert-success'> Message send successfully. </div>";
    }

  }



}




?>
