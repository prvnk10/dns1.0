<?php
// include the connetion file
require_once('require/connection.php');

// checks if the user's logged in or not and redirect user to login.php is user's not logged
require_once('require/prevent_invalid_access.php');

// if user category other than student, then redirect to correct profile page
if($_SESSION['user_category'] != 'student')
{
  echo "<div class='alert alert-danger'> You don't have the permission to access this page. You will be redirected to your profile page in 5 seconds. </div>";
  header("Refresh: 5; url=index.php" );
}

$user_category = $_SESSION['user_category'];

# grab student's roll no from session
$username = $_SESSION['username'];
$current_sem = $_SESSION['current_sem'];
# $section = $_SESSION['section'];
$programme_id = $_SESSION['programme_id'];
$department_id = $_SESSION['department_id'];

# query to grab the course_code, subject from courses table ; faculty_id from course_faculty table and faculty name from faculty table

# $query = "SELECT c.course_code, c.subject_name, c.credit, cf.f_id, f.name FROM courses as c INNER JOIN course_faculty as cf using (course_code) INNER JOIN faculty_p_details as f using(f_id) WHERE semester = '$current_sem' AND section='$section' ORDER BY course_code ";

$query = "SELECT c.course_code, c.subject_name FROM courses as c WHERE semester = '$current_sem' AND p_id='$programme_id' AND d_id='$department_id' ORDER BY course_code ";

$q_result = $conn->query($query);

# echo $q_result->num_rows ;

if($q_result->num_rows > 0)
{

  echo "<div class='form-group col-sm-4 col-md-4'>";
  # echo "<label for='sel1' class='col-sm-4 col-md-4'> Subject: </label>";
  echo "<select class='form-control' id='subject_list' name='subject_list'>";
   # echo "<label for='subject_list'> Select Subject </label>";

  echo "<option></option>";

   while($q_data = $q_result->fetch_assoc())
   {
      echo "<option id='" . $q_data['course_code'] . "' value='" . $q_data['course_code'] . "'> " . $q_data['subject_name'] . "</option>";
   }

   echo "</select>";
   echo "</div>";

}

?>
