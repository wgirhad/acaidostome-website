<?php include ("common.php") ?>

html, body {
    height: 100%;
    width: 100%;
}

body {
    overflow-x: hidden;
    background-color: #fff;
}

.whtmrgplc {
    width: 100%;
    height: <?=$whiteMargin?>px;
    display: block;
    margin: 0;
    padding: 0;
}

.sect-site {
    position: relative;
}

.sectloja {
    background: url('/img/loja.jpg') no-repeat right bottom;
    background-size: cover;
    width: 100%;
    height: 100%;
}

.sectcardapio {
    background: url('/img/cardapio.jpg') no-repeat right bottom;
    background-size: cover;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.sectpedidos {
    background: url('/img/pedidos.jpg') no-repeat right bottom;
    background-size: cover;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.minht100 {
    min-height: 100%;
}

h1 {
    color: <?=$color1?>;
}

.acai-navbar {
    width: 100%;
    z-index: 10;
}

.mid-navbar {
    background-color: <?=$color1?>;
    height: <?=$navBarHt?>px;
    width: 100%;
}

.acai-navbar .container {
    position: relative;
    height: 100%;
}

.acai-navbar .logo-container {
    position: absolute;
    text-align: center;
    left: 50%;
    transform: translate(-50%, 0);
}

.acai-navbar img {
    max-height: 100%;
}

.acai-navbar ul a {
    color: #fff;
}

.acai-navbar .row-button .btn {
    margin-top: 40px;
    transform: translate(0, -50%);
}

.btnrx, .btnor {
    background: none;
    color: #fff;
    border: 2px solid #fff;
    border-radius: 0;
}

.btnrx:hover,
.btnrx:active,
.btnrx.active {
    background: #fff;
    color: <?=$color1?>;
    text-decoration: none;
}

.btnor:hover,
.btnor:active,
.btnor.active {
    background: #fff;
    color: <?=$color2?>;
    text-decoration: none;
}

.pointer {
    cursor: pointer;
}

.xs-row {
    margin: 0;
    padding: 0;
    width: 100%;
    display: inline-block;
}
.xs-row .img-container {
    width: 100%;
    height: 100%;
}

.xs-row .img-container img {
    width: 100%;
}

.sect-site p {
    font-size: 16px;
    font-weight: 200;
}

.sect-site .pads {
    padding-left: 60px;
    padding-right: 60px;
}

.sect-site .pads:first-child {
    padding-left: 15px;
}

.sect-site .pads:last-child {
    padding-right: 15px;
}

.sect-site .xs-row .img-container {
    overflow: hidden
}

.break-after {
    -webkit-column-break-after: always;
                   break-after: always;
}

.tucanofiel .img-container {
    position: absolute;
    text-align: center;
    overflow: hidden;
    width: 100%;
    top: <?=$whiteMargin?>px;
}

.tucanofiel footer {
    background-color: <?=$color2?>;
    height: <?=$tucanoFielHt?>px;
    width: 100%;
    position: absolute;
}

.tucanofiel footer .flex {
    height: 100%;
    align-items: center;
}

.tucanofiel footer .container {
    height: 100%;
}

.sejefiel {
    flex-grow: 1;
    text-align: right;
    font-size: 22px;
    color: #fff;
}

.cont-cadastro {
    background-color: <?=$color2?>;
}

.cont-cadastro label {
    color: white;
}

.wt {
    color: white;
}

.swiper-container {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    background-size: cover;
    background-repeat: no-repeat;
    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
}

.strong {
    font-weight: bold;
}

.wtarea {
    padding: 16px;
    color: black;
    background: white;
}

.relative {
    position: relative;
}

.flex {
    display: flex;
}

@media (min-width: 768px) and (max-width: 991px) {
    .container-sm {
        width: 750px;
    }
}