<?php

require '_app/Library/PHPMailer/class.phpmailer.php';

/**
 * Email [MODEL]
 * Modelo responsável por configurar a PHPMailer, validar os dados e dispara e-mails do sistema
 * @copyright (c) 2016, Rafael Osaku
 */
class FormDpem {

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

    /** DADOS DO FORMULÁRIO */
    private $NomeSegurado;
    private $cpf_cnpj;
    private $RG;
    private $OrgaoEmissor;
    private $DataEmissao;
    private $Rua;
    private $Numero;
    private $Bairro;
    private $Cidade;
    private $UF;
    private $CEP;
    private $BilheteAnterior;
    private $VencidoEm;
    private $NomeEmbarcacao;
    private $EmbarcacaoInscricao;
    private $nTripulantes;
    private $nPassageiros;
    private $Propulsao;
    private $tipoEmbarcacao;
    private $Uso;

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
		if ($this->Data['RemetenteFixo'] == ''){
			$this->Data['RemetenteFixo'] = 'N/A';
		}

            $this->setMail();
            $this->setConfig();
            $this->sendMail();
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
        $this->NomeSegurado = (!empty($this->Data['NomeSegurado']) ? $this->Data['NomeSegurado'] : 'N/A');
        $this->cpf_cnpj = (!empty($this->Data['cpf_cnpj']) ? $this->Data['cpf_cnpj'] : 'N/A');
        $this->RG = (!empty($this->Data['RG']) ? $this->Data['RG'] : 'N/A');
        $this->OrgaoEmissor = (!empty($this->Data['OrgaoEmissor']) ? $this->Data['OrgaoEmissor'] : 'N/A');
        $this->DataEmissao = (!empty($this->Data['DataEmissao']) ? $this->Data['DataEmissao'] : 'N/A');
        $this->Rua = $this->Data['Rua'];
        $this->Numero = $this->Data['Numero'];
        $this->Bairro = $this->Data['Bairro'];
        $this->Cidade = $this->Data['Cidade'];
        $this->UF = $this->Data['UF'];
        $this->CEP = $this->Data['CEP'];
        $this->BilheteAnterior = (!empty($this->Data['BilheteAnterior']) ? $this->Data['BilheteAnterior'] : 'N/A');
        $this->VencidoEm = (!empty($this->Data['VencidoEm']) ? $this->Data['VencidoEm'] : 'N/A');
        $this->NomeEmbarcacao = (!empty($this->Data['NomeEmbarcacao']) ? $this->Data['NomeEmbarcacao'] : 'N/A');
        $this->EmbarcacaoInscricao = (!empty($this->Data['EmbarcacaoInscricao']) ? $this->Data['EmbarcacaoInscricao'] : 'N/A');
        $this->nTripulantes = (!empty($this->Data['nTripulantes']) ? $this->Data['nTripulantes'] : 'N/A');
        $this->nPassageiros = (!empty($this->Data['nPassageiros']) ? $this->Data['NomeSegurado'] : 'N/A');
        $this->Propulsao = (!empty($this->Data['Propulsao']) ? $this->Data['Propulsao'] : 'N/A');
        $this->tipoEmbarcacao = (!empty($this->Data['tipoEmbarcacao']) ? $this->Data['tipoEmbarcacao'] : 'N/A');
        $this->Uso = (!empty($this->Data['Uso']) ? $this->Data['Uso'] : 'N/A');

        $this->Assunto = $this->Data['Assunto'];
        $this->RemetenteNome = $this->Data['RemetenteNome'];
        $this->RemetenteEmail = $this->Data['RemetenteEmail'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];
        $this->RemetenteCelular = $this->Data['RemetenteCelular'];
        $this->RemetenteFixo = $this->Data['RemetenteFixo'];

        $this->Data = null;
        $this->setMsg();
    }

    private function setMsg() {
        $this->Mensagem = "
            Segurado: {$this->NomeSegurado}<br>
            CPF/CNPJ: {$this->cpf_cnpj}<br>
            RG: {$this->RG}<br>
            Órgão Emissor: {$this->OrgaoEmissor}<br>
            Data de emissão: {$this->DataEmissao}<br>
            Rua: {$this->Rua}<br>
            Número: {$this->Numero}<br>
            Bairro: {$this->Bairro}<br>
            Cidade: {$this->Cidade}<br>
            UF: {$this->UF}<br>
            CEP: {$this->CEP}<br>
            Bilhete anterior: {$this->BilheteAnterior}<br>
            Vencido em: {$this->VencidoEm}<br>
            Nome da embarcação: {$this->NomeEmbarcacao}<br>
            Inscrição: {$this->EmbarcacaoInscricao}<br>
            Nº de tripulantes: {$this->nTripulantes}<br>
            Nº de passageiros: {$this->nPassageiros}<br>
            Propulsão: {$this->Propulsao}<br>
            Tipo de embarcaçõo: {$this->tipoEmbarcacao}<br>
            Uso: {$this->Uso}<br>
            <br>
            <b>Dados para contato:</b><br>
            Nome: {$this->RemetenteNome}<br> 
            E-mail: {$this->RemetenteEmail}<br> 
            Fixo: {$this->RemetenteFixo}<br> 
            Celular: {$this->RemetenteCelular}
            <hr>
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
