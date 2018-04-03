<div id="content">

<?php
# include the connection file
require_once('require/connection.php');

// checks if the user's logged in or not and redirect user to login.php is user's not logged
require_once('require/prevent_invalid_access.php');

// if user category other than student, then show a message and redirect user to correct profile page
if($_SESSION['user_category'] != 'student')
{
  echo "<div class='alert alert-danger'> You don't have the permission to access this page. You will be redirected to your profile page in 5 seconds. </div>";
  header("Refresh: 5; url=index.php" );
}

echo "<p class='alert alert-info alert-dismissible'>";
echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
echo "data till the last semester results";
echo "</p>";

// grab the rollno from session variable
$rollno = $_SESSION['username'];

// query the database for the pointers
$query = "SELECT * FROM pointers WHERE username = '$rollno'  ";
$query_result = $conn->query($query);

// create an array that will store the pointers
$all_pointers = array();
# echo var_dump($all_pointers);
# echo $query_result->num_rows;

// if query was successful, then grab the fetched values and store it in the array
if($query_result->num_rows == 1){
  $result_values = $query_result->fetch_assoc();

  $sem1 = $result_values['1'];
  $sem2 = $result_values['2'];
  $sem3 = $result_values['3'];
  $sem4 = $result_values['4'];
  $sem5 = $result_values['5'];
  $sem6 = $result_values['6'];
  $sem7 = $result_values['7'];
  $sem8 = $result_values['8'];
#  echo $sem1;
  $all_pointers = array($sem1, $sem2, $sem3, $sem4, $sem5, $sem6, $sem7, $sem8);
#  echo var_dump($all_pointers);

}

# echo "<div class='container'>";

echo "<h4 class='text-center'> Progress Report </h4>";
echo "<b>Roll No. " . $rollno . " </b> <br/> <br/> ";

// get the current sem of the user from session variable
$cur_sem = $_SESSION['current_sem'];


// iterate over that array and show values only for those sems(whose values are less than the current sem)
for($i=0, $length = count($all_pointers) ; $i < $cur_sem-1 ; $i++){

echo "<p>";
echo ($i + 1 ) . " semester" ;
echo '<div class="progress">';
echo '<div class="progress-bar progress-bar-success progress-vertical" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="10" style="width: ' . $all_pointers[$i]*10 . '% " >';
echo '<span>' . $all_pointers[$i] . '</span>' ;
echo '</div>';
echo '</div>';
echo '<br/>';

}

echo "</div>";
?>

</div>
