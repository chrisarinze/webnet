<?php
//Require connection to the database and start session
	require_once ('../includes/connect.php');

//Storing the details of the logged in user in a variable to be displayed in this page as his profile
	if(isset($_SESSION['id'], $_SESSION['names'], $_SESSION['username'], $_SESSION['email'], $_SESSION['phonenumber'], $_SESSION['city'], $_SESSION['country'], $_SESSION['gender'], $_SESSION['bio'], $_SESSION['reg_num'], $_SESSION['reg_date'])) {
	
		$user_real_names = 			$_SESSION['names'];
		$user_name = 				$_SESSION['username'];
		$user_email = 				$_SESSION['email'];
		$user_phonenumber = 		$_SESSION['phonenumber'];
		$user_city = 				$_SESSION['city'];
		$user_country = 			$_SESSION['country'];
		$user_gender = 				$_SESSION['gender'];
		$user_bio = 				$_SESSION['bio'];
		$user_reg_num = 			$_SESSION['reg_num'];
		$user_reg_date = 			$_SESSION['reg_date'];
	}
	if(isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Webnets is an educationally rich website on the concept of Computer, and contains relational interesting infos on other relevant subjects of life.">
	<meta name="keywords" content="">
    <meta name="author" content="Chris Arinze">
	
    <title>User Profile Page</title>
	
    <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' 
	type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="css/webnet.min.css" rel="stylesheet">
	<link href="css/plugin_css/animate.css" rel="stylesheet">
	<link rel="icon" href="img/wn_logo.png" type="image/x-icon">
  </head>

  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	 <div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/wn_logo.png" style="width:65px" alt="Webnet"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
		  aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			  <li class="nav-item"><a class="nav-link" href="#">Quiz app</a></li>
			  <li class="nav-item dropdown">
			  <a class="nav-link" class="dropbtn" href="#" >Tutorials <i class="fa fa-caret-down"></i></a>
				  <div class="dropdown-content">
						<a href="#">S. Networking</a>
						<a href="#">W. Designing</a>
				  </div>
			  </li>
			  <li class="nav-item"><a class="nav-link" href="user_profile.php" >My Profile</a></li>
			  <li class="nav-item"><a class="nav-link" href="../includes/logout.php" >Log out</a></li>
		</ul>
		</div>
	  </div>
	</nav>
	
	<section id="services">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
		  <div class="container" style="background:#fff">
            <form action="#" method="post">
			  <h4 style="padding:20px 0;color:#034354">User Profile</h4>
			    <div class="row">
			      <div class="col-md-6">
			        <div class="form-group">
					<label class="label" for="names">Name:</label>
						<input type="text" class="form-control" name="names" id="names" value="<?php if(isset($_SESSION['names'])) { echo $user_real_names; }  ?>" disabled>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<label class="label" for="username">Username:</label>
						<input type="text" class="form-control" name="username" id="username" value="<?php if(isset($_SESSION['username'])) { echo $user_name; }  ?>" disabled>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label class="label" for="email">Email:</label>
						<input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['email'])) { echo $user_email; }  ?>" disabled>
					</div>
				  </div>
				  <div class="col-md-6">
				    <div class="form-group">
					<label class="label" for="phone">Phone number:</label>
						<input type="text" class="form-control" name="phone_number" id="phone" value="<?php if(isset($_SESSION['phonenumber'])) { echo $user_phonenumber; }  ?>" disabled>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label class="label" for="psw">Password:</label>
						<input type="text" class="form-control" name="password" id="psw" style="font-style:italic" value="you know your password" disabled>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<label class="label" for="city">City:</label>
						<input type="text" class="form-control" name="city" id="city" value="<?php if(isset($_SESSION['city'])) { echo $user_city; }  ?>" disabled>
					</div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					<label class="label" for="country">Country:</label>
						<input type="text" class="form-control" name="country" id="country" value="<?php if(isset($_SESSION['country'])) { echo $user_country; }  ?>" disabled>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
						<label class="label" for="gender">Gender:</label>
							<input type="text" class="form-control" name="gender" id="gender" value="<?php if(isset($_SESSION['gender'])) { echo $user_gender; }  ?>" disabled>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="label" for="reg_num">User ID:</label>
							<input type="text" class="form-control" name="reg_num" id="reg_num" value="<?php if(isset($_SESSION['reg_num'])) { echo $user_reg_num; }  ?>" disabled>
					</div>
				  </div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="label" for="reg_date">Date Registered:</label>
							<input type="text" class="form-control" name="reg_date" id="reg_date" value="<?php if(isset($_SESSION['reg_date'])) { echo $user_reg_date; }  ?>" disabled>
					</div>
				  </div>
				</div>
			</form>	<br><br>   
        </div>
		</div>
		
		<div class="col-md-4 text-center" >
            <div class="container" style="background:#fff">
              <h3 style="padding:40px 0"><img src="img/user.png" width="100px"></h3>
			  <h4 style="color:#034354;"><?php if(isset($_SESSION['username'])) {echo $user_name;} ?><p class="text-muted" style="margin-bottom:20px; margin-top:0"><?php if(isset($_SESSION['email'])) {echo $user_email;}  ?></p></h4>
			  <p><?php if(isset($_SESSION['bio'])) {echo $user_bio;}  ?></p>
              <br>
            </div>
          </div>
        </div>
      </div>
    </section>
	
	<footer>
	  <div class="container-fluid">
	     <div class="row">
          <div class="col-md-12">
		    <div class="wow shake" data-wow-delay="1.0s">
              <a class="btn rounded-circle border border-secondary js-scroll-trigger circle footer" href="#page-top">
			  <i class="fa fa-lg fa-angle-double-up animated"></i></a>
            </div>
            <p class="footer">
			&copy; <?php echo date("Y"); ?> Webnets.com.ng | Proudly Powered by <a class="ln" href="../index.php">Webnets</a>
			</p>
		  </div>
	     </div>
	  </div>
	</footer>
	  
    <!--core js files-->
    <script src="js/jquery/jquery.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<!--<script src="js/plugins/popper.min.js"></script>-->
	
	<!--plugins & custom js files-->
    <script src="js/plugins/jquery.easing.min.js"></script>
	<script src="js/plugins/wow.min.js"></script>
    <script src="js/webnet.min.js"></script>

  </body>
</html>
<?php 
	
	}else{
		header('location: index.php');
	}
?>