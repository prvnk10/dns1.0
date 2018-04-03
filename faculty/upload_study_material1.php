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

   echo "<div class='alert alert-info alert-dismissible'>";
   echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
   echo "You can upload files with extension .pdf, .docx, .txt or mention any online study material link for students";
   echo "</div>";

   echo "<div class='alert alert-info alert-dismissible'>";
   echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
   echo "Maximum size of file is limited to 5mb.";
   echo "</div>";

   echo "<div id='container'>";
   echo "<form class='form-horizontal' method='post' enctype='multipart/form-data' action=''>";

   require_once('faculty/list_of_courses.php');

   $user_file_Err = '';

?>



  <div class="form-group col-sm-12 col-md-12">

    <label class="control-label col-xs-12 col-sm-4 col-md-3" for="user_file"> Select file to upload: </label>


      <input type="file" class="form-control col-sm-4 col-md-4" name="user_file" required="required" id="user_file">


    <div class="col-sm-4"> <span class="error"> <?= $user_file_Err ?> </span> </div>

  </div>



   <div class="form-group col-sm-6 col-md-6">
     <div class="col-sm-8">
      <input type="submit" class="btn btn-info" name="upload_content" value="Upload" class="btn btn-info" />
     </div>
   </div>



</form>

<?php

}

else
{
  echo $_GET['cc'];
}

?>

<script src="script/upload_study_material.js"></script>

</div>


</div>
