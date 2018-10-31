<?php

require '_app/Library/PHPMailer/class.phpmailer.php';

/**
 * Email [MODEL]
 * Modelo responsável por configurar a PHPMailer, validar os dados e dispara e-mails do sistema
 * @copyright (c) 2016, Rafael Osaku
 */
class Email {

    /** @var PHPMailer */
    private $Mail;

    /** CORPO DO E-MAIL */
    private $Assunto;
    private $Mensagem;

    /** EMAIL DATA */
    private $Data;

    /** REMETENTE - INFORMAÇOES DE CONTATO */
    private $RemetenteNome;
    private $RemetenteEmail;
    private $RemetenteFixo;
    private $RemetenteCelular;

    /** DESTINO */
    private $DestinoNome;
    private $DestinoEmail;

    /** CONTROLE */
    private $Error;
    private $Result;

    function __construct() {
        $this->Mail = new PHPMailer;
        $this->Mail->Host = MAILHOST;
        $this->Mail->Port = MAILPORT;
        $this->Mail->Username = MAILUSER;
        $this->Mail->Password = MAILPASS;
        $this->Mail->CharSet = 'UTF-8';
    }

    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        if ($this->Data['RemetenteNome'] == '' && $this->Data['RemetenteEmail'] && $this->Data['RemetenteCelular'] && $this->Data['Mensagem']):
            $this->Error = ['Erro ao enviar a mensagem: Para enviar essa mensagem, preencha todos os campos requisitados', WS_ALERT];
            $this->Result = false;
        elseif (!Check::Email($this->Data['RemetenteEmail'])):
            $this->Error = ['Erro ao enviar a mensagem: Por favor, informe um e-mail válido!', WS_ALERT];
            $this->Result = false;
        else:
            $this->setMail();
            $this->setConfig();
            $this->sendMail();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    //PRIVATES
    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    private function setMail() {
        $this->Assunto = $this->Data['Assunto'];
        $this->Mensagem = nl2br($this->Data['Mensagem']);
        $this->RemetenteNome = $this->Data['RemetenteNome'];
        $this->RemetenteEmail = $this->Data['RemetenteEmail'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];
        $this->RemetenteCelular = $this->Data['RemetenteCelular'];
        $this->RemetenteFixo = (!empty($this->Data['RemetenteFixo']) ?  $this->Data['RemetenteFixo'] : 'N/A');

        $this->Data = null;
        $this->setMsg();
    }

    private function setMsg() {
        $this->Mensagem = "{
			$this->Mensagem}<br>
			Nome: {$this->RemetenteNome}<br> 
			E-mail: {$this->RemetenteEmail}<br> 
			Fixo: {$this->RemetenteFixo}<br> 
			Celular: {$this->RemetenteCelular}<hr>
			<small>Recebida em : " . date('d/m/Y H:i') . "</small>";
    }

    private function setConfig() {
        //SMTP AUTH
        $this->Mail->isSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->isHTML();

        //REMETENTE E RETORNO
        $this->Mail->From = MAILUSER;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->AddReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //ASSUNTO, MENSGAEM E DESTINO
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->AddAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function sendMail() {
        if ($this->Mail->send()):
            $this->Error = ['Obrigado por entrar em contato: Recebemos sua mensagem e estaremos respondento em breve.', WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Erro ao enviar a mensagem, por favor tente novamente mais tarde. ({$this->Mail->ErrorInfo})", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
