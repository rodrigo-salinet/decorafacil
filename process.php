<?php

$errors = [];
$data = [];

$txt_nome = $_POST['txt_nome'];
if (empty($txt_nome)) {
    $errors['txt_nome'] = 'Nome é necessário.';
}

$txt_email = $_POST['txt_email'];
if (empty($txt_email)) {
    $errors['txt_email'] = 'Email é necessário.';
}

$txt_mensagem = $_POST['txt_mensagem'];
if (empty($_POST['txt_mensagem'])) {
    $errors['txt_mensagem'] = 'Mensagem é necessária.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $to      = "Tatiana Medeiros <atendimento@decorafacil.arq.br>, Rodrigo Salinet <rodrigo.salinet@gmail.com>";
    $subject = "Contato do site.";
    $message = "Nome: $txt_nome. <br /> Email: $txt_email. <br /> Mensagem: $txt_mensagem. <br /> Fim.";
    $headers = "From: $txt_nome <$txt_email>\r\n" .
        "Reply-To: $txt_nome <$txt_email>\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        $data['success'] = true;
        $data['message'] = 'Mensagem enviada com sucesso!';
    } else {
        $data['success'] = false;
        $data['errors'] = $errors;
    }
}

echo json_encode($data);