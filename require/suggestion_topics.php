<div id="content">
   <div id="inner_div">

<?php

require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');

$query = "SELECT topic_id, topic_name FROM suggestion_topics";

$q_processing = $conn->query($query);

if($q_processing->num_rows > 0)
{
    echo "<div class='row'>";

    echo "<form action='require/submit_suggestion.php' method='post' id='suggestion_form'>";

    echo "<div class='form-group col-sm-4 col-md-4'>";
    echo "<label class='col-md-6' for='topic_id'> Select Topic: </label>";

    echo "<select class='form-control col-md-4' id='topic_id' name='topic_id'>";

    while($row = $q_processing->fetch_assoc())
    {
       echo "<option value = '" . $row['topic_id'] . "'> " . $row['topic_name'] . "</option>";
    }

    echo "</select>";
    echo "</div>";

?>

</div>

<div class="row">
<div class="form-group col-md-6">
  <label for="suggestion_msg"> Message: </label>
  <textarea class="form-control" rows="5" id="suggestion_msg" name="suggestion_msg"></textarea>
</div>
</div>

<div class="row">
<button type="submit" class="btn btn-default" id="submit_suggestion"> Submit </button>
</div>


</form>

<?php

 }

?>

  </div>
</div>
