<div class="col-sm-4 col-md-3">
 <div class="list-group f_p_nav_links">

   <a href='faculty_profile.php' class="col-sm-8 list-group-item active"> Home </a>
   <a href='faculty_profile.php?u=' class="col-sm-8 list-group-item"> Timetable </a>
   <a href='faculty_profile.php?u=4' class="col-sm-8 list-group-item"> Roll Sheet </a>
   <a href='faculty_profile.php?u=5' class="col-sm-8 list-group-item"> Message </a>
   <a href='faculty_profile.php?u=6' class="col-sm-8 list-group-item"> Marks </a>
   <a href="faculty_profile.php?u=7" class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-upload"></span> Upload Study Material </a>
   <a href="faculty_profile.php?u=8" class="col-sm-8 list-group-item"> Upload Assignments </a>
   <!--  <a href="#assignments_content" class="col-sm-8 list-group-item" data-toggle="collapse"> Upload Assignments </a> -->
   <div id="assignments_content" class="collapse text-left"> <div> <li class="list-group-item"> f </li> <li> h </li> </ul> </div> </div>
   <a href="faculty_profile.php?u=9" class="col-sm-8 list-group-item"> Upcoming events </a>
   <a href="faculty_profile.php?u=10" class="col-sm-8 list-group-item"> Feedback </a>
   <a href='faculty_profile.php?u=13' class="col-sm-8 list-group-item"> <span class="glyphicon glyphicon-search"></span> Search  </a>
   <a href="faculty_profile.php?u=11" class="col-sm-8 list-group-item"> Assign assignments </a>
   <a href="faculty_profile.php?u=14" class="col-sm-8 list-group-item"> Suggestion Box </a>
   <a href="faculty_profile.php?u=12" class="col-sm-8 list-group-item"> Edit Profile </a>
   <a href='logout.php' class="col-sm-8 list-group-item"> Logout </a>

 </div>
</div>


<div class="col-sm-8 col-md-9" id="showContent">

<?php

$id = isset($_GET['u']) ? $_GET['u'] : 0 ;

switch ($id) {

  /*   case 2:
      require_once('students_list_shown_to_teacher.php');
      break; */

    case 3:
     require_once('faculty/students_list_shown_to_teacher.php');
     break;

    case 4:
     require_once('faculty/roll_sheet.php');
     break;

     case 5:
      require_once('message.php');
      break;

     case 6:
      require_once('marks2.php');
      break;

     case 7:
      require_once('faculty/upload_study_material.php');
      break;

     case 8:
      require_once('assignments.php');
      break;

     case 9:
      require_once('events.php');
      break;

     case 10:
      require_once('feedback.php');
      break;

     case 11:
      require_once('assign_assignment.php');
      break;

     case 12:
      require_once('change_password.php');
      break;

     case 13:
      require_once('require/search.php');
      break;

      case 14:
        require_once('require/suggestion.php');
        break;

    default:
      echo "Here we will show the latest news related to faculty department";
      break;
  }

  ?>

  </div>
