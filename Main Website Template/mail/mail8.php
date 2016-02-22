<?php
// Check for empty fields

if(empty($_POST['name8'])  		||
   empty($_POST['email8']) 		||
   empty($_POST['message8'])	||
   !filter_var($_POST['email8'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name8'];
$email_address = $_POST['email8'];
$message = $_POST['message8'];
	
// Create the email and send the message
$to = 'pmavji@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nFull Name: $name\n\nEmail: $email_address\n\nMessage:\n$message";
$headers = "From:$email_address\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>