# $url = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];

/*
$show_form = false;

$upload_successful = $upload_failed = '' ;

if(isset($_POST['upload_notes'])){
   extract($_POST);
   # echo var_dump($_FILES);
   # echo var_dump($_POST);


   if(empty($_FILES['notes']['size'])){
     $show_form = true;
   }

   if(!$show_form){
    # $notes = $notes;
    # echo $notes;

    $file_size = $_FILES['notes']['size'];
    # echo $file_size;

    $file_type = $_FILES['notes']['type'];
    $file_name = $_FILES['notes']['name'];
    $file_error = $_FILES['notes']['error'];
    $course_code = $_GET['course_code'];

    $target = study_m . $_FILES['notes']['name'];
    # echo $target;

    if($file_type = 'application/pdf' || $file_type = 'application/ppt' || $file_type = 'application/txt' || $file_type = 'application/docx'){
     if($file_size > 0 && $file_size < 5242880){
      if($file_error == 0){
       if(move_uploaded_file($_FILES['notes']['tmp_name'] , $target)){
          $insert_query = "INSERT INTO study_material VALUES('', '$faculty_id' , '$course_code', '$file_name' )";

            if($conn->query($insert_query) === TRUE)
               $upload_successful = "File uploaded successfully";
            else
                $upload_failed = "There was an error uploading the file";

         }   else { $upload_failed = "error in uploading your file"; $show_form = true; @unlink($_FILES['notes']['tmp_name']); }
       }   else { $upload_failed = "error in uploading your file"; $show_form = true; }
      } else { echo "size of file must be under 5mb";}
    } else { echo "Please select a file in pdf, ppt, txt or docx format" ; }
  }
} else { $show_form = true;}  */
