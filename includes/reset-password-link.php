<?php



$output='<p>Dear user,</p>';
$output.='<p>Please click the following link or copy and paste it on a new tab of your browser to reset your password.</p>';
$output.='<p>---------Developerspot----------------------------------------------------</p>';
$output.='<p><a href="localhost/spexproject/templates/reset-password.html.php?
key='.$token.'&email='.$email.'&action=reset" target="_blank">
Recover my password</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='The link will expire after 1 day for security reasons.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may be trying to guess it.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Developerspot Team</p>';
$body = $output; 
$subject = "Password Recovery";
 
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
$mail->FromName = "Spex Solutions";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
	echo 'Message could not be sent.';
	echo "Mailer Error: " . $mail->ErrorInfo;
}else{
	echo "<div class='error'>
	<p>An email has been sent to you with instructions on how to reset your password.</p>
	</div><br><br><br>";
	}
 