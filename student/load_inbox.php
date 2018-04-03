<div id="content">
    <div id="inner_div">
<?php
// include the connection and other file
require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');

# echo var_dump($_SESSION);

$subsection_id = $_SESSION['subsection_id'];
$section_id = $_SESSION['section_id'];

$get_subsection_query = "SELECT subsection_id FROM subsections WHERE section_id = '$section_id' ";

# $query = "SELECT md.msg_id, md.msg, md.sent_on_date, fpd.name FROM messages_delivered as md INNER JOIN faculty_p_details AS fpd USING(f_id) WHERE msg_for_subsection_id = '$subsection_id' ORDER BY md.sent_on_date DESC ";
$query = "SELECT md.msg_id, md.msg, md.sent_on_date, fpd.name FROM messages_delivered as md INNER JOIN faculty_p_details AS fpd ON md.msg_by_f_id = fpd.f_id WHERE msg_for_subsection_id = ($get_subsection_query) ORDER BY md.sent_on_date DESC" ;

$q_processing = $conn->query($query);
# echo var_dump($q_processing);

if($q_processing->num_rows > 0)
{
  echo "<div class='col-sm-12'>";
  while($q_result = $q_processing->fetch_assoc())
  {
    echo "<div class='alert alert-info col-sm-8'> ";
    echo "<p>" . $q_result['msg'] . "</p>";
    echo "<p>" . $q_result['sent_on_date'] . "</p>";
    echo "<p> By " . $q_result['name'] . "</p>";
    echo "</div>";
  }
  echo "</div>";

}

else
{
  echo "<div class='alert alert-info col-sm-8'> There are no messages </div>";
}

?>

  </div>
</div>
