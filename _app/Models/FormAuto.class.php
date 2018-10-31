<?php

require '_app/Library/PHPMailer/class.phpmailer.php';

/**
 * Email [MODEL]
 * Modelo responsável por configurar a PHPMailer, validar os dados e dispara e-mails do sistema
 * @copyright (c) 2016, Rafael Osaku
 */
class FormAuto {

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

    /** FORMULARIO AUTO-MOTO-CAMINHAO */
    private $RenovarSeguro;
    private $Seguradora;
    private $BonusAnual;
    private $Sinistro;
    private $VeiculoFinanciado;
    private $NomeSegurado;
    private $SexoSegurado;
    private $DataNascAsseg;
    private $cpfSegurado;
    private $estadoCivilAsseg;
    private $Fabricante;
    private $ModeloVeiculo;
    private $AnoVeiculo;
    private $AnoModelo;
    private $combustivel;
    private $veiculo0km;
    private $placa;
    private $chassi;
    private $antiFurto;
    private $dispositivoAntiFurto;
    private $blindado;
    private $kitgas;
    private $cep;
    private $filhosResidentes;
    private $utilizacao;
    private $garagemResidencia;
    private $garagemTrabalho;
    private $coberturaVidros;
    private $assistGincho;
    private $assistTipo;
    private $CondutorPrincipal;
    private $CondutorPrincipalNome;
    private $sexoCondutorPrincipal;
    private $dataNascCondutorPrincipal;
    private $cpfCondutorPrincipal;
    private $estadoCivilCondutorPrincipal;

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
		
		if($this->Data['RenovarSeguro'] == ''){
			$this->Data['RenovarSeguro'] = 'N/A';
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
        
        //$this->RenovarSeguro = (!empty($this->Data['RenovarSeguro']) ? $this->Data['RenovarSerguro'] : 'N/A');,
		$this->RenovarSeguro = $this->Data['RenovarSeguro'];
        $this->Seguradora = (!empty($this->Data['Seguradora']) ? $this->Data['Seguradora'] : 'N/A');
        $this->BonusAnual = (!empty($this->Data['BonusAnual']) ? $this->Data['BonusAnual'] : 'N/A');
		$this->Sinistro = (!empty($this->Data['Sinistro']) ? $this->Data['Sinistro'] : 'N/A');
        $this->VeiculoFinanciado = (!empty($this->Data['VeiculoFinanciado']) ? $this->Data['VeiculoFinanciado'] : 'N/A');
        $this->NomeSegurado = (!empty($this->Data['NomeSegurado']) ? $this->Data['NomeSegurado'] : 'N/A');
        $this->SexoSegurado = (!empty($this->Data['SexoSegurado']) ? $this->Data['SexoSegurado'] : 'N/A');
        $this->DataNascAsseg = (!empty($this->Data['DataNascAsseg']) ? $this->Data['DataNascAsseg'] : 'N/A');
        $this->cpfSegurado = (!empty($this->Data['cpfSegurado']) ? $this->Data['cpfSegurado'] : 'N/A');
        $this->estadoCivilAsseg = (!empty($this->Data['estadoCivilAsseg']) ? $this->Data['estadoCivilAsseg'] : 'N/A');
        $this->Fabricante = (!empty($this->Data['Fabricante']) ? $this->Data['Fabricante'] : 'N/A');
        $this->ModeloVeiculo = (!empty($this->Data['ModeloVeiculo']) ? $this->Data['ModeloVeiculo'] : 'N/A');
        $this->AnoVeiculo = (!empty($this->Data['AnoVeiculo']) ? $this->Data['AnoVeiculo'] : 'N/A');
        $this->AnoModelo = (!empty($this->Data['AnoModelo']) ? $this->Data['AnoModelo'] : 'N/A');
        $this->combustivel = (!empty($this->Data['combustivel']) ? $this->Data['combustivel'] : 'N/A');
        $this->veiculo0km = (!empty($this->Data['veiculo0km']) ? $this->Data['veiculo0km'] : 'N/A');
        $this->placa = (!empty($this->Data['placa']) ? $this->Data['placa'] : 'N/A');
        $this->chassi = (!empty($this->Data['chassi']) ? $this->Data['chassi'] : 'N/A');
        $this->antiFurto = (!empty($this->Data['antiFurto']) ? $this->Data['antiFurto'] : 'N/A');
        $this->dispositivoAntiFurto = (!empty($this->Data['dispositivoAntiFurto']) ? $this->Data['dispositivoAntiFurto'] : 'N/A');
        $this->blindado = (!empty($this->Data['blindado']) ? $this->Data['blindado'] : 'N/A');
        $this->kitgas = (!empty($this->Data['kitgas']) ? $this->Data['kitgas'] : 'N/A');
        $this->cep = (!empty($this->Data['cep']) ? $this->Data['cep'] : 'N/A');
        $this->filhosResidentes = (!empty($this->Data['filhosResidentes']) ? $this->Data['filhosResidentes'] : 'N/A');
        $this->utilizacao = (!empty($this->Data['utilizacao']) ? $this->Data['utilizacao'] : 'N/A');
        $this->garagemResidencia = (!empty($this->Data['garagemResidencia']) ? $this->Data['garagemResidencia'] : 'N/A');
        $this->garagemTrabalho = (!empty($this->Data['garagemTrabalho']) ? $this->Data['garagemTrabalho'] : 'N/A');
        $this->coberturaVidros = (!empty($this->Data['coberturaVidros']) ? $this->Data['coberturaVidros'] : 'N/A');
        $this->assistGincho = (!empty($this->Data['assistGincho']) ? $this->Data['assistGincho'] : 'N/A');
        $this->assistTipo = (!empty($this->Data['assistTipo']) ? $this->Data['assistTipo'] : 'N/A');
        $this->CondutorPrincipal = (!empty($this->Data['CondutorPrincipal']) ? $this->Data['CondutorPrincipal'] : 'N/A');
        $this->CondutorPrincipalNome = (!empty($this->Data['CondutorPrincipalNome']) ? $this->Data['CondutorPrincipalNome'] : 'N/A');
        $this->sexoCondutorPrincipal = (!empty($this->Data['sexoCondutorPrincipal']) ? $this->Data['sexoCondutorPrincipal'] : 'N/A');
        $this->dataNascCondutorPrincipal = (!empty($this->Data['dataNascCondutorPrincipal']) ? $this->Data['dataNascCondutorPrincipal'] : 'N/A');
        $this->cpfCondutorPrincipal = (!empty($this->Data['cpfCondutorPrincipal']) ? $this->Data['cpfCondutorPrincipal'] : 'N/A');
        $this->estadoCivilCondutorPrincipal = (!empty($this->Data['estadoCivilCondutorPrincipal']) ? $this->Data['estadoCivilCondutorPrincipal'] : 'N/A');
        
        $this->Assunto = $this->Data['Assunto'];
        //$this->Mensagem = $this->Data['Mensagem'];
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
                Seguradora: {$this->Seguradora}<br>
                Bônus Anual: {$this->BonusAnual}<br>
                Sinistro: {$this->Sinistro}<br>
                Veiculo Financiado: {$this->VeiculoFinanciado}<br>
                <b>Dados do segurado:</b><br>
                Nome: {$this->NomeSegurado}<br>
                Sexo: {$this->SexoSegurado}<br>
                Data Nasc.: {$this->DataNascAsseg}<br>
                CPF: {$this->cpfSegurado}<br>
                Estado civil: {$this->estadoCivilAsseg}<br>
                Fabricante: {$this->Fabricante}<br>
                Modelo Veiculo: {$this->ModeloVeiculo}<br>
                Ano Veiculo: {$this->AnoVeiculo}<br>
                Ano Modelo: {$this->AnoModelo}<br>
                combustivel: {$this->combustivel}<br>
                veiculo0km: {$this->veiculo0km}<br>
                placa: {$this->placa}<br>
                chassi: {$this->chassi}<br>
                antiFurto: {$this->antiFurto}<br>
                Tipo: {$this->dispositivoAntiFurto}<br>
                blindado: {$this->blindado}<br>
                kitgas: {$this->kitgas}<br>
                cep: {$this->cep}<br>
                filhosResidentes: {$this->filhosResidentes}<br>
                utilizacao: {$this->utilizacao}<br>
                garagemResidencia: {$this->garagemResidencia}<br>
                garagemTrabalho: {$this->garagemTrabalho}<br>
                coberturaVidros: {$this->coberturaVidros}<br>
                assistGincho: {$this->assistGincho}<br>
                assistTipo: {$this->assistTipo}<br>
                CondutorPrincipal: {$this->CondutorPrincipal}<br>
                CondutorPrincipalNome: {$this->CondutorPrincipalNome}<br>
                sexoCondutorPrincipal: {$this->sexoCondutorPrincipal}<br>
                dataNascCondutorPrincipal: {$this->dataNascCondutorPrincipal}<br>
                cpfCondutorPrincipal: {$this->cpfCondutorPrincipal}<br>
                estadoCivilCondutorPrincipal: {$this->estadoCivilCondutorPrincipal}<br>
                <br><b>Dados para contato:</b><br>
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
