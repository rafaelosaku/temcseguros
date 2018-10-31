<?php
$pg_title = 'Aluguel - ' . $pg_name;
$pg_desc = 'A Temc Seguros é especializada nos mais diversos segmentos. Nosso diferencial está no atendimento aos clientes!';
//        $pg_image = $pg_sitekit . 'index.png';
$pg_url = HOME;
require 'tpl/inc/header.php';
?>
<section class="container">
    <div  class="produtos content">
        <div class="produtos_desc">
            <h1>Aluguel</h1>
            <div class="imagem boxshadow">
                <img src="<?= HOME; ?>/tpl/img/para-voce/aluguel.jpg"/>
            </div>
            <p class="tagline">A Temc Seguros é especializada nos mais diversos segmentos. Nosso diferencial está no atendimento aos clientes desde a apresentação de soluções adequadas, contratação e administração da apólice. Com a tecnologia e a experiência, atendemos todos os tipos de clientes pessoas físicas e jurídicas em todo o país.</p>
           
        </div>


        <div class="form_prod">
            <h1 class="section_title ">FAÇA JÁ A COTAÇÃO <b>DO SEU SEGURO</b>!</h1>
            <?php
            $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($Contato && $Contato['EnviarFormContato']):
                unset($Contato['EnviarFormContato']);
                $Contato['Assunto'] = 'Solicitação de cotação! (Aluguel)';
                $Contato['DestinoNome'] = 'Contato - ' . USERNAME;
                $Contato['DestinoEmail'] = MAILUSER;

                $SendMail = new Email;
                $SendMail->Enviar($Contato);

                if ($SendMail->getError()):
                    WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
                endif;
            endif;
            ?>
            <form name="form-vida" action="#contato" method="post" enctype="">
                <fieldset>
                    <label>
                        <input class="form-control" type="text" name="RemetenteNome" placeholder="Nome:" required/>
                    </label>
                    <label>
                        <input class="form-control" type="text" name="RemetenteEmail" placeholder="E-mail:" required/>
                    </label>
                    <label class="phone">
                        <input class="form-control" type="text" name="RemetenteCelular" placeholder="Telefone:" required/>
                    </label>
                    <label>
                        <textarea class="form-control" rows="3" name="Mensagem" placeholder="Mensagem:" required></textarea>
                    </label>
                </fieldset>
                <input class="btn btn-yellow radius5" type="submit" name="EnviarFormContato" value="SOLICITE UM CONTATO!"/>
            </form>
        </div><!--Form-cot-->
<div class="clear"></div>
    </div> <!-- content -->
</section> <!-- container -->
<div class="clear"></div>