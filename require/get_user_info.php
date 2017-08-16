<?php
require_once('require/connection.php');

require_once('require/prevent_invalid_access.php');

$username = $_SESSION['username'];

if($_SESSION['user_category'] == 'student')
{
  $table = "student_a_details";
  $query = "SELECT t.programme, t.section, t.current_sem, t.d_id, d.d_name from $table as t inner join department as d using(d_id) WHERE username = '$username' ";

  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {
    while($q_results = $q_processing->fetch_assoc())
    {
       $_SESSION['programme_id'] = $q_results['programme'];
       $_SESSION['section'] = $q_results['section'];
       $_SESSION['current_sem'] = $q_results['current_sem'];
       $_SESSION['department_id'] = $q_results['d_id'];
       $_SESSION['department'] = $q_results['d_name'];
    }
  }
}

else if($_SESSION['user_category'] == 'faculty')
{
  $table = "faculty_pr_details";

  $query = "SELECT fd.f_id, t.d_id, t.s_id, d.d_name from faculty_p_details as fd inner join $table as t using(f_id) inner join department as d using(d_id) WHERE username = '$username' ";

  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {
    while($q_results = $q_processing->fetch_assoc())
    {
       $_SESSION['f_id'] = $q_results['f_id'];
       $_SESSION['department_id'] = $q_results['d_id'];
       $_SESSION['department'] = $q_results['d_name'];
    }
  }
  else
  {
    echo "pk";
  }

}


else if($_SESSION['user_category'] == 'worker')
{
  $table = "workers_p_details";

  $query = "SELECT * FROM $table WHERE username = '$username'";

  $q_processing = $conn->query($query);

  if ($q_processing->num_rows > 0)
  {
    while($q_results = $q_processing->fetch_assoc())
    {
       $_SESSION['worker_id'] = $q_results['w_id'];
       $_SESSION['worker_name'] = $q_results['name'];
       $_SESSION['worker_post'] = $q_results['post'];
    }
  }

}

/*
else
{
  echo $conn->error;
}
*/

 ?>
