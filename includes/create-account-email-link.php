<?php
$output='<p>Dear ' .$username .',</p>';
$output.='<p>Please use following link to verify your email.</p>';
$output.='<p>---------Developerspot----------------------------------------------------</p>';
$output.='<p><a href="/spexproject/templates/set-account-password.html.php?key='.$token.'&email='.$email.'&username='.$username.'" target="_blank">
Confirm account creation </a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please click the link above to confirm it is you who requested account creation at Developerspot.
The link will expire after 1 day for security reasons.</p>';
$output.='<p>If you did not make this request, no action 
is needed; no account will be created.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Developerspot Team</p>';
$body = $output; 
$subject = "Account creation";
 
$email_to = $email;
$fromserver = "noreply@developerspot.co.ke"; 
require __DIR__ .'/../../includes_devspot/EmailCredentials.php';
require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com'; /* // Enter your host here */
$mail->SMTPAuth = true;
$mail->Username = EMAIL; /* // Enter your email here */
$mail->Password = PASS; /* //Enter your password here */
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = EMAIL;
$mail->FromName = "Developerspot";
$mail->Sender = $fromserver; /* // indicates ReturnPath header */
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
	$email_error = 'Message could not be sent. '.$mail->ErrorInfo;
}else{
	$email_success = "<p>An email has been sent to ".$email.". You will need to open your  email and confirm  before your account is set.</p>";
}
 