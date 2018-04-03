<div id="content">

<?php
// include the connection and other file
require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');


// check this
// may be applicable for api endpoints

if(!isset($_GET['username']))
{

if($_SESSION['user_category'] != 'student')
{
  require_once('redirect_user_to_profile_page.php');
}
  $username = $_SESSION['username'];
}

else
{
  $username = $_GET['username'];
}

# echo var_dump($_SESSION);
# echo "Hostel Name: Indivar Bhawan";


# $query = "SELECT shd.hostel_id, shd.room_no, shd.block, shd.mess_dues, shd.last_updated_on, h.hostel_name, h.no_of_blocks, h.no_of_rooms_per_block, h.empty_rooms, h.account_no, wpd.name, wpd.mmca2_name, fpd.name FROM students_h_details AS shd INNER JOIN hostels as h using(hostel_id) INNER JOIN workers_p_details as wpd using(w_id) inner join faculty_p_details as fpd using(warden)  WHERE hostel_id = (SELECT hostel_id FROM student_h_details WHERE username = '" + $_SESSION['username'] + "')";

$query = "SELECT shd.hostel_id, shd.hosteller, shd.room_no, shd.block, shd.mess_dues, shd.last_updated_on, h.hostel_name, h.no_of_blocks, h.no_of_rooms_per_block, h.empty_rooms, h.account_no FROM students_h_details AS shd INNER JOIN hostel_details as h using(hostel_id) WHERE username = '$username'";

# echo $query;

$q_processing = $conn->query($query);

# echo var_dump($q_result);

# echo $q_processing->num_rows ;

if($q_processing->num_rows > 0)
{
  echo "<div class='col-sm-12'>";
  while($q_result = $q_processing->fetch_assoc())
  {
    if($q_result['hosteller'] == 'Y')
    {


    $room_no = $q_result['block'] . '-' . $q_result['room_no'];
    $total_no_of_rooms = $q_result['no_of_blocks']*$q_result['no_of_rooms_per_block'];


    echo "<p class='alert alert-info col-sm-6'> <b> Hostel Name:  </b> " . $q_result['hostel_name'] . "</p>";
    echo "<p class='alert alert-warning col-sm-6'> <b> Room No.  </b> " . $room_no . "</p>";
    echo "<p class='alert alert-info col-sm-12 '> <b> Hostel Account No:  </b> " . $q_result['account_no'] . "</p>";
    echo "<p class='alert alert-info col-sm-6'> <b> Total Rooms  </b> " . $total_no_of_rooms . "</p>";
    echo "<p class='alert alert-warning col-sm-6'> <b> Empty Rooms  </b> " . $q_result['empty_rooms'] . "</p>";
    echo "<p class='alert alert-info col-sm-3'> <b> Mess dues  </b> " . $q_result['mess_dues'] . "</p>";
    echo "<p class='alert alert-warning col-sm-9'> <b> Mess dues last updated on  </b> " . $q_result['last_updated_on'] . "</p>";

    }

    else
    {
      echo "<p class='alert alert-warning col-sm-9'> <b> Day Scholar  </b> </p>";
    }

  }

}

?>

</div>
