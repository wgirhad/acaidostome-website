<?php include ("common.php") ?>

.sect-site {
    min-height: 482px;
}

.sect-site.minht100 {
    min-height: 100%;
}

.row.large-gap {
    margin-left: -<?=$gapFres?>px;
    margin-right: -<?=$gapFres?>px;
}

.large-gap .col-md-6 {
    padding-left: <?=$gapFres?>px;
    padding-right: <?=$gapFres?>px;
}

.sect-site {
    padding-top: <?=$whiteMargin?>px;
}

.sect-site h1 {
    padding-top: 60px;
}

.acai-navbar {
    position: fixed;
    bottom: 0;
}

.top-navbar {
    height: <?=$whiteMargin?>px;
    background: #fff;
}

.bottom-navbar,
.top-navbar {
    height: <?=$whiteMargin?>px;
    background: #fff;
}

section.sect-site {
    padding-bottom: <?=$totalFooter?>px;
}

.acai-navbar .row-button {
    display: none;
}

.acai-navbar .logo-container {
    top: 4px;
    height: <?=$logoHt?>px;
}

.acai-navbar ul {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translate(0, -50%);
    display: block !important;
}

.acai-navbar ul li {
    display: inline;
    border-right: 2px solid #fff;
    padding: 0 8px;
}

.acai-navbar ul li:last-child {
    padding-right: 0;
    border-right: none;
}

.sect-site .img-container>img {
    display: block;
    width: 100%;
}

.cont-cadastro {
    padding: 24px;
    margin-bottom: <?=$totalFooter?>px;
}

.cont-cadastro .form-group {
    margin-bottom: 30px;
}

.cont-cadastro .form-group:last-child {
    margin-bottom: 0;
}

.ht100, .ht100desk {
    height: 100%;
}

.maffix {
    z-index: 9;
    width: 240px;
    left: 24px;
}

.maffix h2 {
    color: <?=$color1?>;
    text-align: center;
    border-bottom: 2px solid <?=$color1?>;
    font-weight: 600;
}

.card-box {
    height: 102px;
    margin-bottom: 30px;
}
.card-box img {
    width: 160px;
    height: 102px;
    display: block;
    float: left;
    cursor: pointer;
}

.card-box .card-label {
    float: left;
    width: 80px;
    padding-left: 5px;

}

.card-label span {
    display: block;
    text-align: right;
    line-height: 1;
}

.card-label>span {
    color: <?=$color1?>;
    font-size: 16px;
    margin-top: 20px;
    margin-bottom: 5px;
}

.card-label .card-label-box {
    border: 2px solid <?=$color2?>;
    color: <?=$color2?>;
    font-size: 20px;
    padding: 2px 5px;
}

.maffix:not(.affix) {
    position: absolute;
}

.maffix.affix {
    top: 24px;
}

section.sect-site.tucanofiel {
    padding-bottom: <?=$baseNavHt?>px;
}

.tucanofiel .img-container {
    bottom: <?=$baseNavHt + $tucanoFielHt?>px;
}

.tucanofiel footer {
    bottom: <?=$baseNavHt?>px;
}