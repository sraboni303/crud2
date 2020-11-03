<?php require_once "app/autoload.php"; ?>

<?php

/**
 * Inactive a User
 */
if (isset($_GET['active_id'])) {
  
  $active_id = $_GET['active_id'];

  $sql = "UPDATE users SET status = 'inactive' WHERE id='$active_id' ";

  $connection -> query($sql);
  header("location: students.php");
}


/**
 * Active A User
 */
if (isset($_GET['inactive_id'])) {
  
  $inactive_id = $_GET['inactive_id'];

  $sql = "UPDATE users SET status='active' WHERE id='$inactive_id' ";
  $connection -> query($sql);

  header("location: students.php");
}



/**
 * Delete User
 */
if(isset($_GET['delete_id'])){

  $delete_id = $_GET['delete_id'];
  $delete_photo = $_GET['photo'];

  $sql = "DELETE * FROM users WHERE id='$delete_id' ";
  $connection -> query($sql);

  unlink('photos/'. $delete_photo);

  header("location:students.php");

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
    <style>
      img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
      }
    </style>
  </head>
  <body>
   <div class="container text-center mt-5">
     <a href="index.php" class="btn btn-success">Form</a>
     <a href="students.php" class="btn btn-success">Students</a>
   </div>
<div class="container my-5">
  
  <div class="card shadow">
    <div class="card-body">
      <h2>Students List</h2>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Gender</th>
            <th>ID</th>
            <th>Photo</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

<?php

  $i = 1;
  $sql = "SELECT * FROM users";
  $users = $connection -> query($sql);
  while($users_data = $users -> fetch_assoc()){

?>
          

          <tr>
            <td><?php echo $i; $i++; ?></td>
            <td><?php echo $users_data['name']; ?></td>
            <td><?php echo $users_data['email']; ?></td>
            <td><?php echo $users_data['gender']; ?></td>
            <td><?php echo $users_data['id']; ?></td>
            <td>

              <?php if( $users_data['status'] == 'active' ): ?>
                 <a href="?active_id=<?php echo $users_data['id']; ?>">
                   <img style="border: 5px solid green;" src="photos/<?php echo $users_data['photo']; ?>">
                 </a>
              <?php elseif( $users_data['status'] == 'inactive' ): ?>
                <a href="?inactive_id=<?php echo $users_data['id']; ?>">
                  <img style="border: 5px solid red;" src="photos/<?php echo $users_data['photo']; ?>">
                </a>
              <?php endif; ?>

             
            </td>
            <td>

              <a href="profile.php?profile_id=<?php echo $users_data['id']; ?>" class="btn btn-warning">View</a>
              <a href="edit.php?edit_id=<?php echo $users_data['id']; ?>" class="btn btn-info">Edit</a>
              <a id="delete_btn" href="?delete_id=<?php echo $users_data['id']; ?>&photo=<?php echo $users_data['photo']; ?> " class="btn btn-danger">Delete</a>

            </td>
          </tr>

<?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>  









    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
      $('a#delete_btn').click(function(){

        let con_msg = confirm('Are you sure ?');
        if (con_msg == true) {
          return true;
        }else{
          return false;
        }

      });
    </script>
  </body>
</html>