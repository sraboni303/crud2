<?php require_once "app/autoload.php"; ?>
<?php 


if(isset($_POST['submit'])){
  
  // Get Values:
  $name = $_POST['name'];
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if(isset($_POST['gender'])){

    $gender = $_POST['gender'];
  }
  if(isset($_POST['location'])){

    $location = $_POST['location'];
  }


  $terms = 'disagree';
  if (isset($_POST['terms'])) {
    
    $terms = $_POST['terms'];
  }

  // Files Upload:
  $file_name = $_FILES['file']['name'];
  $file_tmp_name = $_FILES['file']['tmp_name'];

  $unique_file_name = md5( time() . rand() . $file_name );



  // Hash Password:
  $hash_pass = password_hash($password, PASSWORD_DEFAULT);


  // E-mail Check:
  $email_check = val_check('users', 'email', $email);


  // Username Check:
  $uname_check = val_check('users', 'uname', $uname);


  // Mobile Check:
  $mobile_check = val_check('users', 'mobile', $mobile);



 

 



  // Form Validation:
  if( empty($name) || empty($uname) || empty($email) || empty($password) || empty($gender) ){

    $notice = validation_notice('Fill the Required Fields !', 'danger');

  }elseif( $terms == 'disagree' ){

    $notice = validation_notice('You should agree !', 'warning');

  }elseif( $password != $cpassword ){

    $notice = validation_notice('Password not matched !', 'danger');

  }elseif($uname_check > 0){

    $notice = validation_notice('Username Already exists !', 'warning');

  }elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ){

    $notice = validation_notice('Invalid E-mail Address !', 'danger');

  }elseif($email_check > 0){

    $notice = validation_notice('E-mail Already exists !', 'warning');

  }elseif($mobile_check > 0){

    $notice = validation_notice('Mobile number Already exists', 'warning');

  }else{

    $sql = "INSERT INTO users (name, uname, email, mobile, password, gender, location, photo) VALUES ('$name', '$uname', '$email', '$mobile', '$hash_pass', '$gender', 'location', '$unique_file_name') ";

    $connection -> query($sql);

    move_uploaded_file($file_tmp_name, 'photos/'. $unique_file_name);


    header("location: login.php");
  }









}
?>








<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Registration</title>
  </head>
  <body>
   <div class="container text-center mt-5">
     <a href="index.php" class="btn btn-success">Form</a>
     <a href="students.php" class="btn btn-success">Students</a>
   </div>  

<div class="container w-50 my-5">
  <div class="card shadow">
    <div class="card-body">
      <h2>Register Now</h2>

      <?php include "templates/notice.php"; ?>

      <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="uname">
        </div>

        <div class="form-group">
          <label>E-mail</label>
          <input type="text" class="form-control" name="email">
        </div>

        <div class="form-group">
          <label>Mobile</label>
          <input type="text" class="form-control" name="mobile">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" name="cpassword">
        </div>

        <div class="form-group">
          <label>Gender</label> <br>
          <input type="radio" name="gender" value="Male">
            <label>
              Male
            </label>
          <input type="radio" name="gender" value="Female">
            <label>
              Female
            </label>
        </div>

       <div class="form-group">
          <label>Location</label>
          <select class="form-control" name="location">
            <option value="">-Select-</option>
            <option value="Dhaka">Dhaka</option>

            <option value="Chittagong">Chittagong</option>

            <option value="Barishal">Barishal</option>

            <option>Khulna</option>

            <option value="Mymensingh">Mymensingh</option>

            <option value="Rajshahi">Rajshahi</option>

            <option value="Rangpur">Rangpur</option>

            <option value="Sylhet">Sylhet</option>
          </select>
        </div>

        <div class="form-group">
          <input type="file" class="form-control-file" name="file">
        </div>

        <div class="form-group">
          <input type="checkbox" name="terms">
          <label>Yes, I agree</label>
        </div>



        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>

    </div>
  </div>
</div>  









    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>