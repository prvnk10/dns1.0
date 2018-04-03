<?php
require_once('require/connection.php');
require_once('require/prevent_invalid_access.php');

$username = $_SESSION['username'];

if($_SESSION['user_category'] == 'student')
{
  $table = "students_a_details";
  $query = "SELECT t.p_id, t.section_id, t.current_sem, t.d_id, d.d_name, subsections.subsection_id from $table as t inner join departments as d using(d_id) inner join subsections using(section_id) WHERE username = '$username' ";

  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {
    while($q_results = $q_processing->fetch_assoc())
    {
       $_SESSION['p_id'] = $q_results['p_id'];
       $_SESSION['section_id'] = $q_results['section_id'];
       $_SESSION['subsection_id'] = $q_results['subsection_id'];
       $_SESSION['current_sem'] = $q_results['current_sem'];
       $_SESSION['d_id'] = $q_results['d_id'];
       $_SESSION['department'] = $q_results['d_name'];
    }
  } else { echo 4545;}
}

else if($_SESSION['user_category'] == 'faculty')
{
  $table = "faculty_pr_details";

  $query = "SELECT fpd.f_id, t.d_id, t.post_id, d.d_name from faculty_p_details as fpd inner join $table as t using(f_id) inner join departments as d using(d_id) WHERE username = '$username' ";

  $q_processing = $conn->query($query);

  if($q_processing->num_rows > 0)
  {
    while($q_results = $q_processing->fetch_assoc())
    {
       $_SESSION['f_id'] = $q_results['f_id'];
       $_SESSION['d_id'] = $q_results['d_id'];
       $_SESSION['department'] = $q_results['d_name'];
       $_SESSION['post_id'] = $q_results['post_id'];
    }
  }
  else
  {
    echo "";
  }

}


else if($_SESSION['user_category'] == 'worker')
{

  $table = "workers_p_details";

  # $query = "SELECT * FROM $table WHERE username = '$username'";
  $query = "SELECT wpd.w_id, wpd.username, wpd.name, wpd.post_id, wpd.d_id, d.d_name, p.post_id, p.post_designation from workers_p_details as wpd inner join departments as d using(d_id) inner join posts as p using(post_id) WHERE username = '$username' ";

  $q_processing = $conn->query($query);

  if ($q_processing->num_rows > 0)
  {
    while($q_results = $q_processing->fetch_assoc())
    {
       $_SESSION['worker_id'] = $q_results['w_id'];
       $_SESSION['worker_name'] = $q_results['name'];
       $_SESSION['d_id'] = $q_results['d_id'];
       $_SESSION['worker_post'] = $q_results['post_designation'];
       $_SESSION['worker_post_id'] = $q_results['post_id'];
       $_SESSION['worker_d_name'] = $q_results['d_name'];
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
