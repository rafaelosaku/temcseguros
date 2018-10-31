<?php
$pg_title = 'Formulário náutico - ' . $pg_name;
$pg_desc = 'Formulário para preenchimento de dados para solicitação do cliente';
//        $pg_image = $pg_sitekit . 'index.png';
$pg_url = HOME;
require 'tpl/inc/header.php';
?>
<section class="container">
    <div class="content formulario">
        <h1 class="fontzero"><?= $pg_title; ?></h1>
        <?php
        $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($Contato && $Contato['EnviarForm']):
            unset($Contato['EnviarForm']);
            $Contato['Assunto'] = 'Solicidação de cotação naútico';
            $Contato['DestinoNome'] = 'Contato - ' . USERNAME;
            $Contato['DestinoEmail'] = MAILUSER;

            $SendMail = new FormNautico;
            $SendMail->Enviar($Contato);

            if ($SendMail->getError()):
                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
            endif;
        endif;
        ?>
        <form name="formNautico" action="" method="post" enctype="">
            <fieldset class="form-elements">
                <label>
                    <span>Tipo de embarcação</span>
                    <select name="Embarcacao"  >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Lancha">Lancha</option>
                        <option value="Veleiro">Veleiro</option>
                    </select>
                </label>
                <label>
                    <span>Nome completo do segurado</span>
                    <input class="text" type="text" name="NomeSegurado"  />
                </label>
                <label>
                    <span>Tipo de pessoa</span>
                    <strong>Física</strong>
                    <input type="radio" name="TipoPessoa" value="fisica" />
                    <strong>Jurídica</strong>
                    <input type="radio" name="TipoPessoa" value="juridica" />
                </label>
                <label>
                    <span>CPF/CNPJ</span>
                    <input class="text" type="text" name="CPF_CNPJ"  />
                </label>
                <label>
                    <span>Nome da embarcação</span>
                    <input class="text" type="text" name="NomeEmbarcacao"  />
                </label>
                <label>
                    <span>Informe o ano de construção</span>
                    <input class="text" type="text" name="AnoConstrucao"  />
                </label>
                <label>
                    <span>0 Milhas</span>
                    <strong>Sim</strong>
                    <input type="radio" name="ZeroMilha" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="ZeroMilha" value="nao" />
                </label>
                <label>
                    <span>Tipo de material de construção</span>
                    <select name="TipoMaterial" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Fibra de vidro">Fibra de vidro</option>
                        <option value="Aço">Aço</option>
                        <option value="Aluminio">Alumínio</option>
                    </select>
                </label>
                <label>
                    <span>Comprimento (pés)</span>
                    <input class="text" type="text" name="Comprimtento" placeholder="1 a 100"  />
                </label>
                <label>
                    <span>Valor da embarcação</span>
                    <input class="text" type="text" name="ValorEmbarcação" placeholder="5.000,00 a 15.000.000,00"  />
                </label>
                <label>
                    <span>Limite de navegação</span>
                    <select name="LimiteNavegacao" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Litoral brasileiro">Litoral brasileiro</option>
                        <option value="Costa leste da América do Sul">Costa leste da Améria do Sul</option>
                        <option value="Costa leste da América do Norte e Central">Costa leste da Améria do Norte e Central</option>
                        <option value="Âmbito mundial">Âmbito mundial</option>
                    </select>
                </label>
                <label>
                    <span>Desejo renovar meu seguro?</span>
                    <strong>Sim</strong>
                    <input class="RenovarSeguro" type="radio" name="RenovarSeguro" value="sim" />
                    <strong>Não</strong>
                    <input class="RenovarSeguro" type="radio" name="RenovarSeguro" value="nao" />
                </label>
                <div class="RenovarSeguroBloco">
                    <label>
                        <span>Há quanto tempo possui o seguro?</span>
                        <select class="renovar" name="TempoDeSeguro" >
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
                    <span>CEP</span>
                    <input class="text" type="text" name="CEP" required  />
                </label>
                <label>
                    <span>Estado</span>
                    <input class="text" type="text" name="UF" required  />
                </label>
                <label>
                    <span>Município</span>
                    <input class="text" type="text" name="Municipio" required />
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
    </div>
</section>