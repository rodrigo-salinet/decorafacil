<?php

require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // (993 ou 587) 465 or 587
$mail->IsHTML(true);
$mail->Username = "atendimento@decorafacil.arq.br";
$mail->Password = "zgdysrmumeskaqbq";

$errors = [];
$data = [];

$txt_nome = $_POST['txt_nome'];
if (empty($txt_nome)) {
    $errors['txt_nome'] = 'Digite um nome acima para continuar.';
}

$txt_email = $_POST['txt_email'];
if (empty($txt_email)) {
    $errors['txt_email'] = 'Digite um email acima para continuar.';
}

$txt_mensagem = $_POST['txt_mensagem'];
if (empty($_POST['txt_mensagem'])) {
    $errors['txt_mensagem'] = 'Digite uma mensagem acima para continuar.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $to      = "atendimento@decorafacil.arq.br";
    $subject = "Contato do site.";
    $message = "Nome: $txt_nome. <br /> \r\n Email: $txt_email. <br /> \r\n Mensagem: $txt_mensagem. <br /> \r\n Fim.";

    $mail->SetFrom($txt_email);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $data['success'] = false;
        $data['errors'] = $errors;
    } else {
        $data['success'] = true;
        $data['message'] = 'Mensagem enviada com sucesso!';
    }
}

echo json_encode($data);
