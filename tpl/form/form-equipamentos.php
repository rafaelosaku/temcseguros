<?php
$pg_title = 'Formulário Equipamentos - ' . $pg_name;
$pg_desc = 'Formulário para preenchimento de dados para solicitação do cliente';
//        $pg_image = $pg_sitekit . '404.png';
$pg_url = HOME;
require_once 'tpl/inc/header.php';
?>
<section class="container">
    <div  class="content formulario">
        <h1 class="fontzero"><?= $pg_title; ?></h1>
        <?php
        $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if($Contato && $Contato['EnviarForm']):
            unset($Contato['EnviarForm']);
            $Contato['Assunto'] = 'Solicidação de cotação de equipamentos';
            $Contato['DestinoNome'] = 'Contato - ' . USERNAME;
            $Contato['DestinoEmail'] = MAILUSER;
            
            $SendMail = new FormEquipamento;
            $SendMail->Enviar($Contato);
            
            if($SendMail->getError()):
                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
            endif;
        endif;
        ?>
        <form name="formEquipamentos" action="" method="post" enctype="">
            <fieldset>
                <label>
                    <span>Renovar meu seguro</span>
                    <strong>Sim</strong>
                    <input class="RenovarSeguro" type="radio" name="RenovarSeguro" value="sim" />
                    <strong>Não</strong>
                    <input class="RenovarSeguro" type="radio" name="RenovarSeguro" value="nao" />
                </label>
                <div class="RenovarSeguroBloco">
                    <label>
                        <span>Há quanto tempo possui o seguro?</span>
                        <select class="renovar" name="TempoDeSeguro"  style="display: block" >
                            <option selected disabled value="">Selecione uma opção</option>
                            <option value="1 ano">1 ano</option>
                            <option value="2 anos">2 anos</option>
                            <option value="3 anos">3 anos</option>
                            <option value="4 anos">4 anos</option>
                            <option value="5 anos">5 anos</option>
                            <option value="Mais de 5 anos">Mais de 5 anos</option>
                        </select>
                    </label>
                    <label>
                        <span>Houve sinistro tendo sido o seguro acionado?</span>
                        <strong>Sim</strong>
                        <input class="renovar" type="radio" name="SeguroAcionado" value="sim" />
                        <strong>Não</strong>
                        <input class="renovar" type="radio" name="SeguroAcionado" value="nao" />
                    </label>
                </div>
                <label>
                    <span>Equipamento financiado?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="EquipamentoFinanciado" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="EquipamentoFinanciado" value="nao" />
                </label>
                <label>
                    <span>Informe a atividade que o equipamento é utilizado</span>
                    <input  type="text" name="AtividadeEquipamento" placeholder="Ex.: Agrícola, Pacuária, etc." />
                </label>
                <label>
                    <span>O equipamento será locado a terceiros?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="EquipamentoLocado" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="EquipamentoLocado" value="nao" />
                </label>
                <label>
                    <span>O equipamento é acoplado a algum veículo?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="EquipamentoAcoplado" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="EquipamentoAcoplado" value="nao" />
                </label>
                <label>
                    <span>Nome completo do segurado</span>
                    <input  type="text" name="NomeSegurado"  />
                </label>
                <label>
                    <span>CPF ou CNPJ</span>
                    <input  type="text" name="CPF_CNPJ"  />
                </label>
                <label>
                    <span>Informe o fabricante</span>
                    <input  type="text" name="InfoFabricante"  />
                </label>
                <label>
                    <span>Informe a Marca</span>
                    <input  type="text" name="Marca"  />
                </label>
                <label>
                    <span>Informe o ano de fabricação</span>
                    <input  type="text" name="AnoFab"  />
                </label>
                <label>
                    <span>Equipamento novo?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="EquipamentoNovo" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="EquipamentoNovo" value="nao" />
                </label>
                <label>
                    <span>Chassi</span>
                    <input  type="text" name="Chassi"  />
                </label>
                <label>
                    <span>Modelo</span>
                    <input  type="text" name="Modelo"  />
                </label>
                <label>
                    <span>Informe seu CEP</span>
                    <input  type="text" name="CEP"  />
                </label>
                <label>
                    <span>Qual o valor do equipamento:</span>
                    <input  type="text" name="ValorEquipamento"  />
                </label>
                <label>
                    <span>Deseja contratar cobertura para roubo:</span>
                    <strong>Sim</strong>
                    <input type="radio" name="CoberturaRoubo" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="CoberturaRoubo" value="nao" />
                </label>
                <label>
                    <span>Operação do equipamento em proximidade de água:</span>
                    <strong>Sim</strong>
                    <input type="radio" name="ProximoAgua" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="ProximoAgua" value="nao" />
                </label> 
                <label>
                    <h2>Informações para contato</h2>
                    <span>Nome:</span>
                    <input  type="text" name="RemetenteNome" required />
                </label>
                <label>
                    <span>E-mail:</span>
                    <input  type="text" name="RemetenteEmail" required />
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
    </div> <!-- content -->
</section> <!-- container -->
