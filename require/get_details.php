<?php

// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
    //request is ajax

    require_once('connection.php');

    $username = $_GET['username'];

    $t = $_GET['type'];

    $table = $t."_p_details";

    $query = "SELECT * FROM $table WHERE username = '$username'";

    $q_processing = $conn->query($query);

    if($q_processing->num_rows > 0)
    {

      echo "<table class='table table-hover'>";
      while($row = $q_processing->fetch_assoc())
      {
         echo "<tr> <td> Name: </td> <td>" . $row['name'] . " </td> </tr> ";
         echo "<tr> <td> Mobile: </td> <td> " . $row['mobile'] . "</td> </tr>";
         echo "<tr> <td> Username: </td> <td>" . $row['username'] . "</td> </tr>";
         echo "<tr> <td> Email: </td> <td>" . $row['email'] . "</td> </tr>";
      }
    }


// }

 ?>
