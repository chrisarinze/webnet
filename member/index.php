<?php
//Require connection to the database and start session
	require_once ('../includes/connect.php');
	
//Redirecting the user to his profile page if he returns to the login page having logged-in already
	if(isset($_SESSION['id'])!=""){
	   header('location: user_profile.php');
	}
//Storing the user input in a variable
 if (isset($_POST['submit'])) {
 
    if (isset($_POST['email']) && isset($_POST['password'])) {
//Removing whitespaces, slashes, tags & escaping html characters
		$email = 		htmlentities(stripslashes(strip_tags(trim($_POST['email']))));
		$password = 	htmlentities(stripslashes(strip_tags($_POST['password'])));
//Escaping strings
		$email = 			mysqli_real_escape_string($conn, $email);
		$password = 		mysqli_real_escape_string($conn, $password);
//Hashing the password
		$password_hash =    md5($password);
		
//Checking if user exits in the database & querying the database
		$result = mysqli_query($conn, "SELECT * FROM wn_members WHERE email ='$email' || phone_number ='$email' || username ='$email'");
//Fetching the data in the database
		$row_fetch = mysqli_fetch_array($result);
//Checking if the password the user typed-in equals the one stored in the database		
    if ($row_fetch['password']==$password_hash) {
//If it does, store the fetched data in a session to be used in the user's profile page
		$_SESSION['id'] =					$row_fetch['id'];
		$_SESSION['names'] =				$row_fetch['names'];
		$_SESSION['username'] =				strtolower($row_fetch['username']);
		$_SESSION['email'] = 				$row_fetch['email']; 
		$_SESSION['phonenumber'] = 			$row_fetch['phone_number']; 
		$_SESSION['city'] = 				$row_fetch['city'];
		$_SESSION['country'] = 				$row_fetch['country']; 
		$_SESSION['gender'] = 				$row_fetch['gender'];
		$_SESSION['bio'] = 					$row_fetch['bio'];
		$_SESSION['reg_num'] = 				$row_fetch['reg_num'];
		$_SESSION['reg_date'] =				$row_fetch['date_registered'];
//And redirect the user to his profile page
		header('Location: user_profile.php');  
	 } else {
//Else, if it doesn't, display an error message
	    $error = '<h6 style="color:red">Incorrect login details, pls try again</h6>';
	 }
  }
}

//Close connection	
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Webnet is an educationally rich website on the concept of Computer, and contains relational interesting infos on other relevant subjects of life.">
	<meta name="keywords" content="">
    <meta name="author" content="Chris Arinze">
	
    <title>Login Page</title>
	
    <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' 
	type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="css/webnet.min.css" rel="stylesheet">
	<link href="css/plugin_css/animate.css" rel="stylesheet">
	<link rel="icon" href="img/wn_logo.png" type="image/x-icon">
  </head>

  <body>
     <section class="bg-primary">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 mx-auto text-center" style="background:#fff;padding:20px">
			<form action="" method="post">
			  <h2 style="padding:40px 0;"><img src="img/user.png" width="100px"></h2>
			  <?php echo @$error; ?>
				<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
						<input type="text" class="form-control" name="email" placeholder="Email or Phone number or Username" value="<?php if (isset($email)) {echo $email;} ?>" required></div>
					</div><br>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input type="password" class="form-control" name="password" placeholder="Password" required></div>
					</div>
					<div class="clearfix">
                      <button type="submit" class="btn btn-outline-info float-right" id="login" name="submit">
					  <i class="fa fa-unlock"></i> Login </button>
                   </div>
			</form>	   
				   <div class="clearfix" style="padding:20px 0">
				   <p class="float-left">Forget <a class="email" href="password_reset.php">password?</a></p>
				   <p class="float-right">New? <a class="email" href="../sign_up.php">Create account</a></p></div>
				   
				   <div class="clearfix">
				   <p class="float-left"><a class="email" href="../index.php">Exit Login</a></p></div>
        </div>
      </div>
	  </div>
	</section>
   
    <!--core js files-->
    <script src="js/jquery/jquery.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/plugins/popper.min.js"></script>
	
	<!--plugins & custom js files-->
    <script src="js/plugins/jquery.easing.min.js"></script>
	<script src="js/plugins/wow.min.js"></script>
    <script src="js/webnet.min.js"></script>
   
  </body>
</html>