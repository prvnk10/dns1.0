<?php

$query = "SELECT s_topic_id, s_topic_name FROM suggestion_topics ORDER BY s_topic_id";
$q_processing = $conn->query($query);

if($q_processing->num_rows > 0)
{

?>

  <!--   <div class='container'>

 <form action='require/submit_suggestion.php' method='post' id='suggestion_form'>  -->

  <!--   <div class='form-group col-sm-6 col-md-8'>
      <label class='col-md-6' for='topic_id'> Select Topic: </label> -->
      <select class='form-control col-sm-4 col-md-4' id='topic_id' name='topic_id'>
        <option value=""></option>

<?php

      while($row = $q_processing->fetch_assoc())
      {
       echo "<option value = '" . $row['s_topic_id'] . "'> " . $row['s_topic_name'] . "</option>";
      }

?>

    </select>
<!--  </div>  -->

<!--
   <div class="form-group col-md-6">
    <button type="submit" class="btn btn-default" id="submit_suggestion"> Submit </button>
   </div>
 -->

 </form>

</div>

<?php
}

else
{
  echo "There are no suggestion topics";
}

?>
