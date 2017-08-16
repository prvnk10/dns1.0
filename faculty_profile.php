<?php

require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');

if($_SESSION['user_category'] != 'faculty')
{
  require_once('require/redirect_user_to_profile_page.php');
}
else
{
  require_once('require/header.php');

  require_once('faculty/f_p_navigation.php');

  require_once('require/footer.php');
}

 ?>

 <script src='script/f_profile.js'></script>
