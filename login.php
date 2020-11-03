<?php require_once "app/autoload.php"; ?>

<?php

/**
 * Login Form isseting:
 */
if (isset($_POST['login'])) {
	
	// Get Values:
	$log_user = $_POST['log-user'];
	$log_pass = $_POST['log-pass'];


	// Empty Value Check:
	if (empty($log_user) || empty($log_pass)) {
		
		$notice = validation_notice('Fill the required fields !', 'warning');
	}else{

		$sql = "SELECT * FROM users WHERE email='$log_user' OR uname='$log_user' ";
		$log_data = $connection -> query($sql);

		$log_count = $log_data -> num_rows;

		$log_all_data = $log_data -> fetch_assoc();

		if ($log_count == 1) {


			if ( password_verify($log_pass, $log_all_data['password']) ) {


				$_SESSION['id'] = $log_all_data['id'];
				$_SESSION['name'] = $log_all_data['name'];
				$_SESSION['uname'] = $log_all_data['uname'];
				$_SESSION['email'] = $log_all_data['email'];
				$_SESSION['mobile'] = $log_all_data['mobile'];
				$_SESSION['gender'] = $log_all_data['gender'];
				$_SESSION['photo'] = $log_all_data['photo'];

				header("location: user_profile.php");
				
			}else{

				$notice = validation_notice('Wrong Password !', 'danger');

			}



		}else{

			$notice = validation_notice('No E-mail or Username found !', 'danger');
		}
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
  

<div class="container w-50 my-5">
  <div class="card shadow px-5 py-3">
    <div class="card-body">
      <h2 class="text-center mb-4">Login Here</h2>

      <?php include "templates/notice.php"; ?>

      <form action="" method="POST">

        <div class="form-group">
          <label>E-mail/Username</label>
          <input type="text" class="form-control" name="log-user">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="log-pass">
        </div>


        <button type="submit" class="btn btn-primary" name="login">Login</button>

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