<?php
$output='<p>Dear ' .$username .',</p>';
$output.='<p>Please use following link to verify your email.</p>';
$output.='<p>---------Developerspot----------------------------------------------------</p>';
$output.='<p><a href="/spexproject/templates/set-account-password.html.php?
key='.$token.'&email='.$email.'&action=set" target="_blank">
Confirm account creation </a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please click the link above to confirm it is you who requested account creation at Developerspot.
The link will expire after 1 day for security reasons.</p>';
$output.='<p>If you did not make this request, no action 
is needed, no account will be created.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Developerspot Team</p>';
$body = $output; 
$subject = "Account creation";
 
$email_to = $email;
$fromserver = "noreply@developerspot.co.ke"; 

require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com'; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "fkahindi@gmail.com"; // Enter your email here
$mail->Password = "erzwhncbbuudjlcz"; //Enter your password here
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = "fkahindi@gmail.com";
$mail->FromName = "Developerspot";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
	echo 'Message could not be sent.';
	echo "Mailer Error: " . $mail->ErrorInfo;
}else{
	echo "<div class='error'>
	<p>An email has been sent to ".$email.". You will neet to confirm before your account with us is set.</p>
	</div><br /><br /><br />";
	}
 