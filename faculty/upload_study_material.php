<div id="content">
  <script src="script/upload_study_material_old.js"></script>

<?php

$show_form = true;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{

  if(isset($_POST['course_code']))
  {
    require_once('../require/connection.php');
    require_once('../require/prevent_invalid_access.php');
    require_once('../require/get_user_info.php');
    # echo 4545454;
    echo var_dump($_POST);

    $show_form = false;
  }

  else
  {
    # echo 565656;
    require_once('require/connection.php');
    require_once('require/prevent_invalid_access.php');
    require_once('require/get_user_info.php');

    $show_form = true;
  }

}



// the following code block gets executed when course_code and semester are not set

if($show_form)
{
   $user_file_Err = '';

?>

    <div class='alert alert-info alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    You can upload files with extension .pdf, .docx, .txt or mention any online study material link for students
    </div>

    <div class='alert alert-info alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    Maximum size of file is limited to 5mb.
    </div>

    <div id='container'>
    <form id='upload_study_material_form' class='form-horizontal' method='post' enctype='multipart/form-data' action=''>

     <?php require_once('faculty/list_of_courses.php'); ?>

    <div class="form-group col-sm-12 col-md-12">

      <label class="control-label col-xs-12 col-sm-4 col-md-3" for="user_file"> Select file to upload: </label>
      <input type="file" class="form-control col-sm-4 col-md-4" name="user_file" required="required" id="user_file">

      <div class="col-sm-4"> <span class="error"> <?= $user_file_Err ?> </span> </div>

    </div>


    <div class="form-group col-sm-6 col-md-6">
     <div class="col-sm-8">
      <input type="submit" class="btn btn-info" id="upload_study_material_btn" name="upload_study_material_btn" value="Upload" class="btn btn-info" />
     </div>
    </div>

    </form>

    </div>


<?php

}

?>


<div id="showContent"></div>

</div>
