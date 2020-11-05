<?php
header('Content-type: application/json');

include_once (dirname(dirname(__FILE__)) . '/simplest-orm/simplestorm.php');

try {
    $input = $_POST;

    // validar dados de input
    _validate($input);

    $c = Conn::getInstance();

    $obj = $c->fetchTableDataF("FIDELIDADE", $c->assembleFilter(array(
        "ID"    => $input["COD"],
        "DOC"   => $input["DOC"],
        "ATIVO" => "S"
    )));

    if (count($obj) > 0) {
        $return = array(
            "status" => true,
            "dados" => $obj[0]
        );
    } else {
        throw new Exception("Código de compra ou CPF incorretos");
    }
} catch (Exception $e) {
    $return = array(
        "status" => false,
        "msgErro" => $e->getMessage()
    );
}

echo json_encode($return);

function snm($text) {
    return preg_replace('/[^0-9]/', '', $text);
}

function _validate(&$input) {
    if (!isset($input["COD"])) throw new Exception("Falha de entrada");
    if (!isset($input["DOC"])) throw new Exception("Falha de entrada");

    $input["COD"] = (int) $input["COD"];
    $input["DOC"] = snm($input["DOC"]);
}