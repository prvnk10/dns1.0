<div id="content">

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
}

?>

</div>
