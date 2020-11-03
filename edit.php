<?php require_once "app/autoload.php"; ?>

<?php
if (isset($_GET['edit_id'])) {
  
  $edit_id = $_GET['edit_id'];

  $sql = "SELECT * FROM users WHERE id='$edit_id' ";
  $edit = $connection -> query($sql);
  $edit_data = $edit -> fetch_assoc();

}

?>


<?php
if(isset($_POST['update'])){
  
  // Get Values:
  $name = $_POST['name'];
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];

  if(isset($_POST['gender'])){

    $gender = $_POST['gender'];
  }
  if(isset($_POST['location'])){

    $location = $_POST['location'];
  }
 
  
  
  // Files Upload:
  $file_name = $_FILES['new_file']['name'];
  $file_tmp_name = $_FILES['new_file']['tmp_name'];

  $unique_new_file_name = md5( time() . rand() . $file_name ); 

 



  // Form Validation:
  if( empty($name) || empty($uname) || empty($email) || empty($password) || empty($gender) ){

    $notice = validation_notice('Fill the Required Fields !', 'danger');

  }else{

    $sql = "UPDATE users SET name='$name', uname='$uname', email='$email', mobile='$mobile', password='$password', gender='$gender', location='$location' photo='$unique_new_file_name' WHERE id='$edit_id' ";

    $connection -> query($sql);

    move_uploaded_file($file_tmp_name, 'photos/'. $unique_new_file_name);


    $notice = validation_notice('Data Updated !', 'success');
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
          <input type="text" class="form-control" name="name" value="<?php echo $edit_data['name']; ?>">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="uname" value="<?php echo $edit_data['uname']; ?>">
        </div>

        <div class="form-group">
          <label>E-mail</label>
          <input type="email" class="form-control" name="email" value="<?php echo $edit_data['email']; ?>">
        </div>

        <div class="form-group">
          <label>Mobile</label>
          <input type="text" class="form-control" name="mobile" value="<?php echo $edit_data['mobile']; ?>">
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
          <input <?php if( $edit_data['gender']== 'Male' ){echo 'checked';} ?> type="radio" name="gender" value="Male">
            <label>
              Male
            </label>
          <input <?php if( $edit_data['gender']== 'Female' ){echo 'checked';} ?> type="radio" name="gender" value="Female">
            <label>
              Female
            </label>
        </div>


        <div class="form-group">
          <label>Location</label>
          <select class="form-control" name="location">
            <option value="">-Select-</option>
            <option <?php if($edit_data['location'] == 'Dhaka'){echo 'selected';} ?> value="Dhaka">Dhaka</option>

            <option <?php if($edit_data['location'] == 'Chittagong'){echo 'selected';} ?> value="Chittagong">Chittagong</option>

            <option <?php if($edit_data['location'] == 'Barishal'){echo 'selected';} ?> value="Barishal">Barishal</option>

            <option <?php if($edit_data['location'] == 'Khulna'){echo 'selected';} ?> value="Khulna">Khulna</option>

            <option <?php if($edit_data['location'] == 'Mymensingh'){echo 'selected';} ?> value="Mymensingh">Mymensingh</option>

            <option <?php if($edit_data['location'] == 'Rajshahi'){echo 'selected';} ?> value="Rajshahi">Rajshahi</option>

            <option <?php if($edit_data['location'] == 'Rangpur'){echo 'selected';} ?> value="Rangpur">Rangpur</option>

            <option <?php if($edit_data['location'] == 'Sylhet'){echo 'selected';} ?> value="Sylhet">Sylhet</option>
          </select>
        </div>


        
        <div class="form-group">
          <img style="width: 150px;" src="photos/<?php echo $edit_data['photo']; ?>">
          <input <?php echo $edit_data['photo']; ?> type="hidden" class="form-control-file" name="old_file">
        </div>

        <div class="form-group">
          <input type="file" class="form-control-file" name="new_file">
        </div>

        <button type="submit" class="btn btn-primary" name="update">Update</button>
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