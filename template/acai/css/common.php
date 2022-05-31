<?php

$color1 = "#683061";
$color2 = "#f5811e";
$logoHt = 100;
$rowImgHt = 320;
$whiteMargin = 36;
$navBarHt = 80;
$gapFres = 60;
$tucanoFielHt = 80;
$baseNavHt = $whiteMargin + $navBarHt;
$totalFooter = $whiteMargin + $baseNavHt;
$xsPortImgHt = 240;

$base_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
foreach (range(1, 4) as $x) {
    $base_url = substr($base_url, 0, strrpos($base_url, '/'));
}


header("Content-type: text/css");
