<title><?= $pg_title; ?></title>
<meta name="description" content="<?= $pg_desc; ?>"/>
<meta name="robots" content="index, follow"/> 

<link rel="author" href="https://plus.google.com/<?= $pg_google_author; ?>"/>
<link rel="publisher" href="https://plus.google.com/<?= $pg_google_publisher; ?>"/>
<link rel="canonical" href="<?= $pg_url; ?>"/>

<meta itemprop="name" content="<?= $pg_site; ?>"/>
<meta itemprop="description" content="<?= $pg_desc; ?>"/>
<meta itemprop="image" content="<?= $pg_image; ?>"/>
<meta itemprop="url" content="<?= $pg_url; ?>"/>
<meta itemprop="author" content="Rafael Osaku"/>

<meta property="og:type" content="article" />
<meta property="og:title" content="<?= $pg_title; ?>" />
<meta property="og:description" content="<?= $pg_desc; ?>" />
<meta property="og:image" content="<?= $pg_image; ?>" />
<meta property="og:url" content="<?= $pg_url; ?>" />
<meta property="og:site_name" content="<?= $pg_name; ?>" />
<meta property="og:locale" content="pt_BR" />

<meta property="og:app_id" content="<?= $pg_fb_app; ?>" />
<meta property="article:author" content="https://www.facebook.com/<?= $pg_fb_author; ?>" />
<meta property="article:publisher" content="https://www.facebook.com/<?= $pg_fb_page; ?>" />

<script>

    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {

            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-76742353-1', 'auto');

    ga('send', 'pageview');

</script>

</head>
<body>
    <header class="main_header container">
        <div class="content"> <!-- CONTENT HEADER -->
            <div class="main_header_logo">
                <h1>
                    <a title="<?= $pg_title; ?>" href="<?= HOME; ?>" alt="[<?= $pg_title; ?>]" >
                        <img src="<?= HOME; ?>/tpl/img/main_logo.png"/><?= $pg_title; ?>
                    </a>
                </h1>
            </div>
            <div class="mobile_action active"></div>

            <ul class="main_header_nav">
                <?php require 'tpl/inc/main_nav.php'; ?>
            </ul><!-- MAIN_NAV -->
            <div class="clear"></div>    
        </div> <!-- /CONTENT HEADER -->
    </header>
    <!-- CONTEÚDO PRINCIPAL -->
    <main> 