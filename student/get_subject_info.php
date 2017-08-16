<?php


require_once('../require/connection.php');

/*

check the path of the following files

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'student')
{
  require_once('require/redirect_user_to_profile_page.php');
}
*/

if( !isset($_GET['course_code']) || strlen($_GET['course_code']) == 0 )
{
  exit();
}
else
{
  $course_code =  $_GET['course_code'];
  // echo $_SESSION['section'];

  $user_section = $_SESSION['section'];

  # $query = "SELECT credit, subject_info FROM courses WHERE course_code = '$course_code'";

  $query = "SELECT cf.f_id, fpd.name, fpd.email, c.subject_name, c.credit, c.subject_info FROM course_faculty AS cf INNER JOIN faculty_p_details AS fpd USING (f_id) INNER JOIN courses AS c USING(course_code) WHERE course_code='$course_code' AND section = '$user_section' ";

  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {

    echo "<div id='g_subject_info'>";
    while($q_result = $q_processing->fetch_assoc())
    {
      echo "<p> Faculty Name: " . $q_result['name'] . "</p>";
      echo "<p> Faculty Email: " . $q_result['email'] . "</p>";
      // echo "<p> Subject Name: " . $q_result['subject_name'] . "</p>";
      echo "<p> Credit: " . $q_result['credit'] . "</p>";
      echo "<p> Subject Info. " . $q_result['subject_info'] . "</p>";

      echo "<p> <button class='btn btn-default'> Study Material </button> </p>";
      echo "<p> <button class='btn btn-default'> Feedback </button> </p>";

      # echo $q_result['credit'];

    }
    echo "</div>";
  }

}


 ?>
