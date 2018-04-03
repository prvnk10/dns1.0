<?php


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{
   // echo "ajax request";

require_once('../require/connection.php');

// checks if the user's logged in or not and redirect user to login.php is user's not logged
require_once('../require/prevent_invalid_access.php');

// if user category other than student, then redirect to correct profile page
if($_SESSION['user_category'] != 'student')
{
  echo "<div class='alert alert-danger'> You don't have the permission to access this page. You will be redirected to your profile page in 5 seconds. </div>";
  header("Refresh: 5; url=index.php" );
}

$course_code =  $_GET['course_code'];
$f_id = $_GET['f_id'];

}

function get_study_material($course_code, $f_id)
{
  $query = "SELECT s_m_id, s_m_name, s_m_link FROM study_material WHERE course_code='$course_code' AND uploaded_by_f_id = '$f_id' ";
  $q_result = $conn->query($query);

  if($q_result->num_rows > 0)
  {
    echo "<div id='g_subject_study_material' class='alert alert-info col-sm-12'>";
    while($q_result = $q_processing->fetch_assoc())
    {
      $study_material_url = 'get_study_material.php';
    }
  }

}

?>
