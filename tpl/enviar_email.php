<?php

if (!defined('HOME')):
    require_once __DIR__ . '/../_app/Config.inc.php';
endif;

$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'e-mail', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_DEFAULT);
$mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT);

$nome = trim(strip_tags((string) $nome));
$email = trim(strip_tags((string) $email));
$cidade = trim(strip_tags((string) $cidade));
$mensagem = trim(strip_tags((string) $mensagem));

$destinatario = "rflosaku@hotmail.com";
$assunto = 'Formulario de contato';
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
$msg .= "From: {$nome} <{$email}>";

mail($destinatario, $assunto, $arquivo, $msg);
header('Location: ' . HOME . '/form/contato');
exit;
