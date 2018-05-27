<?php

//STORING THE USER'S INPUTS IN VARIABLES***
if (isset($_POST['contact_name']) && isset($_POST['contact_email']) && isset($_POST['contact_subject']) && isset($_POST['contact_body']) )  {
		$contact_name = $_POST['contact_name'];
		$email = $_POST['contact_email'];
		$contact_subject = $_POST['contact_subject'];
		$contact_body = $_POST['contact_body'];
		
//REMOVING ALL ILLEGAL CHARACTERS FROM EMAIL
		$contact_email = filter_var($email, FILTER_SANITIZE_EMAIL);

//ENSURING THAT THE USER DOESN'T EXCEED THE MAXLENGTH OF FIELDS
			if(strlen($contact_name)>40 || strlen($contact_email)>40 || strlen($contact_body)>1000) {
				echo "<script> alert('Please, adhere to input maxlength of input fields.')</script>";
				
//VALIDATING EMAIL ADDRESS
			} if (filter_var($contact_email, FILTER_VALIDATE_EMAIL) === false) {
				echo '<script>alert("Sorry, '.$contact_email.' is not a valid email address")</script>';
		    } else {
//SENDING THE MAIL TO THE SPECIFIED RECIEVER
				$to = 'webnet2205@gmail.com';
				$subject = $contact_subject;
				$body = $contact_name."\n".$contact_body;
				$headers = 'From: '.$contact_email;
			
			if (@mail($to, $subject, $body, $headers )) {
				header('location: index.php');
				echo "<script>alert('Thanks for contacting us. We\'ll be in touch soon!')</script>";
			  } else {
				echo '<script>alert("Sorry, an error occurred. please try again.")</script>';
			  }
			}
}

?>