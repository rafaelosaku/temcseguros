<?php
$pg_title = 'Formulário automóvel - ' . $pg_name;
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

        if($Contato && $Contato['EnviarFormAuto']):
            unset($Contato['EnviarFormAuto']);
            $Contato['Assunto'] = 'Solicitação de cotação de auto/moto/caminhão!';
            $Contato['DestinoNome'] = 'Contato - ' . USERNAME;
            $Contato['DestinoEmail'] = MAILUSER;
            
			
            $SendMail = new FormAuto;
            $SendMail->Enviar($Contato);
            
            if($SendMail->getError()):
                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
            endif;
        endif;
        ?>
        <form name="formAutomovel" action="" method="post" enctype="">
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
                        <span>Informe a seguradora</span>
                        <input class="text renovar" type="text" name="Seguradora" />
                    </label>
                    <label>
                        <span>Informe o bônus anual</span>
                        <input class="text renovar" type="text" name="BonusAnual" />
                    </label>
                    <label>
                        <span>Houve sinistro?</span>
                        <strong>Sim</strong>
                        <input class="renovar" type="radio" name="Sinistro" value="sim" />
                        <strong>Não</strong>
                        <input class="renovar" type="radio" name="Sinistro" value="nao" />
                    </label>
                </div>
                <label>
                    <span>Veículo financiado?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="VeiculoFinanciado" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="VeiculoFinanciado" value="nao" />
                </label>
                <label>
                    <span>Nome completo do segurado</span>
                    <input class="text" type="text" name="NomeSegurado" />
                </label>
                <label>
                    <span>Sexo</span>
                    <strong>Masculino</strong>
                    <input type="radio" name="SexoSegurado" value="masculino" />
                    <strong>Feminino</strong>
                    <input type="radio" name="SexoSegurado" value="feminino" />
                </label>
                <label>
                    <span>Informe a data de nascimento</span>
                    <input type="date" name="DataNascAsseg" />
                </label>
                <label>
                    <span>CPF</span>
                    <input class="text" type="text" name="cpfSegurado" />
                </label>
                <label>
                    <span>Estado civil</span>
                    <input class="text" type="text" name="estadoCivilAsseg" placeholder="Casado, Solteiro ou união estável há mais de 5 anos?" />
                </label>
                <label>
                    <span>Informe o fabricante</span>
                    <input class="text" type="text" name="Fabricante" />
                </label>
                <label>
                    <span>Informe o modelo do veículo</span>
                    <input class="text" type="text" name="ModeloVeiculo" />
                </label>
                <label>
                    <span>Informe o ano do veículo</span>
                    <input class="text" type="text" name="AnoVeiculo" />
                </label>
                <label>
                    <span>Informe o ano do modelo</span>
                    <input class="text" type="text" name="AnoModelo" />
                </label>
                <p>Caso seja necessário consulte a tabela <a href="http://veiculos.fipe.org.br/veiculos.html" target="_blank">fipe</a>.</p>
                <label>
                    <span>Tipo de combustível</span>
                    <strong>Gasolina</strong>
                    <input type="radio" name="combustivel" value="gasolina" />
                    <strong>Álcool</strong>
                    <input type="radio" name="combustivel" value="alcool" />
                    <strong>Disel</strong>
                    <input type="radio" name="combustivel" value="disel"/>
                    <strong>Flex</strong>
                    <input type="radio" name="combustivel" value="flex" />
                </label>
                <label>
                    <span>Veículo 0Km</span>
                    <strong>Sim</strong>
                    <input type="radio" name="veiculo0km" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="veiculo0km" value="nao" />
                </label>
                <label>
                    <span>Placa</span>
                    <input class="text" type="text" name="placa" />
                </label>
                <label>
                    <span>Chassi</span>
                    <input class="text" type="text" name="chassi" />
                </label>
                <label>
                    <span>Possui dispositivo anti-furto?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="antiFurto" onclick="document.formAutomovel.dispositivoAntiFurto.disabled = false" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="antiFurto" onclick="document.formAutomovel.dispositivoAntiFurto.disabled = true" value="nao" />
                    <select name="dispositivoAntiFurto"  style="display: block" disabled="disabled" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Orinal de fábrica">Orinal de fábrica</option>
                        <option value="Rastreador">Rastreador</option>
                        <option value="Bloqueador">Bloqueador</option>
                        <option value="DNA Security">DNA Security</option>
                        <option value="Trava carneiro">Trava carneiro</option>
                        <option value="Alarme">Alarme</option>
                        <option value="Outros">Outros</option>
                    </select>
                </label>       
                <label>
                    <span>Veículo é blindado?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="blindado" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="blindado" value="nao" />
                </label>
                <label>
                    <span>Veículo possui kit gás?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="kitgas" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="kitgas" value="nao" />
                </label>
                <label>
                    <span>Informe seu CEP</span>
                    <input class="text" type="text" name="cep" />
                </label>
                <label>
                    <span>Possui filhos ou residentes com idade inferior a 25 anos?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="filhosResidentes" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="filhosResidentes" value="nao" />
                </label>
                <label><span>Informe a utilização do veículo</span>
                    <select name="utilizacao" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="Lazer">Lazer</option>
                        <option value="Trabalho">Trabalho</option>
                        <option value="Trabalho e lazer">Trabalho e lazer</option>
                        <option value="Profissional com visitas a clientes">Profissional com visitas a clientes</option>
                    </select>
                </label>
                <label>
                    <span>Possui garagem fechada na residência?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="garagemResidencia" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="garagemResidencia" value="nao" />
                </label>
                <label>
                    <span>Possui garagem fechada no trabalho?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="garagemTrabalho" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="garagemTrabalho" value="nao" />
                </label> 
                <!--                Espaço para inserir mais informações após solucionar dúvidas-->
                <label>
                    <span>Deseja cobertura de vidros?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="coberturaVidros" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="coberturaVidros" value="nao" />
                </label>
                <label>
                    <span>Deseja assistência de guincho?</span>
                    <strong>Sim</strong>
                    <input type="radio" name="assistGincho" onclick="document.formAutomovel.assistTipo.disabled = false" value="sim" />
                    <strong>Não</strong>
                    <input type="radio" name="assistGincho" onclick="document.formAutomovel.assistTipo.disabled = true" value="nao" />
                    <select name="assistTipo"  style="display: block" disabled="disabled" >
                        <option selected disabled value="">Selecione uma opção</option>
                        <option value="100 Km">100 Km</option>
                        <option value="200 Km">200 Km</option>
                        <option value="400 Km">400 Km</option>
                        <option value="600 Km">600 Km</option>
                        <option value="800 Km">800 Km</option>
                        <option value="1000 Km">1000 Km</option>
                        <option value="Ilimitado">Ilimitado</option>
                    </select>
                </label>
                <label>
                    <span>O segurado é o principal condutor?</span>
                    <strong>Sim</strong>
                    <input class="CondutorPrincipal" type="radio" name="CondutorPrincipal" value="sim" checked="checked" />
                    <strong>Não</strong>
                    <input class="CondutorPrincipal" type="radio" name="CondutorPrincipal" value="nao" />
                    <strong>Condutor indeterminado</strong>
                    <input class="CondutorPrincipal" type="radio" name="CondutorPrincipal" value="indeterminado" />
                </label>
                <div class="condutor1">
                    <h2>Informe os dados do condutor:</h2>
                    <span>Nome completo do principal condutor</span>
                    <input class="text CondutorPrincipalNome" type="text" name="CondutorPrincipalNome" />
                    <label>
                        <span>Sexo</span>
                        <strong>Masculino</strong>
                        <input class="CondutorPrincipalNome" type="radio" name="sexoCondutorPrincipal" value="masculino" />
                        <strong>Feminino</strong>
                        <input class="CondutorPrincipalNome" type="radio" name="sexoCondutorPrincipal" value="feminino" />
                        <label for="dataNasc">Informe a data de nascimento</label>
                        <input class="CondutorPrincipalNome" type="date" name="dataNascCondutorPrincipal" />
                        <span>CPF</span>
                        <input class="text CondutorPrincipalNome" type="text" name="cpfCondutorPrincipal"  />
                        <span>Estado civil</span>
                        <input class="text CondutorPrincipalNome" type="text" name="estadoCivilCondutorPrincipal" placeholder="Casado, Solteiro ou união estável há mais de 5 anos?" />
                    </label>
                </div>
                <label>
                    <h2>Informações para contato</h2>
                    <span>Nome:</span>
                    <input class="text" type="text" name="RemetenteNome" required/>
                </label>
                <label>
                    <span>E-mail:</span>
                    <input class="text" type="text" name="RemetenteEmail" required/>
                </label>
                <label class="phone">
                    <span>Telefone fixo:</span>
                    <input type="text" name="RemetenteFixo" />
                </label>
                <label class="phone">
                    <span>Telefone celular:</span>
                    <input type="text" name="RemetenteCelular" required/>
                </label>
            </fieldset>
            <input class="btn btn-blue radius5" type="submit" name="EnviarFormAuto" value="Solicitar cotação"/>                
        </form>
    </div>
</section>