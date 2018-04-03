<div id="content">
 <script src="script/roll_sheet.js" type="text/javascript"> </script>

<?php
require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'faculty')
{
  require_once('require/redirect_user_to_profile_page.php');
}

else
{
  require_once('faculty/list_of_courses.php');
  echo "<div id='roll_sheet' class='col-sm-12 col-md-12'></div>";
}

?>

</div>
