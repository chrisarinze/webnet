<?php
session_start();
	
//Redirecting the user to his profile page if he returns to the login page having logged-in already
	if(isset($_SESSION['id'])!=""){
	   header('location: member/user_profile.php');
	}
	if(!isset($_SESSION['reg_num'])) {
	   header('location: sign_up.php');
	}

?>


<!DOCTYPE html>
<html lang="en">

<!-- head -->
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
	<link rel="icon" href="img/webnet_logo.png" type="image/x-icon">
	<style>
	.bg {background-image: url("img/wnet_bg.png");}
	   .container{
          max-width: 400px;
		  height: auto;
          margin-left: auto;
          margin-right: auto;
		  margin-top: 100px;
          padding-left: 30px;
		  padding-right: 10px;
		  border: 5px solid #008080; }

	</style>
  </head>
 
<body style="background:#034354">
    <section class="container bg">
	     <h3 style="font-size:22px; color:#fff">Congratulations! You've have successfully been registered.</h3><br>
	  
		 <p style="font-size:15px">You can now login to your account.</p> 
		 <p>Click <a href="member/index.php">here</a> to login or <a href="index.php">here</a> to cancel login.<p>
	</section>

  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/webnet.min.js"></script>
 </body>
</html>