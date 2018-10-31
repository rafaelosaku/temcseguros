<?php

require '_app/Library/PHPMailer/class.phpmailer.php';

/**
 * Email [MODEL]
 * Modelo responsável por configurar a PHPMailer, validar os dados e dispara e-mails do sistema
 * @copyright (c) 2016, Rafael Osaku
 */
class FormNautico {

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
    private $Embarcacao;
    private $NomeSegurado;
    private $TipoPessoa;
    private $CPF_CNPJ;
    private $NomeEmbarcacao;
    private $AnoConstrucao;
    private $ZeroMilha;
    private $TipoMaterial;
    private $Comprimtento;
    private $ValorEmbarcação;
    private $LimiteNavegacao;
    private $RenovarSeguro;
    private $TempoDeSeguro;
    private $SeguroAcionado;
    private $CEP;
    private $UF;
    private $Municipio;

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
        $this->Embarcacao = (!empty($this->Data['Embarcacao']) ? $this->Data['Embarcacao'] : 'N/A');
        $this->NomeSegurado = (!empty($this->Data['NomeSegurado']) ? $this->Data['NomeSegurado'] : 'N/A');
        $this->TipoPessoa = (!empty($this->Data['TipoPessoa']) ? $this->Data['TipoPessoa'] : 'N/A');
        $this->CPF_CNPJ = (!empty($this->Data['CPF_CNPJ']) ? $this->Data['CPF_CNPJ'] : 'N/A');
        $this->NomeEmbarcacao = (!empty($this->Data['NomeEmbarcacao']) ? $this->Data['NomeEmbarcacao'] : 'N/A');
        $this->AnoConstrucao = (!empty($this->Data['AnoConstrucao']) ? $this->Data['AnoConstrucao'] : 'N/A');
        $this->ZeroMilha = (!empty($this->Data['ZeroMilha']) ? $this->Data['ZeroMilha'] : 'N/A');
        $this->TipoMaterial = (!empty($this->Data['TipoMaterial']) ? $this->Data['TipoMaterial'] : 'N/A');
        $this->Comprimtento = (!empty($this->Data['Comprimtento']) ? $this->Data['Comprimtento'] : 'N/A');
        $this->ValorEmbarcação = (!empty($this->Data['ValorEmbarcação']) ? $this->Data['ValorEmbarcação'] : 'N/A');
        $this->LimiteNavegacao = (!empty($this->Data['LimiteNavegacao']) ? $this->Data['LimiteNavegacao'] : 'N/A');
        $this->RenovarSeguro = (!empty($this->Data['RenovarSeguro']) ? $this->Data['RenovarSeguro'] : 'N/A');
        $this->TempoDeSeguro = (!empty($this->Data['TempoDeSeguro']) ? $this->Data['TempoDeSeguro'] : 'N/A' );
        $this->SeguroAcionado = (!empty($this->Data['SeguroAcionado']) ? $this->Data['SeguroAcionado'] : 'N/A' );
        $this->CEP = $this->Data['CEP'];
        $this->UF = $this->Data['UF'];
        $this->Municipio = $this->Data['Municipio'];
        

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
	Tipo de embarcação: {$this->Embarcacao}<br>
	Nome completo do segurado: {$this->NomeSegurado}<br>
	Tipo de pessoa: {$this->TipoPessoa}<br>
	CPF/CNPJ: {$this->CPF_CNPJ}<br>
	Nome da embarcação: {$this->NomeEmbarcacao}<br>
	Informe o ano de construção: {$this->AnoConstrucao}<br>
	0 Milhas: {$this->ZeroMilha}<br>
	Tipo de material de construção: {$this->TipoMaterial}<br>
	Comprimento (pés): {$this->Comprimtento}<br>
	Valor da embarcação: {$this->ValorEmbarcação}<br>
	Limite de navegação: {$this->LimiteNavegacao}<br>
	Renovar: {$this->RenovarSeguro}<br>
	Tempo de seguro: {$this->TempoDeSeguro}<br>		
	Houve sinistro: {$this->SeguroAcionado}<br>
	CEP: {$this->CEP}<br>
	UF: {$this->UF}<br>
	Município: {$this->Municipio}<br>
	<br>
        <b>Dados para contato:</b><br>
        Nome: {$this->RemetenteNome}<br>
        E-mail: {$this->RemetenteEmail}<br>
        Fixo: {$this->RemetenteFixo}<br>
        Celular: {$this->RemetenteCelular}<hr><small>Recebida em : " . date('d/m/Y H:i') . "</small>";
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
