<?php
require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'student')
{
  echo "<div class='alert alert-warning'> You're not logged in so you will be redirected to home page in 5 seconds";
  header("Refresh: 5 , index.php");
}

require_once('student/subject_list.php');

require_once('require/get_user_info.php');

?>

<div>
<div id="showMarks" class="col-sm-6"> </div>
</div>
