<?php
$query = "SELECT d_id, d_name FROM departments";

$q_processing = $conn->query($query);

if($q_processing->num_rows > 0)
{

 echo "<select class='form-control col-sm-4 col-md-4' name='department_id' id='department_id'>";
 echo "<option></option>";
 while($q_result = $q_processing->fetch_assoc())
 {
   echo "<option  value='" . $q_result['d_id'] . "' id='" . $q_result['d_id'] . "'>" . $q_result['d_name'] . "</option>";
 }

 echo "</select>";

}

?>
