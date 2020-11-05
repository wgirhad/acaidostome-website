(function(){

$(".acai-navbar .row-button button").click(_switchMenu);
$(".sectcardapio").click(abreCardapio);
$(".sectpedidos").click(abrePedidos);

function _switchMenu() {
    $(".acai-navbar ul").slideToggle("fast");
}

function abreCardapio() {
    var _url = "https://www.yumpu.com/en/embed/view/P79a31yZ2mVRDkFE";
    window.open(_url);
}

function abrePedidos() {
    var _url = "https://www.facebook.com/acaidos.tome/";
    window.open(_url);
}

})();