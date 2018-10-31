<?php
$pg_title = 'Quem Somos - ' . $pg_name;
$pg_desc = 'A Temc Seguros é especializada nos mais diversos segmentos. Nosso diferencial está no atendimento aos clientes!';
//        $pg_image = $pg_sitekit . 'index.png';
$pg_url = HOME;
require 'tpl/inc/header.php';
?>
<section class="container">
    <div  class="quem_somos content">
        <div class="quem_somos_desc">
            <h1>Quem somos</h1>
            <p class="tagline">A Temc Seguros é especializada nos mais diversos segmentos. Nosso diferencial está no atendimento aos clientes desde a apresentação de soluções adequadas, contratação e administração da apólice. Com a tecnologia e a experiência, atendemos todos os tipos de clientes pessoas físicas e jurídicas em todo o país.</p>
        </div>

        <div class="imagem boxshadow">
            <img src="<?= HOME; ?>/tpl/img/TemcEquipe.jpg"/>
            <div class="clear"></div>
        </div>

    </div> <!-- content -->
</section> <!-- container -->