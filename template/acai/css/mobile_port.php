<?php include ("common.php") ?>
.sectcardapio {
    background: url('/img/cardapio_port.jpg') no-repeat center;
    background-size: 100%;
}

.sectpedidos {
    background: url('/img/pedidos_port.jpg') no-repeat center;
    background-size: 100%;
}

.tucanofiel .img-container {
    top: 0px;
}

.xs-row {
    height: <?=$xsPortImgHt?>px;
}

.swiper-container.hz {
    width: 100%;
    height: <?=$xsPortImgHt?>px;
}

.sect-slide {
    height: <?=$xsPortImgHt + $navBarHt?>px;
    padding-top: <?=$navBarHt?>px;
}

.sect-site.ht100 {
    height: 100%;
    padding-top: <?=$baseNavHt?>px;
    padding-bottom: <?=$whiteMargin?>px;
}

section.sect-site.tucanofiel {
    padding-top: 0px;
    min-height: initial;
    height: <?=$xsPortImgHt + $tucanoFielHt?>px;
}

.tucanofiel .img-container {
    bottom: <?=$tucanoFielHt?>px;
}