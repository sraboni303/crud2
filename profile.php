<?php require_once "app/autoload.php"; ?>

<?php 
/**
 * Dinamic Profile:
 */
if (isset($_GET['profile_id'])) {
  
  $profile_id = $_GET['profile_id'];

  $sql = "SELECT * FROM users WHERE id='$profile_id' ";
  $profile = $connection -> query($sql);

  $profile_data = $profile -> fetch_assoc();


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

    <title> <?php echo $_SESSION['name']; ?> </title>
    <style>
      img{
        width: 300px;
        height: 300px;
        border-radius: 50%;
        border: 10px solid #fff;
      }
    </style>
  </head>
  <body>
   <div class="container text-center mt-5">
     <a href="index.php" class="btn btn-success">Form</a>
     <a href="students.php" class="btn btn-success">Students</a>
   </div>  

<div class="container w-50 my-5">
  <div class="card shadow">
    <div class="card-body text-center">
      <img class="shadow" src="photos/<?php echo $profile_data['photo']; ?>">
      <h2 class="my-4"><?php echo $profile_data['name']; ?></h2>
      <table class="table">
        <tr>
          <th>Name</th>
          <td><?php echo $profile_data['name']; ?></td>
        </tr>

        <tr>
          <th>E-mail</th>
          <td><?php echo $profile_data['email']; ?></td>
        </tr>

        <tr>
          <th>Gender</th>
          <td><?php echo $profile_data['gender']; ?></td>
        </tr>

        <tr>
          <th>ID</th>
          <td><?php echo $profile_data['id']; ?></td>
        </tr>

        <tr>
          <th>Status</th>
          <td><?php echo $profile_data['status']; ?></td>
        </tr>
      </table>
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