<?php
 //EMAIL VALIDATION****
   if(isset($_POST['email'])) {
     $email = $_POST['email'];
	   if (!empty($email)) {
	      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		     echo '<em style="color:red;font-size:12px">Email is not valid</em>';
		  } else {
		     echo '<em style="color:green;font-size:12px">Email is valid</em>';
		  }
	   }
   }

?>