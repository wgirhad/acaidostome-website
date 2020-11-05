<?php include ("common.php") ?>
.sect-text {
    padding-top: <?=$whiteMargin?>px;
    padding-bottom: <?=$whiteMargin?>px;
}

.sect-text .txt-block {
    padding-top: <?=$whiteMargin?>px;
}

.xs-row {
    margin-left: -15px;
    margin-right: -15px;
    width: initial;
    display: block;
}

.acai-navbar,
.mid-navbar {
    position: fixed;
    top: 0;
    height: initial;
}

.acai-navbar .logo-container {
    top: 0;
    height: <?=$baseNavHt?>px;
}

.acai-navbar .row-button {
    height: <?=$navBarHt?>px;
}

.acai-navbar ul {
    margin: 8px -8px;
}

.acai-navbar ul li a {
    display: block;
    margin: 0;
    padding: 8px;
    width: 100%;
}

.acai-navbar ul li:hover a {
    background: #fff;
    color: <?=$color1?>;
    text-decoration: none;
}

.sect-site .xs-row .img-container {
    display: inline-block;
    width: 100%;
    position: relative;
}

.sect-site .xs-row .img-container:after {
    padding-top: 56.25%;
    display: block;
    content: '';
}

.sect-site .xs-row .img-container>img {
    display: block;
    max-width: 100%;
    height: auto;
}

img.bottom {
    bottom: 0;
    position: absolute;
}

.cont-cadastro {
    padding: 8px;
}

.maffix {
    display: none!important;
}

.tucanofiel footer {
    bottom: 0px;
}