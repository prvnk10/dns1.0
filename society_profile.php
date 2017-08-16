<?php

require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'society')
{
  require_once('require/redirect_user_to_profile_page.php');
}
else
{
  require_once('require/header.php');

  require_once('society/s_p_navigation.php');

  require_once('require/footer.php');
}


 ?>

 <script src='script/s_profile.js'></script>
