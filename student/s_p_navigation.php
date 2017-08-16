<div class="col-sm-4 col-md-3">

 <div class="list-group s_p_nav_links">

  <a href='student_profile.php' class="col-sm-8 col-md-8 list-group-item active"> <span class="glyphicon glyphicon-home"></span> Home </a>
  <!-- <a href='' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-calendar"></span> Academic Calendar </a> -->
  <a href='student_profile.php?q=3' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-book"></span> Subjects </a>
  <!-- <a href='' class="col-sm-8 list-group-item"> Attendance </a> -->
  <!-- <a href='student_profile.php?q=' class="col-sm-8 list-group-item"> Inbox <span class='badge'> <?php # echo $no_of_messages; ?> </span> </a>  -->
  <a href='student_profile.php?q=21' class="col-sm-8 list-group-item"> <span class="fa fa-inr"></span> Hostel Dues </a>
  <a href='student_profile.php?q=22' class="col-sm-8 list-group-item"> Marks </a>
  <a href='' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-blackboard"></span> Notice Board  </a>
  <a href='student_profile.php?q=46' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-education"></span> Progress Report </a>
  <!-- <a href='register1.php' class="col-sm-8 list-group-item" target="_blank"> Registration </a>  -->
  <a href='student_profile.php?q=45' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-search"></span> Search  </a>
  <a href='student_profile.php?q=10' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-pencil"></span> Edit Profile </a>
  <!-- <a href='' class="col-sm-8 list-group-item"> Timetable </a>  -->
  <a href='student_profile.php?q=11' class="col-sm-8 list-group-item"> Suggestion Box </a>
  <a href="logout.php" class="col-sm-8 list-group-item"> Logout <span class="glyphicon glyphicon-log-out"></span> </a>

 </div>
</div>

<div class="col-sm-8 col-md-9" id="showContent">

<?php

$id = isset($_GET['q']) ? $_GET['q'] : 0 ;

switch ($id) {

case 3:
require_once('student/subjects.php');
break;

case 10:
require_once('require/change_password.php');
break;

case 11:
require_once('require/suggestion.php');
break;

case 21:
 require_once('student/get_hostel_dues.php');
 break;

case 22:
 require_once('student/marks.php');
 break;


case 45:
 require_once('require/search.php');
 break;

case 46:
 require_once('student/progress_report.php');
 break;


default:
echo "Here we will show the latest news related to student branch";
break;
}

?>

</div>
