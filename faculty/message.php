<div id="content">
  <div id="outer_div">
  <script src="script/message.js"></script>

<?php
require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');

$f_id = $_SESSION['f_id'];
$f_d_id = $_SESSION['d_id'];

$show_form = false;
$msg_send = $msg_send_failed = '';
$receivers = array();


if(isset($_POST['send_msg'])){
  extract($_POST);

  $message = $message;

   if(empty($message)){
     $show_form = true;
     $msg_send_failed = "You can't send an empty message";
   }

   # echo strlen($message);

  $receivers = $receivers;
  if(empty($receivers)){
    $show_form = true;
    $msg_send_failed = "Please select the receiver(s)";
  }

  # find the total no of receivers(semester wise) who will receive the message
  $length = count($receivers);
  # echo $length;
  # var_dump($receivers);

  if(!$show_form){
  for($i=0 ; $i < $length ; $i++){
    $query = "SELECT rollno FROM students WHERE branch = '$faculty_department' AND semester = '$receivers[$i]'";
    # echo $query;

    $query_processing = $conn->query($query);

    while($query_results = $query_processing->fetch_assoc()){
     $rollno = $query_results['rollno'];

     $insert_query = "INSERT INTO messages_send VALUES('' , '$faculty_id' , '$rollno' , '$message', CURDATE(), CURTIME())";
     # echo $insert_query;

     $insert_query_processing = $conn->query($insert_query);
    # echo (bool)$insert_query_processing;

     if($insert_query_processing){

       $insert_query_2 = "INSERT INTO messages_received VALUES('', LAST_INSERT_ID() , '$rollno', '$message', '0', CURDATE(), CURTIME())";
       $insert_query_2_processing = $conn->query($insert_query_2);
       #  echo (bool)$insert_query_2_processing;
       if($insert_query_2_processing)
         $msg_send = "Message send successfully to " . $rollno ;

       else{
         $delete_query = "DELETE FROM messages_send WHERE msg_id = LAST_INSERT_ID()";
         $delete_query_processing = $conn->query($delete_query);

         if(!$delete_query_processing)
          $msg_send_failed = "Message can't be send to " . $rollno . "due to a technical problem. <p> We're sorry for inconvienence </p>";
       }

        #  echo $insert_query_2;
      }
     }
  }

}
}
else
{
 $show_form = true;
}

if($show_form){

 if($msg_send != '')
   echo '<div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $msg_send . '</div>' ;

 if($msg_send_failed != '')
   echo '<div class="alert alert-danger alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> × </a>' . $msg_send_failed . '</div>' ;
?>

 <!-- <div class="panel panel-default"> -->

<div id="inner_div"></div>
<form action="" class="form-horizontal" method="post" id="send_message">

  <div class="alert alert-info form-group col-sm-8"> Enter your message in the box below </div>

  <div class="form-group">
  <textarea rows="15" cols="90" name='message' id="message"></textarea>
  </div>

<!--   <div class="checkbox">  -->
  <div class="form-group">
  Send To:

  <?php

  # grab course_code and semester using faculty id, semester will be used as value of checkbox to send msg to students
#  $query = "SELECT cf.course_code, cf.subsection_id, c.semester, ss.section_id FROM course_faculty as cf INNER JOIN courses as c USING(course_code) INNER JOIN subsections as ss ON ss.subsection_id = cf.subsection_id WHERE f_id = '$f_id'";
  $query = "SELECT cf.course_code, cf.subsection_id, c.semester, ss.section_id, s.section FROM course_faculty as cf INNER JOIN courses as c USING(course_code) INNER JOIN subsections as ss ON ss.subsection_id = cf.subsection_id INNER JOIN sections as s using(section_id) WHERE f_id = '$f_id'";
  $q_processing = $conn->query($query);

  /*
  $semesters = array();
  while($q_data = $q_processing->fetch_assoc()){
   array_push($semesters, $q_data['semester']);
  }


   for($i=0, $n=count($semesters); $i<$n; $i++){
    echo "<input type='checkbox' name='receivers[]' value='" . $semesters[$i] . "'> ";
    echo $semesters[$i] . " semester  ";
   }
   */

   if($q_processing->num_rows > 0)
   {
     while($q_data = $q_processing->fetch_assoc())
     {
       echo "<input type='checkbox' name='receivers[]' id='receivers' value='" . $q_data['subsection_id'] . "'> ";
       echo $q_data['semester'] . " semester  " . $q_data['course_code'] . ' ' . $q_data['section'];
       echo "<br/>";
       # if($q_data['subsection_id'])
     }
   }
   else
   {
     echo 234234;
   }


  ?>

   </div>

   <div class="form-group">
     <div>
     <button type="submit" id="send_msg" name="send_msg" class="btn btn-info"> Send </button>
     </div>
   </div>

 </form>

 <?php
 }
  ?>



</div>

</div>
