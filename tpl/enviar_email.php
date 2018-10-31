<?php

$nome = $_POST['nome'];
$email = $_POST['e-mail'];
$cidade = $_POST['cidade'];
$mensagem = $_POST['mensagem'];

$destinatario = "rflosaku@hotmail.com";
$assunto = 'Formlulário de contato';
$arquivo = "
    <style type='text/css'>
        td{background: #ccc;}
        td:nth-of-type(2n+0){background: #FFF;}
    </style>
        <html>
            <table>
                <tr>
                    <td>Nome: </td>
                    <td>{$nome}</td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>{$email}</td>
                </tr>
                <tr>
                    <td>Cidade: </td>
                    <td>{$cidade}</td>
                </tr>
                <tr>
                    <td>Mensagem: </td>
                    <td>{$mensagem}</td>
                </tr>
            </table>
        </html>
                
        ";

$msg = 'MIME-Version: 1.0' . "\r\n";
$msg .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$msg .= 'From: <$nome> <$email>';


if (mail("$destinatario", "$assunto", "$arquivo", "$msg")) {
    echo 'Formulário enviado com sucesso!';
    header('Location: ' . HOME . '/contato');
} else {
    echo 'Erros ao enviar formulário"';
    header('Location: ' . HOME . '/contato');
}