<?php
$query = "SELECT p_id, p_name, batch FROM programmes_offered";

$q_processing = $conn->query($query);

if($q_processing->num_rows > 0)
{

 echo "<select class='form-control col-sm-3' name='programme_id' id='programme_id'>";
 echo "<option></option>";
 while($q_result = $q_processing->fetch_assoc())
 {
   echo "<option value='" . $q_result['p_id'] . "' class='form-control' id='" . $q_result['p_id'] . "'>" . $q_result['p_name'] . " " .  $q_result['batch']  . " batch </option>";
 }

  echo "</select>";

}

?>
