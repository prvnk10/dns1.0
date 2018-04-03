<?php

require_once('require/connection.php');

# require_once('require/prevent_invalid_access.php');

$_SESSION['user_category'] = 'director';
//$_SESSION['username'] = 'director';

/*
if($_SESSION['username'] == 'director')
{

}
*/

if($_SESSION['user_category'] != 'director')
{
  require_once('require/redirect_user_to_profile_page.php');
}
else
{
  require_once('require/header.php');

  require_once('administration/d_p_navigation.php');

  # require_once('require/get_user_info.php');

  # echo var_dump($_SESSION);

  # require_once('require/footer.php');
}


?>

 <script src='script/d_profile.js'></script>
