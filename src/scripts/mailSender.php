<?php

error_reporting(0);

@include ('PHPMailer/PHPMailerAutoload.php');

echo ">> Loading configuration\r\n";

@include ('configuration.php');

echo ">> Connecting to database\r\n";

$pdo = new PDO ("mysql:host=localhost;dbname=Agency","root","ubuntu");

echo ">> Querying mailing information\r\n";

$query = $pdo->prepare("
	SELECT
		mailings.*,
		clients.mail,
		clients.firstname,
		clients.lastname,
		users.fullname,
		users.email
	FROM
		mailings
	JOIN
		clients ON mailings.client_id = clients.id
	JOIN
		users ON mailings.user_id = users.id
	WHERE
		mailings.state = 'Todo'
	LIMIT 0,1");

$query->execute();

echo ">> Extracting informations\r\n";

$row = $query->fetch();


if ($row)
{
	echo ">> Updating mailing status\r\n";

	$id = $row['id'];

	$query = $pdo->prepare("UPDATE mailings SET state = 'InProgress' WHERE id = $id");
	$query->execute();

	unset($query);

	echo ">> Building mail\r\n";

	$from = $row['email'];
	$to = $row['mail']; 
	$to_firstname = $row['firstname']; 
	$to_lastname = $row['lastname']; 
	$subject = $row['subject'];
	$message = $row['message'];


	//Create a new PHPMailer instance
	$mail = new PHPMailer;

	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	
	//Set who the message is to be sent from
	$mail->setFrom($from, 'Cross Immobilier');
	
	//Set an alternative reply-to address
	$mail->addReplyTo($from, 'Cross Immobilier');

	//Set who the message is to be sent to
	$mail->addAddress($to, $to_lastname . " " . $to_firstname);
	
	//Set the subject line
	$mail->Subject = $subject;
	
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($message);
	
	//Replace the plain text body with one created manually
	$mail->AltBody = $message;
	
	//Attach an image file
	$query = $pdo->prepare("
		SELECT
			uploads.*
		FROM
			mailings_uploads
		JOIN
			uploads ON mailings_uploads.upload_id = uploads.id
		WHERE
			mailings_uploads.mailing_id = :mailing");

	$query->execute(array(
		'mailing' => $id
	));

	$uploads = $query->fetchAll();

	foreach ($uploads as $upload) {
		echo ">> Adding attachment " . $upload["path"] . "\r\n";
		
		$mail->addAttachment($upload['path']);
	}

	echo ">> Sending mail\r\n";

	//send the message, check for errors
	$mail_sent = $mail->send(); 

	$status = $mail_sent ? "Success" : "Error";

	echo ">> Sending mail : $status\r\n";

	if ($status == "Error") {
		echo $mail->ErrorInfo . "\r\n";
	}

	$query = $pdo->prepare("UPDATE mailings SET state = '$status' WHERE id = $id");
	$query->execute();

	unset($query);
}
else
{
	echo ">> No available data in database\r\n";
}

unset($pdo); 
