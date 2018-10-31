<?php
$pg_title = 'Formulário DPEM - ' . $pg_name;
$pg_desc = 'Formulário para preenchimento do cliente';
//        $pg_image = $pg_sitekit . '404.png';
$pg_url = HOME;
require 'tpl/inc/header.php';
?>
<section class="container" id="contato">
    <div class="content formulario">
        <h1 class="fontzero">Formulário DPEM</h1>
        <?php
        $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if($Contato && $Contato['EnviarForm']):
            unset($Contato['EnviarForm']);
            $Contato['Assunto'] = 'Solicitção de cotação - ' . $pg_title;
            $Contato['DestinoNome'] = 'Contato - ' . USERNAME;
            $Contato['DestinoEmail'] = MAILUSER;
            
            $SendMail = new FormDpem;
            $SendMail->Enviar($Contato);
            
            if($SendMail->getError()):
                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
            endif;
        endif;
        ?>
        <form name="formDPEM" action="#contato" method="post" enctype="">
            <fieldset>
                <label>
                    <span>Nome completo do segurado</span>
                    <input class="text" type="text" name="NomeSegurado" />
                </label>
                <label class="box box-small">
                    <span>CPF/CNPJ</span>
                    <input class="text" type="text" name="cpf_cnpj" />
                </label>
                <label class="box box-small">
                    <span>RG</span>
                    <input class="text" type="text" name="RG" />
                </label>
                <label class="box box-small">
                    <span>Órgão emissor</span>
                    <input class="text" type="text" name="OrgaoEmissor" />
                </label>
                <label class="box box-small last">
                    <span>Data de emissão</span>
                    <input class="text" type="date" name="DataEmissao" />
                </label>
                
                <label class="box box-xlarge">
                    <span>Endereço</span>
                    <input class="text" type="text" name="Rua" required/>
                </label>
                <label class="box box-small last">
                    <span>Número</span>
                    <input class="text" type="text" name="Numero" required/>
                </label>
                <label class="box box-small">
                    <span>Bairro</span>
                    <input class="text" type="text" name="Bairro" required/>
                </label>
                <label class="box box-small">
                    <span>Cidade</span>
                    <input class="text" type="text" name="Cidade" required/>
                </label>
                <label class="box box-small">
                    <span>UF</span>
                    <input class="text" type="text" name="UF" required/>
                </label>
                <label class="box box-small last">
                    <span>CEP</span>
                    <input class="text" type="text" name="CEP" required/>
                </label>
                <label class="box box-large">
                    <span>Bilhete anterior nº</span>
                    <input class="text" type="text" name="BilheteAnterior" />
                </label>
                <label class="box box-large last">
                    <span>Vencido em:</span>
                    <input class="text" type="date" name="VencidoEm" />
                </label>
                <label class="box box-large">
                    <span>Nome da embarcação</span>
                    <input class="text" type="text" name="NomeEmbarcacao" />
                </label>
                <label class="box box-large last">
                    <span>Número de inscrição da embarcação</span>
                    <input class="text" type="text" name="EmbarcacaoInscricao" />
                </label>
                <label class="box box-large">
                    <span>Número de tripulantes</span>
                    <input class="text" type="text" name="nTripulantes" />
                </label>
                <label class="box box-large last">
                    <span>Número de passageiros</span>
                    <input class="text" type="text" name="nPassageiros" />
                </label>
                <label class="box box-large">
                    <span>Propulsão</span>
                    <select name="Propulsao" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Motor">Motor</option>
                        <option value="Vela">Vela</option>
                        <option value="Motor/Vela">Motor/Vela</option>
                        <option value="Sem propulsão">Sem propulsão</option>
                    </select>
                </label>
                <label class="box box-large last">
                    <span>Tipo de embarcação</span>
                    <select name="tipoEmbarcacao" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Balsa">Balsa</option>
                        <option value="Balcaca">Balcaca</option>
                        <option value="Bote">Bote</option>
                        <option value="Canoa">Canoa</option>
                        <option value="Catamara">Catamara</option>
                        <option value="Chata">Chata</option>
                        <option value="Draga">Draga</option>
                        <option value="Empurrador">Empurrador</option>
                        <option value="Escuna">Escuna</option>
                        <option value="Flutuante">Flutuante</option>
                        <option value="Graneleiro">Graneleiro</option>
                        <option value="Hovercraft">Hovercraft</option>
                        <option value="Jangada">Jangada</option>
                        <option value="Jet-ski">Jet-ski</option>
                        <option value="Lancha">Lancha</option>
                        <option value="Moto aquática">Moto aquática</option>
                        <option value="Navio">Navio</option>
                        <option value="Oil-oil">Oil-oil</option>
                        <option value="Pesqueiro">Pesqueiro</option>
                        <option value="Rebocador">Rebocador</option>
                        <option value="Ro-ro">Ro-ro</option>
                        <option value="Saveiro">Saveiro</option>
                        <option value="Traineira">Traineira</option>
                        <option value="Veleiro">Veleiro</option>
                        <option value="Bote/baleeira">Bote/baleeira</option>
                    </select>
                </label>
                <label class="box box-large">
                    <span>Uso</span>
                    <select name="Uso" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Comercial">Comercial</option>
                        <option value=""Não Comercial>Não Comercial</option>
                    </select>
                </label>
                <div class="clear"></div>
            </fieldset>
			<fieldset>
			<legend>Dados para contato</legend>
                <label>
                    <span>Nome:</span>
                    <input type="text" name="RemetenteNome" required />
                </label>
                <label>
                    <span>E-mail:</span>
                    <input type="text" name="RemetenteEmail" required />
                </label>
                <label class="phone">
                    <span>Telefone fixo:</span>
                    <input type="text" name="RemetenteFixo" />
                </label>
                <label class="phone">
                    <span>Telefone celular:</span>
                    <input type="text" name="RemetenteCelular" required />
                </label>
            </fieldset>
            <input class="btn btn-blue radius5" type="submit" name="EnviarForm" value="Solicitar cotação"/>
        </form>
    </div>
</section>