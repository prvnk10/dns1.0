<div id="content">

<?php
# echo 4545;
session_start();
$_SESSION[] = array();

session_unset();
session_destroy();

header("Location: index.php");

 ?>

 </div>
