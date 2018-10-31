<?php
$pg_title = 'TEMC Seguros - teste de slide';
$pg_desc = 'Testando novos slides';
//        $pg_image = $pg_sitekit . 'index.png';
$pg_url = HOME;
require 'tpl/inc/header.php';
?>
<section class="container box_carrossel j_touch">
    <div class="slide_controll">
        <h1 class="fontzero"><?= $pg_name; ?></h1>
        <div class="slide_nav back"><</div>
        <div class="slide_nav go">></div>
    </div>

    <ul class="carrossel">
        <li>
            <picture class="item"><!-- Seguro Automóvel -->
                <source media="(min-width: 1600px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=2000&h=600"/>
                <source media="(min-width: 1440px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=2000&h=600"/>
                <source media="(min-width: 1360px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=1600&h=500"/>
                <source media="(min-width: 1280px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=1360&h=400"/>
                <source media="(min-width: 1024px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=1360&h=450"/>
                <source media="(min-width: 960px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=1280&h=600"/>
                <source media="(min-width: 768px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=960&h=260"/>
                <source media="(min-width: 480px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=800&h=300"/>
                <source media="(min-width: 1px)" srcset="tim.php?src=tpl/img/slides/05.jpg&w=480&h=380"/>  
                <img src="<?= HOME; ?>/tpl/img/slides/05.jpg" title="Seguro Automóvel" alt="[Seguro Automóvel]"/>
            </picture>
            <div class="slide_desc">
                <h1>Seguro Automóvel</h1>
                <p class="tagline">Seu carro sempre protegido.</p>
            </div>

        </li>
        <li>
            <picture class="item"><!-- Seguro de Vida -->
                <source media="(min-width: 1600px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=2000&h=600"/>
                <source media="(min-width: 1440px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=2000&h=600"/>
                <source media="(min-width: 1360px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=1600&h=500"/>
                <source media="(min-width: 1280px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=1360&h=400"/>
                <source media="(min-width: 1024px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=1360&h=450"/>
                <source media="(min-width: 960px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=1280&h=600"/>
                <source media="(min-width: 768px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=960&h=260"/>
                <source media="(min-width: 480px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=800&h=300"/>
                <source media="(min-width: 1px)" srcset="tim.php?src=tpl/img/slides/06.jpg&w=480&h=380"/>  
                <img src="<?= HOME; ?>/tpl/img/slides/06.jpg" title="Seguro de Vida" alt="[Seguro de Vida]"/>
            </picture>
            <div class="slide_desc">
                <h1>Seguro de Vida</h1>
                <p class="tagline">Proteja sua Família!</p>
            </div>
        </li>
        <li>
            <picture class="item"><!-- Seguros Empresariais -->
                <source media="(min-width: 1600px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=2000&h=600"/>
                <source media="(min-width: 1440px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=2000&h=600"/>
                <source media="(min-width: 1360px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=1600&h=500"/>
                <source media="(min-width: 1280px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=1360&h=400"/>
                <source media="(min-width: 1024px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=1360&h=450"/>
                <source media="(min-width: 960px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=1280&h=600"/>
                <source media="(min-width: 768px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=960&h=260"/>
                <source media="(min-width: 480px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=800&h=300"/>
                <source media="(min-width: 1px)" srcset="tim.php?src=tpl/img/slides/07.jpg&w=480&h=380"/>  
                <img src="<?= HOME; ?>/tpl/img/slides/07.jpg" title="Seguros Empresariais" alt="[Seguros Empresariais]"/>
            </picture>
            <div class="slide_desc">
                <h1>Seguros Empresariais</h1>
                <p class="tagline"></p>
            </div>
        </li>
        <li class="item">
            <picture class="item"><!-- Consórcios -->
                <source media="(min-width: 1600px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=2000&h=600"/>
                <source media="(min-width: 1440px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=1440&h=600"/>
                <source media="(min-width: 1360px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=1600&h=500"/>
                <source media="(min-width: 1280px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=1360&h=400"/>
                <source media="(min-width: 1024px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=1360&h=450"/>
                <source media="(min-width: 960px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=1280&h=600"/>
                <source media="(min-width: 768px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=960&h=260"/>
                <source media="(min-width: 480px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=800&h=300"/>
                <source media="(min-width: 1px)" srcset="tim.php?src=tpl/img/slides/08.jpg&w=480&h=380"/>  
                <img src="<?= HOME; ?>/tpl/img/slides/08.jpg" title="Consórcios" alt="[Consórcios]"/>
            </picture>
            <div class="slide_desc">
                <h1>Consórcios</h1>
                <p class="tagline"></p>
            </div>
        </li>
    </ul>
    <div class="clear"></div>
</section>