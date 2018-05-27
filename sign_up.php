<?php
//Require connection to the database and start session
	require_once ('includes/connect.php');
	
//Redirecting the user to his profile page if he returns to the login page having logged-in already
	if(isset($_SESSION['id'])!=""){
	   header('location: member/user_profile.php');
	}
	
//Storing the user reg_info into a variable after all the fields are set
  if (isset($_POST['submit'])) {
		if (isset($_POST['names'], $_POST['username'], $_POST['email'], $_POST['phonenumber'], $_POST['password'], $_POST['password_again'], $_POST['city'], $_POST['country'], $_POST['gender'], $_POST['bio'])) {

	//storing the user inputs in a variable after removing white spaces, slashes, tags and escaping html characters
		 $names =          		htmlentities(stripslashes(strip_tags(trim($_POST['names']))));
		 $username =       		htmlentities(stripslashes(strip_tags(trim($_POST['username']))));
		 $email = 				trim($_POST['email']);
	// Remove all illegal characters from email
		 $email = filter_var($email, FILTER_SANITIZE_EMAIL);
		 $phonenumber = 		htmlentities(stripslashes(strip_tags(trim($_POST['phonenumber']))));
		 $password = 			htmlentities(stripslashes(strip_tags(trim($_POST['password']))));
		 $password_again = 		htmlentities(stripslashes(strip_tags(trim($_POST['password_again']))));
		 $city = 				htmlentities(stripslashes(strip_tags(trim($_POST['city']))));
		 $country = 			htmlentities(stripslashes(strip_tags(trim($_POST['country']))));
		 $gender = 				$_POST['gender'];
		 $bio = 				htmlentities(stripslashes(strip_tags(trim($_POST['bio']))));
	//Escaping string character
		 $names_esc = 				mysqli_real_escape_string($conn, $names);
		 $username_esc = 			mysqli_real_escape_string($conn, $username);
		 $email_esc = 				mysqli_real_escape_string($conn, $email);
		 $phonenumber_esc = 		mysqli_real_escape_string($conn, $phonenumber);
		 $password_esc = 			mysqli_real_escape_string($conn, $password);
		 $password_again_esc = 		mysqli_real_escape_string($conn, $password_again);
		 $city_esc = 				mysqli_real_escape_string($conn, $city);
		 $country_esc = 			mysqli_real_escape_string($conn, $country);
		 $bio_esc = 				mysqli_real_escape_string($conn, $bio);
	//Securing the user_password with md5 hash
		 $password_hash =  md5($password_esc);
		 
	//Making sure the user doesn't exceed the maxlength of fields
		  if(strlen($names_esc)>50 || strlen($username_esc)>30 || strlen($email_esc)>40 || strlen($phonenumber_esc)>17 || 
		  strlen($city_esc)>30 || strlen($country_esc)>30 || strlen($bio_esc)>100 ) {
			  $error = '<h5 style="color:red">Please adhere to maxlength of fields.</h5>';
			} else {
				//Making sure the user_bio is not below 20 characters
				   if(strlen($bio_esc)<20) {
					$error = '<h5 style="color:red">Your Bio should be 20 characters or more</h5>';
				} else {
				//Making sure the user_password is not below 6 characters
				  if(strlen($password_esc)<6) {
					$error = '<h5 style="color:red">Password must be atleast 6 characters or more.</h5>';
				  } else {
					//Checking for password match
					  if($password_esc!=$password_again_esc) {
						  $error = '<h5 style="color:red">Password did not match.</h5>';
						} else {
						//Validate e-mail
							   if(filter_var($email_esc, FILTER_VALIDATE_EMAIL) === false) {
								$error = '<h5 style="color:red">Oops, <em>$email_esc</em> is not a valid email address</h5>';
							} else {
								//checking if there is an already existing email	
								$query_run = mysqli_query($conn, "SELECT * FROM wn_members WHERE email='$email_esc'");
								$row = mysqli_num_rows($query_run);
								if($row==1) {
									$error = '<h5 style="color:red">Sorry, the email <em>'.$email.'</em> already exists in our database.</h5>';
								  } else {
									//checking if there is an already existing phonenumber	
										$query_run = mysqli_query($conn, "SELECT * FROM wn_members WHERE phone_number='$phonenumber_esc'");
										$row = mysqli_num_rows($query_run);
										if($row==1) {
										   $error = '<h5 style="color:red">Sorry, the phone_number <em>'.$phonenumber_esc.'</em> already exists in our database.</h5>';
										} else {
										//checking if there is an already existing username	
											$query_run = mysqli_query($conn, "SELECT * FROM wn_members WHERE username='$username_esc'");
											$row = mysqli_num_rows($query_run);
											if($row==1) {
											   $error = '<h5 style="color:red">Sorry, the username <em>'.$username_esc.'</em> already exists in our database.</h5>';
											} else {
									//Generating Registration Number for Members.
									$alpasC= array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
											$static = 'WN';
											$no1= rand(100,999);
											$no2= rand(100,999);
											$alp = $alpasC[rand(0,25)];
									//Storing the randomly generated numbers with the static data in a variable
											$mainnum = $static.'/'.$no1.$no2.$alp;
											$reg_number= $mainnum;
										
									//Querying the Database in order to insert new information
								$db_sql = "INSERT INTO `wn_members` (`names`,`username`,`email`,`phone_number`,`password`,`city`, `country`, `gender`,`bio`,`reg_num`,`date_registered`) 
								VALUES('$names_esc','$username_esc','$email_esc','$phonenumber_esc','$password_hash','$city_esc','$country_esc','$gender','$bio_esc','$reg_number', NOW())";
													
								//Running the Query	extracted
								$db_Query = mysqli_query($conn,$db_sql);
																	
								//Confirming the query run =======================================================================================
								if(!$db_Query){
											$error = '<h5 style="color:red">Registration was unsuccessful. Try again later...</h5>';
											} else{
												  $_SESSION['reg_num']=$reg_number;
											      header('Location: reg_success.php');
									        }
										} 
								}
							}
						}
					}
				}
			}
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
	
    <title>Registration Page</title>
	
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
  
  <div id="follow">
  <h4 class="terms" style="text-align:center">Our Terms & Conditions.</h4>
  <p>Dear User, this is to let you know that this website is an educative forum and therefore is open for all.</p>
  <p>Our audiences and members interest was put in place first in creating this forum, and so beware and cautious, be you who you are. Feel free to surf your way through in this site. Only do not trespass the User's boundary, nor try anything illegal.</p>
  <p>You are hereby allowed to share or copy our Posts and Blogs. And for fellow developers, you can make use of any of our ideas and innovations used in this site. We promise to maintain our purpose, that is, keeping your best interest at heart, whilst serving you here, by providing you with quality services. We will keep on making this Site as easy as for you to navigate your way through.</p>
  <p>Please don't hesitate to contact us if you have any problem or feedback for us. It's important as it helps us improve so we could serve you here the more better.</p>
  <p>You are Welcome!!!</p>
  
  <input type="button" id="btn" value="Continue">
  </div>
  
    <section class="bg-primary">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-7 mx-auto text-center" style="background:#fff;padding:20px">
			<form action="#" method="post">
			  <h4 style="padding:20px 0;color:#034354"><b>New User Registration</b><hr></h4>
			  <?php if(isset($error)) { echo $error; } ?>
			    <div class="row">
			      <div class="col-md-6">
			        <div class="form-group">
					<label class="label" for="names">Enter Your Names: <span class="star">*</span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="names" id="names" placeholder="Lastname first" maxlength="50" value="<?php if (isset
						($names_esc)) {echo $names_esc;} ?>" required></div>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<label class="label" for="username">Username: <span class="star">*</span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username" maxlength="30" value="<?php if (isset($username_esc)) {echo $username_esc;} ?>" required></div>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label class="label" for="email">Email: <span class="star">*</span> <span id="feedback"></span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
						<input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email" maxlength="40" value="<?php if (isset($email_esc)) {echo $email_esc;} ?>" required></div>
					</div>
				  </div>
				  <div class="col-md-6">
				    <div class="form-group">
					<label class="label" for="phone">Phone number: <span class="star">*</span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
						<input type="text" class="form-control" name="phonenumber" id="phone" placeholder="Enter Your Phone number" value="<?php if (isset($phonenumber_esc)) {echo $phonenumber_esc;} ?>" maxlength="17" 
						required></div>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label class="label" for="psw">Password: <span class="star">*</span> <span id="psw_span"></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-key"></i></span> 
						<input type="password" class="form-control" name="password" id="psw" placeholder="Enter Your Password" required></div>
						
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					<label class="label" for="psw_again">Password: <span class="star">*</span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input type="password" class="form-control" name="password_again" id="psw_again" placeholder="Confirm Your Password" required></div>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label class="label" for="city">City: <span class="star">*</span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
						<input type="text" class="form-control" name="city" id="city" placeholder="Enter Your Current City Location" maxlength="40" value="<?php if (isset($city_esc)) {echo $city_esc;} ?>" required></div>
					</div>
				  </div>
				<div class="col-md-6">
				  <div class="form-group">
					<label class="label" for="country">Country: <span class="star">*</span></label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
						<input type="text" class="form-control" name="country" id="country" placeholder="Enter Your Country" maxlength="40" value="<?php if (isset($country_esc)) {echo $country_esc;} ?>" required></div>
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				  <div class="form-group">
					<label class="label" for="gender">Gender: <span class="star">*</span></label>
					<select name="gender" id="gender" class="form-control" required>
						<option value=""><--Select your Gender --></option>
						<option value="Male"> Male </option>
						<option value="Female" > Female</option> 							
						<option value="Other" > Other </option> 
					</select>
				  </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="bio" class="label">Bio: <span class="star">*</span> <span id="bio_span"></label>
						  <textarea name="bio" id="bio" class="form-control no_resize" rows="7" cols="25" placeholder="Enter A Brief Description of yourself" maxlength="100" required><?php if (isset($bio_esc)) {echo $bio_esc;} ?></textarea>
					</div>
				</div>
				</div>
				<p class="float-left">By signing up, you agree to the <a class="email" id="terms" href="#">Terms & Conditions<a/> of this website.</p>
					<div class="clearfix" style="margin-top:30px;">
					<button type="submit" class="btn btn-outline-info float-right" id="submit" name="submit">
					  <i class="fa fa-arrow-right"></i> Submit </button>
					<button type="reset" class="btn btn-outline-info float-right"  name="reset">
					  <i class="fa fa-refresh"></i> Reset </button>
                   </div>
			</form>	 
				   <div class="clearfix" style="padding:20px 0">
				     <p class="float-left"><i class="fa fa-arrow-left"></i> <a class="email" href="member">Back to Login</a></p>
				   </div>
				   <p class="float-left"><a class="email" href="index.php">Cancel</a></p>
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
	<script src="js/new.js"></script>
	
  </body>
</html>