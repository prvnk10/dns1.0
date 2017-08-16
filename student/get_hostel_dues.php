<div id="content">

<?php
// include the connection and other file
# require_once('connection.php');

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'student')
{
  require_once('redirect_user_to_profile_page.php');
}
echo "Hostel Name: Indivar Bhawan";

?>

</div>
