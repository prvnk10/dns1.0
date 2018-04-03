<script src="script/subjects.js" type="text/javascript"> </script>

<link rel="stylesheet" href="rating/dist/themes/bars-square.css">
<script src="rating/jquery.barrating.js" type="text/javascript"> </script>

<script type="text/javascript">
   $(function() {
      $('.f_feedback').barrating({
        theme: 'bars-square',
        showSelectedRating: false,
        showValues: true
      });
   });
</script>

<?php

require_once('../require/connection.php');

function get_study_material($conn, $course_code, $f_id)
{
  $query = "SELECT s_m_id, s_m_name, s_m_link FROM study_material WHERE course_code='$course_code' AND uploaded_by_f_id = '$f_id' ";
  $q_result = $conn->query($query);

  if($q_result->num_rows > 0)
  {
    echo "<div id='subject_study_material' class='container'>";
    while($q_result = $q_processing->fetch_assoc())
    {
      echo "Its working";
    }
  }

  else
  {
    echo "<p class='alert alert-danger'> No material uploaded by the faculty. </p>";
  }
}

function check_whether_feedback_already_submitted($conn, $username, $f_id, $course_code)
{
  // echo "pk";
  $query = "SELECT * FROM faculty_feedback WHERE username = '$username' AND f_id = '$f_id' AND course_code = '$course_code'  ";
  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {
    return true;
  }
  else
  {
    return false;
  }
}

/*

check the path of the following files

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'student')
{
  require_once('require/redirect_user_to_profile_page.php');
}
*/

if( !isset($_GET['course_code']) || strlen($_GET['course_code']) == 0 )
{
  exit();
}
else
{
  $course_code =  $_GET['course_code'];
  // echo $_SESSION['section'];

  $user_subsection = $_SESSION['subsection_id'];
  # $query = "SELECT credit, subject_info FROM courses WHERE course_code = '$course_code'";

  $query = "SELECT cf.f_id, fpd.name, fpd.email, c.subject_name, c.credit, c.subject_info FROM course_faculty AS cf INNER JOIN faculty_p_details AS fpd USING (f_id) INNER JOIN courses AS c USING(course_code) WHERE course_code='$course_code' AND subsection_id = '$user_subsection' ";

  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {

    echo "<div id='g_subject_info' class='alert alert-info col-sm-12'>";
    while($q_result = $q_processing->fetch_assoc())
    {
      # echo $q_result['f_id'];
      $f_id = $q_result['f_id'];
      $username = $_SESSION['username'];
      # echo $course_code;
      echo "<p class='alert alert-warning'> <b> Faculty Name: </b> " . $q_result['name'] . "</p>";
      echo "<p class='alert alert-warning'> <b> Faculty Email: </b> " . $q_result['email'] . "</p>";
      // echo "<p> Subject Name: " . $q_result['subject_name'] . "</p>";
      echo "<p type='hidden' id='f_id' name='f_id' value='" . $q_result['f_id'] . "'> </p>";
      echo "<p class='alert alert-warning course_code'> <b> Course Code: </b> " . $course_code . "</p>";
      echo "<p class='alert alert-warning'> <b> Course Credit: </b> " . $q_result['credit'] . "</p>";
      echo "<p class='alert alert-warning'> <b> Subject Info. </b> " . $q_result['subject_info'] . "</p>";

      echo "<p class='col-md-6 col-sm-4'> <button type='button' class='btn btn-default get_study_material' data-toggle='modal' data-target='#myModal'> Study Material </button> </p>";
      echo "<p class='col-md-6 col-sm-4'> <button class='btn btn-default' data-toggle='modal' data-target='#faculty_feedback'> Feedback </button> </p>";

      $study_material_url = 'get_study_material.php' . '?course_code=' . $course_code . '&f_id=' . $f_id;

    }
    echo "</div>";
  }

}

?>

 <!-- Trigger the modal with a button -->

<!-- Faculty Feedback Modal -->
<div id="faculty_feedback" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Faculty Feedback for the course <?php echo $course_code; ?> </h4>
      </div>

      <div class="modal-body" id="f_feedback_modal_body">
        <form action="" method="post" id="faculty_feedback_form">

        <?php echo show_faculty_feedback_form($conn, $course_code, $f_id); ?>

      </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
  <script src="script/subjects.js" type="text/javascript"> </script>

  <script>
  $('#faculty_feedback_form').on('submit', function(e){

     e.preventDefault();
     var main_div = $('#f_feedback_modal_body');

     var details = $('#faculty_feedback_form').serialize();
     // console.log(details);

     var course_code = '<?php echo $course_code; ?>';
     // console.log(course_code);

     var f_id = '<?php echo $f_id; ?>';
     // console.log(f_id);

     var username = '<?php echo $username; ?>';
     // console.log(username);

     var all_data = 'username=' + username + '&f_id=' + f_id + '&course_code=' + course_code + '&' + details;
     console.log(all_data);

     var url = 'student/submit_feedback_details.php';

     $.ajax({
        type: "POST",
        url: url,
        timeout: 3000,
        data: all_data,

        beforeSend: function(){
          main_div.after('<div id="loading"> Getting the subject details </div>');
          // $('#subject_info').html('');
        },

        complete: function(){
          $('#loading').remove();
        },

        success: function(data){
          main_div.html(data);
        },

        failure: function(){
          main_div.append('<div id="failure" class="alert alert-danger"> Sorry, we are unable to get the content right now. Please try again after some time </div>');
        }

     });


  });
  </script>

</div>

<!-- Study Material Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Study material for <?php echo $course_code; ?> </h4>
      </div>

      <div class="modal-body" id="study_material_content">
        <?php echo get_study_material($conn, $course_code, $f_id); ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>


<?php

function show_faculty_feedback_form($conn, $course_code, $f_id)
{
  $username = $_SESSION['username'];
  $f_already_submitted = check_whether_feedback_already_submitted($conn, $username, $f_id, $course_code);

  if($f_already_submitted)
  {
    echo "<p class='alert alert-info'> You have already submitted feedback for this course and faculty. </p>";
  }
  else
  {

    echo "<p class='alert alert-info'> Submit feedback for the faculty member based on following parameters </p>";
    echo "<p class='alert alert-info'> 1 -> Poor , 5 -> Excellent </p>";

    $query = "SELECT q_id, q_statement FROM feedback_questions WHERE category='faculty'  ";
    $q_processing = $conn->query($query);

    if($q_processing->num_rows > 0)
    {

      while($q_result = $q_processing->fetch_assoc())
      {
        echo "<div class='form-group col-sm-12'>";

        echo "<div class='form-group col-sm-4'>" . $q_result['q_statement'] . "</div>";

        echo "<select class='form-control f_feedback col-sm-8' id='' name='q_id_" . $q_result['q_id'] . "'>";

        echo " <option value='1'> 1 </option> ";
        echo " <option value='2'> 2 </option> ";
        echo " <option value='3'> 3 </option> ";
        echo " <option value='4'> 4 </option> ";
        echo " <option value='5'> 5 </option> ";

        echo "</select>";

        echo "</div>";
      }

      echo "<div class='form-group'>";
       echo "<input type='submit' class='btn btn-info' value='Submit Feedback'>";
      echo "</div>";
    }
  }
}

?>
