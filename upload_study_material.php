<div id="content">

<?php

/*
if(isset($_GET['cc']))
{

  require_once('../require/connection.php');
  require_once('../require/prevent_invalid_access.php');
  require_once('../require/get_user_info.php');

  if($_SESSION['user_category'] != 'faculty')
  {
    require_once('require/redirect_user_to_profile_page.php');
  }

  $f_id = $_SESSION['f_id'];


  $course_code = $_GET['course_code'];
  $semester = $_GET['semester'];

  if($upload_successful != '') echo '<div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $upload_successful . '</div>';
  if($upload_failed != '') echo '<div class="alert alert-danger alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $upload_failed . '</div>';

  echo "<div class='alert alert-info'>" . $course_code . ' ' .  $semester . '<sup> th </sup> semester </div>' ;

  echo "<form enctype='multipart/form-data' class='form-inline' method='post' >";

  echo "<div class='form-group'>";
  echo "<input type='file' name='notes'> ";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<button type='submit' class='btn btn-info' name='upload_notes'> Upload </button>";
  echo "</div>";

  echo "</form>";
}

*/

// the following code block gets executed when course_code and semester are not set
if(!isset($_GET['cc']))
{
   require_once('require/connection.php');
   require_once('require/prevent_invalid_access.php');
   require_once('require/get_user_info.php');

   require_once('faculty/list_of_courses.php');
}

else
{
  echo $_GET['cc'];
}

?>

<script src="script/upload_study_material.js"></script>

</div>
