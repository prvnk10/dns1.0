<?php
require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'worker')
{
  require_once('require/redirect_user_to_profile_page.php');
}
else
{
  require_once('require/header.php');

  require_once('require/get_user_info.php');

  require_once('worker/w_p_navigation.php');

  require_once('require/footer.php');
}

?>

 <script src='script/w_profile.js'></script>
