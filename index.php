<?php
require './_app/Config.inc.php';
?>
<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="http://schema.org/Article">
    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?= HOME; ?>/tpl/img/icon/favicon.ico" />
        <link rel="stylesheet" href="<?= HOME; ?>/tpl/css/boot.css" />
        <link rel="stylesheet" href="<?= HOME; ?>/tpl/css/style-temc.css" />
        <link rel="stylesheet" href="<?= HOME; ?>/tpl/css/carrossel.css" />
        <link rel="stylesheet" href="<?= HOME; ?>/_cdn/shadowbox/shadowbox.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="uptec" content="https://www.upinside.com.br/s/RafaelOsaku">
        <meta name="theme-color" content="#003366">
        <meta name="apple-mobile-web-app-status-bar-style" content="#003366">
        <meta name="msapplication-navbutton-color" content="#003366">
        <!--[if lt IE 9]>
            <script src="_cdn/html5shiv.js"></script>
        <![endif]-->
        <script src="<?= HOME; ?>/_cdn/picturefill.min.js"></script>

        <?php
        $url[1] = (empty($url[1]) ? null : $url[1]);

        if (file_exists('tpl/' . $url['0'] . '.php')):
            require 'tpl/' . $url['0'] . '.php';
        elseif (file_exists('tpl/' . $url['0'] . '/' . $url['1'] . '.php')):
            require 'tpl/' . $url['0'] . '/' . $url['1'] . '.php';
        else:
            require 'tpl/404.php';
        endif;
        ?>
    </main> 
    <!-- /CONTEÚDO PRINCIPAL -->

    <!-- FOOTER PRINCIPAL -->
    <?php
    require './tpl/inc/footer.php';
    ?>
    <script src="<?= HOME; ?>/_cdn/jquery-2.1.4.min.js"></script>
    <script src="<?= HOME; ?>/_cdn/jquery.js"></script>
    <script src="<?= HOME; ?>/_cdn/shadowbox/shadowbox.js"></script>
    <script src="<?= HOME; ?>/_cdn/jquery-mobile/jquery.mobile.custom.js"></script>
    <script src="<?= HOME; ?>/_cdn/temc.js"></script>
    
    <script>
        $(function () {
            $('.debug').each(function () {
                $(this).after('<p style="color: #fff; background: #333; padding: 10px">' + $(this).width() + 'px</p>');
            });
        });
    </script>
</body>
</html>