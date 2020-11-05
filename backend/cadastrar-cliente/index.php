<?php
header('Content-type: application/json');
include_once (dirname(dirname(__FILE__)) . '/simplest-orm/simplestorm.php');

try {
    $input = $_POST;

    // validar dados de input
    _validate($input);

    $obj = new TABLE_RECORD("FIDELIDADE", $input);
    $return = $obj->insert();
    $return['dados'] = $obj->ID;
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
    if (!isset($input["TIPO"])) throw new Exception("Falha de entrada");
    if (!isset($input["DOC"])) throw new Exception("Falha de entrada");

    if (strpos('I/C/F', $input["TIPO"]) === false) throw new Exception("Tipo de cadastro inválido");
    $input["DOC"] = snm($input["DOC"]);
    if (strlen($input["DOC"]) != 11) throw new Exception("CPF inválido");

    $c = Conn::getInstance();
    $t = $c->fetchTableDataF("FIDELIDADE", $c->assembleFilter(array(
        "DOC"  => $input["DOC"],
        "TIPO" => $input["TIPO"]
    )));

    if (count($t)) throw new Exception("Usuário já cadastrado");
    for ($x = 1; $x <= 8; $x++) {
        if (isset($input["DOC_$x"])) {
            $input["DOC_$x"] = snm($input["DOC_$x"]);
        }
    }

    if (isset($input["CEP"])) $input["CEP"] = snm($input["CEP"]);
    $input["DESDE"] = date("Y-m-d H:i:s");

    $input["ATIVO"] = "S";
    $input["PONTOS"] = 0;
    $input["SALDO"] = 0;
}