<?php
require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');

require_once('require/get_user_info.php');

$f_id = $_SESSION['f_id'];
$username = $_SESSION['username'];

$f_department_name = $_SESSION['department'];
$f_department_id = $_SESSION['department_id'];

$query = "SELECT cf.course_code, cf.section, c.semester, c.subject_name FROM course_faculty AS cf INNER JOIN courses as c using(course_code) where f_id='$f_id'";

$q_processing = $conn->query($query);

/*
if($q_processing->num_rows > 0)
{
   echo "<h4> Select Course (and semester) </h4>";
   echo "<div class='list-group'>";

   while($results = $q_processing->fetch_assoc())
   {
      echo "<a class='list-group-item' href='' id=''> " . $results['subject_name'] . " ( " . $results['semester'] . " semester " . $results['course_code'] . ") </a>";
   }

   echo "</div>";
}
*/

if($q_processing->num_rows > 0)
{
   echo "<h4> Select Course (and semester) </h4>";
   # echo "<div class='list-group'>";
   echo "<select class='form-control' id='courses_list' name='courses_list'>";
   while($results = $q_processing->fetch_assoc())
   {
      echo "<option id='" . $results['course_code'] . "' value='" . $results['course_code'] . "'> " . $results['subject_name'] . " ( " . $results['semester'] . " semester " . $results['course_code'] . ") </a>";
   }

   echo "</select>";
   
}

else
{
  echo "Currently no courses are assigned to you";
}

?>
