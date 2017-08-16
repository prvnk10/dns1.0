<?php

############################################################################################################
##   some constants are defined here which will be used to establish connection with database   ############
##   and some constants define the path used to store the uploaded files                        #############
############################################################################################################

define("servername", "localhost");
define("username", "root");
define("password", "");
define("db_name", "digital_nit");

/*
define("path" , "uploads/");
define("events_path", "uploads/events/");
define("academic", "administration/academic/");
define("study_m", "uploads/study_material/");
define("assignment", "uploads/assignments");
*/

// start the session
session_start();

// establish connection with the database
$conn = new mysqli(servername , username, password , db_name);

# if some error occured, then show error message
if($conn->connect_error){
  echo "Connection problem" or die("Couldn't establish a secure Connection");
}

?>
