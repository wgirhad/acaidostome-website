<!doctype html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Açaí dos Tomé</title>

    <meta name='viewport' content="width=device-width, initial-scale=1" />
    <link rel='stylesheet' href='{{base_path}}/css/fonts/stylesheet.css' />
    <link rel='stylesheet' href='/lib/bootstrap/css/bootstrap.css' />
    <link rel='stylesheet' href='/lib/font-awesome/css/font-awesome.min.css' />
    <link rel='stylesheet' href='/lib/sweetalert2/sweetalert2.min.css' />
    <link rel='stylesheet' href='/lib/swiper/css/swiper.min.css' />
    <link rel='stylesheet' href='{{base_path}}/css/mainstyle.php' />
    <link rel='stylesheet' media="(max-width: 991px)" href='{{base_path}}/css/mobile.php' />
    <link rel='stylesheet' media="(max-width: 991px) and (orientation:landscape)" href='{{base_path}}/css/mobile_land.php' />
    <link rel='stylesheet' media="(max-width: 991px) and (orientation:portrait)" href='{{base_path}}/css/mobile_port.php' />
    <link rel='stylesheet' media="(min-width: 992px)" href='{{base_path}}/css/desktop.php' />
    <link rel="stylesheet" href="/lib/fancybox/jquery.fancybox-1.3.4.css" />


    <script src='/lib/jquery/jquery.min.js'></script>
    <script src='/lib/bootstrap/js/bootstrap.min.js'></script>
    <script src='/lib/sweetalert2/sweetalert2.min.js'></script>
    <script src="/lib/fancybox/jquery.fancybox-1.3.4.js"></script>
    <script src='/lib/formwizard/formwizard.min.js' defer></script>
    <script src='/lib/parallaxjs/parallax.min.js' defer></script>
    <script src='{{base_path}}/js/script.js?v=180306' defer></script>
</head>
<body>
    {{hide_menu_start}}
    <div class="acai-navbar">
        <!--<div class="top-navbar"></div>-->
        <div class="mid-navbar">
            <div class="container">
                <div class="row-button">
                    <button type="button" class="btn btnrx">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="logo-container">
                    <a href="/"><img src="/img/logo.png" alt="Açaí dos Tomé"></a>
                </div>
                <ul class="list-unstyled" style="display:none">
                    <li><a href="/loja/">NOSSA LOJA</a></li>
                    <li><a href="/cardapio/">CARDÁPIO</a></li>
                    <li><a href="/pedidos/">PEDIDO</a></li>
                    <li><a href="/cadastro/">TUCANO FIEL</a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-navbar"></div>
    </div>
    {{hide_menu_end}}
    {{page_content}}
</body>
</html>