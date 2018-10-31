<?php

require '_app/Library/PHPMailer/class.phpmailer.php';

/**
 * Email [MODEL]
 * Modelo responsável por configurar a PHPMailer, validar os dados e dispara e-mails do sistema
 * @copyright (c) 2016, Rafael Osaku
 */
class FormEquipamento {

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
    private $RenovarSeguro;
    private $TempoDeSeguro;
    private $SeguroAcionado;
    private $EquipamentoFinanciado;
    private $AtividadeEquipamento;
    private $EquipamentoLocado;
    private $EquipamentoAcoplado;
    private $NomeSegurado;
    private $CPF_CNPJ;
    private $InfoFabricante;
    private $Marca;
    private $AnoFab;
    private $EquipamentoNovo;
    private $Chassi;
    private $Modelo;
    private $CEP;
    private $ValorEquipamento;
    private $CoberturaRoubo;
    private $ProximoAgua;

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
        $this->RenovarSeguro = (!empty($this->Data['RenovarSeguro']) ? $this->Data['RenovarSeguro'] : 'N/A' );
        $this->TempoDeSeguro = (!empty($this->Data['TempoDeSeguro']) ? $this->Data['TempoDeSeguro'] : 'N/A' );
        $this->SeguroAcionado = (!empty($this->Data['SeguroAcionado']) ? $this->Data['SeguroAcionado'] : 'N/A' );
        $this->EquipamentoFinanciado = (!empty($this->Data['EquipamentoFinanciado']) ? $this->Data['EquipamentoFinanciado'] : 'N/A' );
        $this->AtividadeEquipamento = (!empty($this->Data['AtividadeEquipamento']) ? $this->Data['AtividadeEquipamento'] : 'N/A' );
        $this->EquipamentoLocado = (!empty($this->Data['EquipamentoLocado']) ? $this->Data['EquipamentoLocado'] : 'N/A' );
        $this->EquipamentoAcoplado = (!empty($this->Data['EquipamentoAcoplado']) ? $this->Data['EquipamentoAcoplado'] : 'N/A' );
        $this->NomeSegurado = (!empty($this->Data['NomeSegurado']) ? $this->Data['NomeSegurado'] : 'N/A' );
        $this->CPF_CNPJ = (!empty($this->Data['CPF_CNPJ']) ? $this->Data['CPF_CNPJ'] : 'N/A' );
        $this->InfoFabricante = (!empty($this->Data['InfoFabricante']) ? $this->Data['InfoFabricante'] : 'N/A' );
        $this->Marca = (!empty($this->Data['Marca']) ? $this->Data['Marca'] : 'N/A' );
        $this->AnoFab = (!empty($this->Data['AnoFab']) ? $this->Data['AnoFab'] : 'N/A' );
        $this->EquipamentoNovo = (!empty($this->Data['EquipamentoNovo']) ? $this->Data['EquipamentoNovo'] : 'N/A' );
        $this->Chassi = (!empty($this->Data['Chassi']) ? $this->Data['Chassi'] : 'N/A' );
        $this->Modelo = (!empty($this->Data['Modelo']) ? $this->Data['Modelo'] : 'N/A' );
        $this->CEP = (!empty($this->Data['CEP']) ? $this->Data['CEP'] : 'N/A' );
        $this->ValorEquipamento = (!empty($this->Data['ValorEquipamento']) ? $this->Data['ValorEquipamento'] : 'N/A' );
        $this->CoberturaRoubo = (!empty($this->Data['CoberturaRoubo']) ? $this->Data['CoberturaRoubo'] : 'N/A' );
        $this->ProximoAgua = (!empty($this->Data['ProximoAgua']) ? $this->Data['ProximoAgua'] : 'N/A' );

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
	Renovar: {$this->RenovarSeguro}<br>
	Tempo de seguro: {$this->TempoDeSeguro}<br>
	Houve sinistro? {$this->SeguroAcionado}<br>
	Equipamento financiado? {$this->EquipamentoFinanciado}<br>
	Atividade do equipamento {$this->AtividadeEquipamento}<br>
	O equipamento será locado a terceiros? {$this->EquipamentoLocado}<br>
	O equipamento será acoplado a algum veículo? {$this->EquipamentoAcoplado}<br>
	Nome completo do segurado: {$this->NomeSegurado}<br>
	CPF/CNPJ: {$this->CPF_CNPJ}<br>
	Fabricante: {$this->InfoFabricante}<br>
	Marca: {$this->Marca}<br>
	Ano de fabricação: {$this->AnoFab}<br>
	Equipamento novo? {$this->EquipamentoNovo}<br>
	Chassi: {$this->Chassi}<br>
	Modelo: {$this->Modelo}<br>
	CEP: {$this->CEP}<br>
	Valor do equipamento: {$this->ValorEquipamento}<br>
	Cobertura contra roubo: {$this->CoberturaRoubo}<br>
	Operação próximo a água? {$this->ProximoAgua}<br>		
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
