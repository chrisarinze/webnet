$(document).ready(function(){
  
  //FOCUSIN FOCUSOUT
	$('#psw').focusin(function() {
	  $('#psw_span').html('<em style="color:red;font-size:12px">This must be 6 characters or more.</em>');
	});
	$('#psw').focusout(function() {
	  $('#psw_span').html('');
	});  
	
	//FOCUSIN FOCUSOUT
	$('#bio').focusin(function() {
	  $('#bio_span').html('<em style="color:red;font-size:12px">Minlength is 20, Maxlength is 100 characters.</em>');
	});
	$('#bio').focusout(function() {
	  $('#bio_span').html('');
	});
	
	//EMAIL VALIDATION
	 function validate_email(email) {
		$.post('email.php', { email: email }, function(data) {
		  $('#feedback').html(data);
		});
	 }
	 $('#email').focus(function() {
	  if ($('#email').val() === '') {
		$('#feedback').html('<em style="font-size:12px">Email should be valid pls...</em>');
	   } else {
		 validate_email($('#email').val());
	   }
	 }).blur(function() {
		$('#feedback').html('');
	 }).keyup(function() {
		validate_email($('#email').val());
	 });
	 
	 $('#submit').click(function() {
		$(this).attr('disabled', true);
	});
	
});