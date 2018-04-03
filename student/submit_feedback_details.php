<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{
    // echo "ajax request";
    if(isset($_POST))
    {
      // echo var_dump($_POST);
      extract($_POST);
      $username = $username;
      $course_code = $course_code;
      $f_id = $f_id;

      $feedback = array();

      foreach($_POST as $key => $value)
      {
        // $k = '$'.$key;
        // $k =  $value;
        $feedback[$key] = $value;
      }

      // echo var_dump($feedback);

      $feedback = serialize($feedback);

      # echo var_dump($feedback);

      $re = (unserialize($feedback));

      # $r =  var_export($re);

       // echo var_dump($re);

       // echo $re['username'];

      // echo $q_id_1;

      require_once('../require/connection.php');

      $query = "INSERT INTO faculty_feedback(username, f_id, course_code, feedback) VALUES('$username', '$f_id', '$course_code', '$feedback')";
      $q_processing = $conn->query($query);

      if($q_processing === true)
      {
        // return True;
        echo "<p class='alert alert-success'> Your feedback is submitted successfully. Thank you for your valuable time. </p>";
      }
      else
      {
        echo "<p class='alert alert-danger'> There is some error in submitting your feedback. Please try again after some time and if this persists, please write to us at admin@diginit.com";
      }

    }         // if block ends here
}

?>
