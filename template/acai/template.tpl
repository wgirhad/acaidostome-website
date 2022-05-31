<!doctype html>
<html{{overflow}}>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Açaí dos Tomé</title>

    <meta name='viewport' content="width=device-width, initial-scale=1" />
    <link rel='stylesheet' href='{{template_path}}/css/fonts/stylesheet.css' />
    <link rel='stylesheet' href='{{base_path}}/lib/bootstrap/css/bootstrap.css' />
    <link rel='stylesheet' href='{{base_path}}/lib/font-awesome/css/font-awesome.min.css' />
    <link rel='stylesheet' href='{{base_path}}/lib/sweetalert2/sweetalert2.min.css' />
    <link rel='stylesheet' href='{{base_path}}/lib/swiper/css/swiper.min.css' />
    <link rel='stylesheet' href='{{template_path}}/css/mainstyle.php' />
    <link rel='stylesheet' media="(max-width: 991px)" href='{{template_path}}/css/mobile.php' />
    <link rel='stylesheet' media="(max-width: 991px) and (orientation:landscape)" href='{{template_path}}/css/mobile_land.php' />
    <link rel='stylesheet' media="(max-width: 991px) and (orientation:portrait)" href='{{template_path}}/css/mobile_port.php' />
    <link rel='stylesheet' media="(min-width: 992px)" href='{{template_path}}/css/desktop.php' />
    <link rel="stylesheet" href="{{base_path}}/lib/fancybox/jquery.fancybox-1.3.4.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.2.0/css/flag-icons.min.css" />


    <script src='{{base_path}}/lib/jquery/jquery.min.js'></script>
    <script src='{{base_path}}/lib/bootstrap/js/bootstrap.min.js'></script>
    <script src='{{base_path}}/lib/sweetalert2/sweetalert2.min.js'></script>
    <script src="{{base_path}}/lib/fancybox/jquery.fancybox-1.3.4.js"></script>
    <script src='{{base_path}}/lib/formwizard/formwizard.min.js' defer></script>
    <script src='{{base_path}}/lib/parallaxjs/parallax.min.js' defer></script>
    <script src='{{template_path}}/js/script.js?v=180306' defer></script>
</head>
<body{{overflow}}>
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
                    <a href="{{base_path}}/"><img src="{{base_path}}/img/logo.png" alt="Açaí dos Tomé"></a>
                </div>
                <ul class="list-unstyled" style="display:none">
                    <li><a href="{{base_path}}/loja/">NOSSA LOJA</a></li>
                    <li><a href="{{base_path}}/cardapio/">CARDÁPIO</a></li>
                    <li><a href="{{base_path}}/pedidos/">PEDIDO</a></li>
                    <li><a href="{{base_path}}/cadastro/">TUCANO FIEL</a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-navbar"></div>
    </div>
    {{hide_menu_end}}
    {{page_content}}
</body>
</html>
