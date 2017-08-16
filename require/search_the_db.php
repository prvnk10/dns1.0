<div id="content">

<?php
require_once('connection.php');

if( isset($_GET['query'], $_GET['type']) && $_GET['query'] != '')
{

  $q = $_GET['query'];

  $t = $_GET['type'];

  $t .= "_p_details";

# echo $t;

$parameter = $q.'%';

$sql_query = "SELECT username, name FROM $t WHERE name like '$parameter'";
# echo $sql_query;

$s_query_processing = $conn->query($sql_query);

# echo var_dump($s_query_processing);
if($s_query_processing->num_rows > 0)
{
   echo "<table class='table table-hover'>";
   while($row = $s_query_processing->fetch_assoc())
   {
     echo "<tr> <td> <a class='search_results' id='" . $row['username'] . "' href='require/get_details.php?username=" . $row['username'] . "'> " . $row['name'] . " </a>";
     echo "<input type='hidden'> </td> </tr>";
     echo '<br />';
   }

}
else {
 echo 'No match found';
}

}

?>

<!-- Modal -->
<div id="myModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_search_modal" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> User's Info. </h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close_search_modal" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script src="script/search_the_db.js"></script>

</div>
