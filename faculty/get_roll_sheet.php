<script src="script/roll_sheet.js"></script>

<?php

// function get_roll_sheet($con, )

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{
  require_once('../require/connection.php');

  $course_code = $_POST['course_code'];
  $f_username = $_SESSION['username'];
  $f_id = $_SESSION['f_id'];

  $subsection_query = "SELECT subsection_id FROM course_faculty WHERE course_code = '$course_code' AND f_id = '$f_id'";
  $section_query = "SELECT section_id FROM subsections WHERE subsection_id = ($subsection_query)";

  $query = "SELECT sad.username, spd.name, s.section_id, s.section FROM students_a_details as sad inner join students_p_details as spd using(username) inner join sections as s using(section_id) WHERE section_id = ($section_query) ";


  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {
    echo "<div class='table-responsive'>";
     echo "<table class='table table-hover'>";

     echo "<thead>";
     echo "<tr>";
     echo "<th> Roll No. </th> <th> Name </th> <th> Section </th>";
     echo "</tr>";
     echo "</thead>";

    while($q_results = $q_processing->fetch_assoc())
    {
      echo "<tr>";
      echo "<td> <a class='user_roll_no' href='require/get_details.php?username=" . $q_results['username'] . "'>" . $q_results['username'] . "</a> </td>";
      echo "<td>" . $q_results['name'] . "</td>";
      echo "<td>" . $q_results['section'] . "</td>";
      echo "</tr>";
    }

      echo "</table>";
     echo "</div>";
  }

}

?>
