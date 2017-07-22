<?php
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

include_once('mail_config.php');

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                             // Enable verbose debug output

$mail->isSMTP();                                    // Set mailer to use SMTP
$mail->Host = $host;  								// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                             // Enable SMTP authentication
$mail->Username = $email_falecom;                 		// SMTP username
$mail->Password = $senha_falecom;                        // SMTP password
$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
$mail->Port = $port;                                // TCP port to connect to

$mail->setFrom($from_falecom);
$mail->addAddress($to_falecom);     		// Add a recipient

$mail->isHTML(true);

// DADOS

$email = $_POST["cliente_email"];
$nome = $_POST["cliente_nome"];
$telefone = $_POST["cliente_telefone"];
$zipcode = $_POST["cliente_zipcode"];
$option = $_POST["cliente__option"];

$mail->Subject = 'NHS Solar – Novo Lead';
$mail->Body    = "<p>Nome: $nome</p><p>Email: $email</p><p>Telefone: $telefone</p><p>CEP: $zipcode</p><p>Opção: $option</p>";
$mail->AltBody = "Nome: $nome
Email: $email
Telefone: $telefone
CEP: $zipcode
Opção: $option";

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