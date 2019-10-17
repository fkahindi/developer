<?php
$output='<p>Dear user,</p>';
$output.='<p>Please use the following link to confirm your subscription.</p>';
$output.='<p>---------Developerspot----------------------------------------------------</p>';
$output.='<p><a href="/spexproject/templates/confirm-subscription.html.php?
key='.$token.'&email='.$email.'&action=subscribe" target="_blank">
Confirm email subscription</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please, if the link does not work, copy and past it on a new tab on your browser.
The link will expire after 1 day for security reasons.</p>';
$output.='<p>If you did not request this subscription, no action 
is needed, you will not be subscribed.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Developerspot Team</p>';
$body = $output; 
$subject = "Email Subscription";
 
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
	<p>An email has been sent to you with instructions to confirm your email.</p>
	</div><br /><br /><br />";
	}
 