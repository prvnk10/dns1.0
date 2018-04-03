<?php
require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');

require_once('require/get_user_info.php');

$f_id = $_SESSION['f_id'];
$username = $_SESSION['username'];

$f_department_name = $_SESSION['department'];
$f_department_id = $_SESSION['d_id'];

$query = "SELECT cf.course_code, cf.subsection_id, c.semester, c.subject_name FROM course_faculty AS cf INNER JOIN courses as c using(course_code) where f_id='$f_id'";

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
   echo "<div class='form-group col-sm-4 col-md-4'> <h5> Select Course (and semester) </h5> </div>";
   # echo "<div class='list-group'>";

   echo "<div class='form-group col-sm-4 col-md-4'>";

   echo "<select class='form-control' id='courses_list' name='courses_list'>";
   echo "<option></option>";

   while($results = $q_processing->fetch_assoc())
   {
      echo "<option id='" . $results['course_code'] . "' value='" . $results['course_code'] . "'> " . $results['subject_name'] . " ( " . $results['semester'] . " semester " . $results['course_code'] . ") </a>";
   }

   echo "</select>";
   echo "</div>";

}

else
{
  echo "<p class='alert alert-danger'> Currently no courses are assigned to you </p>";
}

?>
