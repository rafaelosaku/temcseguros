<?php
$pg_title = '404 - Desculpe, não encontrado o conteúdo relacionado.';
$pg_desc = 'Você está vendo agora a página 404 pois não encontramos conteúdo relacionado à <b>' . $setUrl . '</b>!';
//        $pg_image = $pg_sitekit . '404.png';
$pg_url = HOME;
require 'tpl/inc/header.php';
?>
<section class="container">
    <header  class="content not_found">
        <h1><?= $pg_title; ?></h1>
        <p class="tagline">
            Opsss!!! não foi possível encontar a página solicitada!
        </p>
    </header> <!-- content -->
</section> <!-- container -->