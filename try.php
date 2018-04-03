<?php
require_once('require/start_session.php');


require_once("require/functions.php");
 render("header" , ["title" => "Sign Up | Notes"]);

require_once('require/connection.php');

# initialising different variables needed in the script
$show_form = false;
$nameErr = $emailErr = $passwordErr = $confirm_PasswordErr = $user_PictureErr = '' ;

# check if the form is submitted or not
if($_SERVER["REQUEST_METHOD"] == "POST") {

 if(isset($_POST['submit'])){
/*
    firstly we extract the $_POST
     then we test the variables
     then it is checked whether the field is empty or not, if yes show corresponding error message
     value of password and confirm_Password fields are matched
     if everything is fine then we use connection.php
     get properties of uploaded file
     check specifications of uploaded file
      if file specifications are within constraints, then we query the database using value of enterd email in WHERE clause
      if 0 rows are affected, it means email is unique
      insert values into db and move uploaded file
*/
 extract($_POST);

if(empty($name)){
  $nameErr = "Please fill out name";
  $show_form = true;
}
 else {
   $name = test_input($name);
     if(!preg_match("/^[a-zA-Z ]*$/" ,$name)){                      # make sure only alphabets are allowed in name
       $nameErr = "Only letters and white spaces are allowed";
       $show_form = true;
    }
}

if(empty($email)){
   $emailErr = "Please fill out email";
   $show_form = true;
}
 else {
    $email = test_input($email);
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $emailErr = "Invalid email format";
      $show_form = true;
  }
}

if(empty($password)){
  $passwordErr = "Please fill out this field" ;
  $show_form = true;
}

if(empty($confirm_Password)){
  $confirm_PasswordErr = "Please fill out this field" ;
  $show_form = true;
}

if( $password !== $confirm_Password){
     $passwordErr = "Passwords do not match" ;
     $confirm_PasswordErr = "Passwords do not match";
     $show_form = true;
}

if( (!empty($name)) && (!empty($email)) && (!empty($password)) && (!empty($confirm_Password)) && ($password === $confirm_Password) && (!$show_form) ){

  $type = $_FILES['user_Picture']['type'];
  $size = $_FILES['user_Picture']['size'];
  $pic_name = $_FILES['user_Picture']['name'];
  $target = PATH . $pic_name ;

  if(  ($size > 0) && ($size < 5242880) ) {                # max. size is set to be 5 mb
   if( ($type == 'image/jpeg') || ($type == 'image/png') || ($type == 'image/gif') || ($type == 'image/pjpeg') ){

     $query = "SELECT * FROM users WHERE email = '$email' ";
     $result = $conn->query($query);

 if($result->num_rows == 0){                     # make sure that entered email is not registered already
    $password = sha1($password);
    $a_code = substr(md5(uniqid(rand(), true)) , 10, 15);    # generate activation code
    $time = time();
#    $hash = md5($email . $time . "pk");

  $insert = "INSERT INTO users(name, email, password, join_date, profile_pic,activation_code) VALUES ('$name', '$email', '$password', NOW() , '$pic_name', '$a_code' )" ;

if(move_uploaded_file($_FILES['user_Picture']['tmp_name'] , $target) ){
  if($conn->query($insert) === TRUE){

   echo "Signed up successfully. You can now <a href='login.php'> login </a> to your account";
   echo "You need to activate your account to get access to all features. We have send you an email, please click on the link in the email to activate your account";
   echo '<a href="activate_account.php?email=' . $email . '&a_code=' . $a_code . '&t='.$time.'"> Activate your account </a> ';
  # echo '<a href="activate_account.php?$hash=" . $hash . '"> Activate </a> ';

  } else { @unlink($_FILES['user_Picture']['tmp_name']); echo "some error connecting to the database" ;  }

 }   else { echo "there was some error uploading your profile pic"; }


}   else { $emailErr =  "Entered email is already registered";
           $show_form = true;
     }

  }   else { $user_PictureErr =  'only images are allowed' ;
             $show_form = true;
           }

}   else { $user_PictureErr =  "images under 5mb are allowed";
           $show_form = true;
         }
    }
  }                   # this brace closes the if block which gets executed if the form is submitted
}

# if the form is not submitted, do this
else
 $show_form = true ;

if( $show_form ){
 ?>

<div id="content-wrapper">

<fieldset>
 <legend> Sign Up </legend>
 <form method="post" enctype="multipart/form-data">
    <table class="signup_table">
      <tr>
       <td> <label for="name"> Name: </label> </td>
       <td>
        <input type="text" name="name" value="<?php if(!empty($name)) echo $name; ?>" onblur="validateNonEmpty(this , document.getElementById('nameErr'))" required="required" />
        <span id="nameErr" class="error"> <?= $nameErr ?> </span>
       </td>
      </tr>
      <tr>
       <td> <label for="email"> Email: </label> </td>
       <td>
       <input type="email" name="email" id="email" value="<?php if(!empty($email)) echo $email; ?>" required="required" />
       <span id="emailErr" class="error"> <?= $emailErr ?> </span>
       </td>
      </tr>
      <tr>
       <td> <label for="password"> Password: </label> </td>
       <td>
        <input type="password" id="password" name="password" onblur="validateNonEmpty(this , document.getElementById('passwordErr'))"  required="required" />
        <span id="passwordErr" class="error"> <?= $passwordErr ?> </span>
       </td>
      </tr>
      <tr>
       <td> <label for="confirm_password"> Confirm Password: </label> </td>
       <td>
       <input type="password" id="confirm_password" name="confirm_Password" onblur="validateNonEmpty(this , document.getElementById('confirm_PasswordErr') ) " required="required" />
       <span id="confirm_PasswordErr" class="error"> <?= $confirm_PasswordErr ?> </span>
       </td>
      </tr>
      <tr>
       <td> <label for="user_picture"> Profile Picture: </label> </td>
       <td> <input type="file" name="user_Picture" required="required">
       <span id="user_PictureErr" class="error"> <?= $user_PictureErr ?> </span>
       </td>
      </tr>

      <tr>
       <td> <input type="submit" name="submit" value="Sign Up" id="signup_btn" /> </td>
      </tr>
  </table>
</form>
</fieldset>

<?php
}

render("footer");

 ?>

 <script src="signup.js"> </script>
  <script src="jquery.js"> </script>
  <script src="validateNonEmpty.js"> </script>
