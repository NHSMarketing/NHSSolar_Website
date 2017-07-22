<?php
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

include_once('mail_config.php');

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                             // Enable verbose debug output

$mail->isSMTP();                                    // Set mailer to use SMTP
$mail->Host = $host;  								// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                             // Enable SMTP authentication
$mail->Username = $email_marketing;                 		// SMTP username
$mail->Password = $senha_marketing;                        // SMTP password
$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
$mail->Port = $port;                                // TCP port to connect to

$mail->setFrom($from_marketing);
$mail->addAddress($to_marketing);     		// Add a recipient

$mail->isHTML(true);

// DADOS

$email = $_POST["newsletter_email"];
$nome = $_POST["newsletter_nome"];

$mail->Subject = 'NHS Solar – Acesso a newsletter';
$mail->Body    = "<p>Nome: $nome</p><p>Email: $email</p>";
$mail->AltBody = "Nome: $nome
Email: $email";

if(!$mail->send()) {
    $response['notification'] = array(
			'text' => 'Um erro ocorreu ao enviar sua mensagem. Tente novamente.',
			'status' => 'error'
		);

	$response['status'] = 'error';
} else {
    $response['notification'] = array(
		'text' => 'Sua mensagem foi enviada com sucesso.',
		'status' => 'success'
	);
}

die(json_encode($response));
