<?php
$pg_title = 'Contato - ' . $pg_name;
$pg_desc = 'A Temc Seguros é especializada nos mais diversos segmentos. Nosso diferencial está no atendimento aos clientes!';
//        $pg_image = $pg_sitekit . 'index.png';
$pg_url = HOME . '/form/contato';
require 'tpl/inc/header.php';
?>
<section class="container" id="contato">
    <div class="content formulario">
        <h1 class="fontzero"><?= $pg_title; ?></h1>
        <?php
        $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if($Contato && $Contato['EnviarFormContato']):
            unset($Contato['EnviarFormContato']);
            $Contato['Assunto'] = 'Contato via site!';
            $Contato['DestinoNome'] = 'Contato - ' . USERNAME;
            $Contato['DestinoEmail'] = MAILUSER;
            
            $SendMail = new Email;
            $SendMail->Enviar($Contato);
            
            if($SendMail->getError()):
                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
            endif;
        endif;
        ?>
        <form name="form-vida" action="#contato" method="post" enctype="">
            <fieldset>
                <label>
                    <span>Nome:</span>
                    <input type="text" name="RemetenteNome" required/>
                </label>
                <label>
                    <span>E-mail:</span>
                    <input type="text" name="RemetenteEmail" required/>
                </label>
                <label class="phone">
                    <span>Telefone fixo:</span>
                    <input type="text" name="RemetenteFixo" />
                </label>
                <label class="phone">
                    <span>Telefone celular:</span>
                    <input type="text" name="RemetenteCelular" required/>
                </label>
                <label>
                    <span>Mensagem:</span>
                    <textarea rows="10" name="Mensagem" required></textarea>
                </label>
            </fieldset>
            <input class="btn btn-blue radius5" type="submit" name="EnviarFormContato" value="Enviar"/>
        </form>
    </div>
</section>
