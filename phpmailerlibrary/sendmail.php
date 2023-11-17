<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
require '/Users/mac/Documents/aws-ses-phpmailer/phpmailerlibrary/vendor/autoload.php';
$sender = 'kunmi.tokede@redbiller.email ';
$senderName = 'Transaction';
 
// is still in the sandbox, this address must be verified.
$recipient = 'oluwademilade206@gmail.com';

 
// Replace smtp_username with your Amazon SES SMTP user name.
$username = '<access-key>';
 
// Replace smtp_password with your Amazon SES SMTP password.
$password = '<secret-key>';
$host = 'email-smtp.eu-west-2.amazonaws.com'; 
$port = 465;
 
// The subject line of the email
$subject = 'Transaction';
 
// If you are sending The plain-text body of the email then uncomment below code line
//$bodyText =  "-- Put body text here --";
 
// The HTML-formatted body of the email
$bodyHtml = 'confirmed';
 
$mail = new PHPMailer(true);
 
try {
    // Specify the SMTP settings.
    $mail->isSMTP(true);
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $username;
    $mail->Password   = $password;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'ssl';
  //  $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
 
    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.
 
    //If you want to send reply to specific email , then use below code for Reply To
    //$mail->ClearReplyTos();
    //$mail->addReplyTo('Enter Reply to Email here', 'Enter Reply to name here');
 
    //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
 
    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    echo "Email sent successfully!";
} catch (phpmailerException $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}
?>
