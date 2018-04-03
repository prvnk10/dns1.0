<div id="content">

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
require_once('require/connection.php');

$username = $_SESSION['username'];

show_software_feedback_form($conn);

function check_whether_feedback_already_submitted($conn, $username)
{
  // echo "pk";
  $query = "SELECT * FROM software_feedback WHERE username = '$username' ";
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

function show_software_feedback_form($conn)
{
  $username = $_SESSION['username'];
  $f_already_submitted = check_whether_feedback_already_submitted($conn, $username);

  if($f_already_submitted)
  {
    echo "<p class='alert alert-success'> You have already submitted your feedback. </p>";
  }
  else
  {

    $query = "SELECT q_id, q_statement FROM feedback_questions WHERE category='software'  ";
    $q_processing = $conn->query($query);

    if($q_processing->num_rows > 0)
    {

      echo "<p class='alert alert-info'> Submit your valuable feedback on the basis of the following parameters for the designing of further modules and improving our existing modules. </p>";
      echo "<p class='alert alert-info'> 1 -> Poor , 5 -> Excellent </p>";

      echo "<form action='' method='post' id='software_feedback_form'>";

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

      echo "</form>";
    }
    else
    {
      echo "<p class='alert alert-danger'> Currently no feedback related questions in the database. </p>";
    }


  }

}

?>

<script>
$('#software_feedback_form').on('submit', function(e){

   e.preventDefault();
   var main_div = $('#content');

   var details = $('#software_feedback_form').serialize();
   // console.log(details);

   var username = '<?php echo $username; ?>';
   // console.log(username);

   var all_data = 'username=' + username + '&' + details;
   console.log(all_data);

   var url = 'require/submit_software_feedback_details.php';

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


<!--
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var options = {
	animationEnabled: true,
	title: {
		text: ""
	},
	data: [{
		type: "doughnut",
		innerRadius: "40%",
		showInLegend: true,
		legendText: "{label}",
		indexLabel: "{label}: #percent%",
		dataPoints: [
			{ label: "Department Stores", y: 6492917 },
			{ label: "Discount Stores", y: 7380554 },
			{ label: "Stores for Men / Women", y: 1610846 },
			{ label: "Teenage Specialty Stores", y: 950875 },
			{ label: "All other outlets", y: 900000 }
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>
</html>

-->
