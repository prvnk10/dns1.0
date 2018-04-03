<?php

// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
    //request is ajax

    require_once('connection.php');

if(isset($_GET['username'], $_GET['type']))
{

    $username = $_GET['username'];
    $t = $_GET['type'];

    $table1 = $t."_p_details";
    $photo_path = profile_pics_path;

    if($t == 'students')
    {
      $table2 = "students_a_details";
      $photo_path .= '/students/';
      $query = "SELECT t1.username, t1.name, t1.email, t1.mobile, t1.b_group, t1.photo, t2.d_id, t2.p_id, t2.mentor_f_id, t2.placement_status, d.d_name, p.p_name, p.batch FROM $table1 as t1 INNER JOIN $table2 as t2 using(username) INNER JOIN departments AS d USING(d_id) INNER JOIN programmes_offered AS p USING(p_id) WHERE username = '$username'";
    }

    else if($t == 'faculty')
    {
      $table2 = "faculty_pr_details";
      $photo_path .= '/faculty/';
      $query = "SELECT t1.f_id, t1.username, t1.name, t1.email, t1.mobile, t1.b_group, t1.photo, t2.d_id, t2.post_id, t2.specialisation, d.d_name, p.post_designation FROM $table1 as t1 INNER JOIN $table2 as t2 using(f_id) INNER JOIN departments AS d USING(d_id) INNER JOIN posts as p USING(post_id) WHERE username = '$username'";
    }

    $q_processing = $conn->query($query);

    if($q_processing->num_rows > 0)
    {

      echo "<table class='table table-hover'>";
      while($row = $q_processing->fetch_assoc())
      {
         # echo $row['photo'];

         if($t == 'students')
         {
           # echo $row['d_id'];
           $d_id = $row['d_id'];
           $username = $row['username'];
           $photo = $row['photo'];

           if($photo != '')
           {
             $photo_path = $photo_path.$d_id.$username.$photo;

             echo "<img src='" . $photo_path . "' height='150' width='200' class='rounded'/>";
           }

           echo "<tr> <td class='alert alert-info'> Name: </td> <td class='alert alert-warning'>" . $row['name'] . " </td> </tr> ";
           echo "<tr> <td class='alert alert-info'> Username: </td> <td class='alert alert-warning'>" . $row['username'] . "</td> </tr>";
           echo "<tr> <td class='alert alert-info'> Programme: </td> <td class='alert alert-warning'>" . $row['p_name'] . "</td> </tr>";
           echo "<tr> <td class='alert alert-info'> Batch: </td> <td class='alert alert-warning'>" . $row['batch'] . "</td> </tr>";

         if($_SESSION['username'] = 'director')
         {
           if($row['placement_status'] == 'Y')
           {
             echo "<tr> <td class='alert alert-info'> Placement Status: </td> <td class='alert alert-warning'> Placed </td> </tr>";
           }
           else
           {
             echo "<tr> <td class='alert alert-info'> Batch: </td> <td class='alert alert-warning'> Unplaced </td> </tr>";
           }
         }

           echo "<tr> <td class='alert alert-info'> Department: </td> <td class='alert alert-warning'>" . $row['d_name'] . "</td> </tr>";
           echo "<tr> <td class='alert alert-info'> Mobile: </td> <td class='alert alert-warning'> " . $row['mobile'] . "</td> </tr>";
           echo "<tr> <td class='alert alert-info'> Email: </td> <td class='alert alert-warning'>" . $row['email'] . "</td> </tr>";
           echo "<tr> <td class='alert alert-info'> Blood Group: </td> <td class='alert alert-warning'>" . $row['b_group'] . "</td> </tr>";
         }

         else if($t == 'faculty')
         {
           $d_id = $row['d_id'];
           $username = $row['username'];
           $photo = $row['photo'];

           if($photo != '')
           {
             $photo_path = $photo_path.$d_id.$username.$photo;
             echo "<img src='" . $photo_path . "' height='150' width='200' class='rounded'/>";
           }

           echo "<tr> <td> Name: </td> <td>" . $row['name'] . " </td> </tr> ";
           echo "<tr> <td> Designation: </td> <td>" . $row['post_designation'] . " </td> </tr> ";
           echo "<tr> <td> Username: </td> <td>" . $row['username'] . "</td> </tr>";
           echo "<tr> <td> Department: </td> <td>" . $row['d_name'] . "</td> </tr>";
           echo "<tr> <td> Mobile: </td> <td> " . $row['mobile'] . "</td> </tr>";
           echo "<tr> <td> Email: </td> <td>" . $row['email'] . "</td> </tr>";
           echo "<tr> <td> Blood Group: </td> <td>" . $row['b_group'] . "</td> </tr>";
         }
      }
    }

}

else if(isset($_GET['username']))
{
  $username = $_GET['username'];

  $table1 = "students_p_details";
  $photo_path = profile_pics_path;

  $table2 = "students_a_details";
  $photo_path .= '/students/';
  $query = "SELECT t1.username, t1.name, t1.email, t1.mobile, t1.b_group, t1.photo, t2.d_id, t2.p_id, t2.mentor_f_id, t2.placement_status, d.d_name, p.p_name, p.batch FROM $table1 as t1 INNER JOIN $table2 as t2 using(username) INNER JOIN departments AS d USING(d_id) INNER JOIN programmes_offered AS p USING(p_id) WHERE username = '$username'";


  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {

    echo "<table class='table table-hover'>";
    while($row = $q_processing->fetch_assoc())
    {

         $d_id = $row['d_id'];
         $username = $row['username'];
         $photo = $row['photo'];

         if($photo != '')
         {
            $photo_path = "../".$photo_path.$d_id.$username.$photo;
           echo "<img src='" . $photo_path . "' height='150' width='200' class='rounded'/>";
         }

         echo "<tr> <td class='alert alert-info'> Name: </td> <td class='alert alert-warning'>" . $row['name'] . " </td> </tr> ";
         echo "<tr> <td class='alert alert-info'> Username: </td> <td class='alert alert-warning'>" . $row['username'] . "</td> </tr>";
         echo "<tr> <td class='alert alert-info'> Programme: </td> <td class='alert alert-warning'>" . $row['p_name'] . "</td> </tr>";
         echo "<tr> <td class='alert alert-info'> Batch: </td> <td class='alert alert-warning'>" . $row['batch'] . "</td> </tr>";

       if($_SESSION['username'] = 'director')
       {
         if($row['placement_status'] == 'Y')
         {
           echo "<tr> <td class='alert alert-info'> Placement Status: </td> <td class='alert alert-warning'> Placed </td> </tr>";
         }
         else
         {
           echo "<tr> <td class='alert alert-info'> Placement Status: </td> <td class='alert alert-warning'> Unplaced </td> </tr>";
         }
       }

         echo "<tr> <td class='alert alert-info'> Department: </td> <td class='alert alert-warning'>" . $row['d_name'] . "</td> </tr>";
         echo "<tr> <td class='alert alert-info'> Mobile: </td> <td class='alert alert-warning'> " . $row['mobile'] . "</td> </tr>";
         echo "<tr> <td class='alert alert-info'> Email: </td> <td class='alert alert-warning'>" . $row['email'] . "</td> </tr>";
         echo "<tr> <td class='alert alert-info'> Blood Group: </td> <td class='alert alert-warning'>" . $row['b_group'] . "</td> </tr>";

}

}

}

 ?>
