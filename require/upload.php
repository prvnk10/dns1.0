<div id="content">
   <div id="inner_div">

<?php

require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');
require_once('require/get_user_info.php');

$show_upload_form = false;
$user_file_Err = '' ;
$error_in_uploading = '';

// if the form is submitted, then the code block below will get executed
 if(isset($_POST['upload_content'])) {
   extract($_POST);

 if(empty($user_file)){
    $user_file_Err = "Please select a file";
    $show_upload_form = true;
 }

  $show_upload_form = false;
  $username = $_SESSION['username'];
  $user_category = $_SESSION['user_category'];
  $uploaded_file_name = $_FILES['user_file']['name'];
  $uploaded_file_type = $_FILES['user_file']['type'];
  $uploaded_file_size = $_FILES['user_file']['size'];
  $uploaded_file_error = $_FILES['user_file']['error'];

  $target = profile_pics_path;

  if($_SESSION['user_category'] == 'student')
  {
    $target .= '/students/';
    $table_name = "students_p_details";
  }
  elseif($_SESSION['user_category'] == 'faculty')
  {
    $target .= '/faculty/';
    $table_name = "faculty_p_details";
  }
  elseif($_SESSION['user_category'] == 'worker')
  {
    $target .= '/workers/';
    $table_name = "workers_p_details";
  }

  $d_id = $_SESSION['d_id'];

  # echo profile_pics_path;
  # echo $temp_path;

  # echo var_dump($username);

  $uploaded_file_name = time().$uploaded_file_name;

  $target = $target.$d_id.$username.$uploaded_file_name ;
  $target;


 if( ($uploaded_file_type == 'image/jpeg') || ($uploaded_file_type == 'image/png') || ($uploaded_file_type == 'image/gif') || ($uploaded_file_type == 'image/pjpeg')){
   if( $uploaded_file_size > 0 && $uploaded_file_size < 1048576) {
    if($uploaded_file_error == 0 && !$show_upload_form){

     $insert = " UPDATE $table_name SET photo = '$uploaded_file_name', last_updated_on = NOW(), last_updated_by = '$username' WHERE username = '$username' " ;

     if($conn->query($insert) === TRUE) {

       if(move_uploaded_file($_FILES['user_file']['tmp_name'] , $target)) {

        echo "<p class='alert alert-success'> File uploaded successfully </p>" ;
        echo "<a href='index.php'> Return to home page </a>";

       } else { echo "there's some error uploading your file";
            @unlink($_FILES['user_file']['tmp_name']);
            $show_upload_form = true ;
     }

   }  else { $error_in_uploading =  "there's some error in uploading the file" ;
            $show_upload_form = true;
    }

} else {  $error_in_uploading = "there's some error uploading your file";  }


} else { $error_in_uploading = "file must be under 1mb" ;
         $show_upload_form = true;
      }

} else {    $error_in_uploading = "only jpeg's, gif's are allowed to upload";
            $show_upload_form = true;
   }
} else { $show_upload_form = true ;}

if($show_upload_form){

  if($error_in_uploading)
  {
     ?>

  <div class="alert alert-danger">
   <strong> <?php echo "<p>" . $error_in_uploading . "</p>"; ?> </strong>
  </div>

  <?php
  }

?>


<div class="container">
<h4> You're logged in as <i> <?= $_SESSION['username'] ?> </i> </h4>

<form class="form-horizontal" method="post" enctype="multipart/form-data" action="">

  <div class="form-group">
    <label class="control-label col-xs-12 col-sm-4 col-md-4" for="user_file"> Select file to upload: </label>
    <div class="col-xs-12 col-sm-3 col-md-3">
      <input type="file" class="form-control" name="user_file" required="required" id="user_file">
    </div>
    <div class="col-sm-4"> <span class="error"> <?= $user_file_Err ?> </span> </div>
  </div>

   <div class="form-group">
     <div class="col-sm-offset-4 col-sm-8">
      <input type="submit" name="upload_content" value="Upload" class="btn btn-info" />
     </div>
   </div>

</div>

<?php
}
 ?>
