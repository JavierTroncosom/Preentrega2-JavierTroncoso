<?php
require 'PHPMailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php';


/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/vendor/autoload.php';

$Nombre=$_POST['Name'];
$correo=$_POST['Email'];
$tel=$_POST['Telefono'];
$Mens=$_POST['Mensaje'];
//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = '587';

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = 'tls';
$mail->SMTPOptions = array (
				'ssl' => array(
				'verify_peer'  => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true,
				)
			);

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'admonraices399@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'ftsm emrb xzgi ejnn';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('troncosoadan32@gmail.com', 'Correo de informacion');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses

//Set who the message is to be sent to
//$mail->addAddress('bererov.09@gmail.com', 'Bere');
$mail->addAddress('adan.troncoso@live.com.mx', 'Adan');
//Set the subject line
$mail->Subject = 'Información Cliente';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

//Replace the plain text body with one created manually
$mail->Body = 'Hola ,'.$Nombre.' quiere comunicarse contigo su correo es : '.$correo.'.';

//Attach an image fil
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.