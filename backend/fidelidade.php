<?php

header('Content-type: text/plain');

include_once (dirname(__FILE__) . '/secrets.php');
include_once (dirname(__FILE__) . '/simplest-orm/simplestorm.php');

try {
    $input = denc($_REQUEST['data']);
    $func = isset($input['func'])? $input['func']: '';

    switch ($func) {
        case 'busca':
            $dados = buscaClientes($input['reg']);
            break;
        case 'update':
            $dados = updateClientes($input['reg']);
            break;
        default:
            throw new Exception("OPERACAO INVALIDA");
            break;
    }

    $return = array(
        "status" => true,
        "dados"  => $dados
    );
} catch (Exception $e) {
    $return = array(
        "status" => false,
        "msgErro" => $e->getMessage()
    );
}

echo enc($return);

die();

function buscaClientes($ultimo) {
    $conn = Conn::getInstance();
    return $conn->fetchTableData('FIDELIDADE', 'ID', $ultimo, '>');
}

function updateClientes($registros) {
    foreach ($registros as $row) {
        $obj = new TABLE_RECORD("FIDELIDADE", $row);
        $obj->update();
    }

    return true;
}

function enc($data) {
    $data = json_encode($data);
    $data = XORCrypt(gzdeflate($data), SECRETEST);
    $data = base64_encode($data);

    return $data;
}

function denc($data) {
    $data = base64_decode($data);
    if ($data === false)
        throw new Exception("DADOSCORROMPIDOSa");

    $data = gzinflate(XORCrypt($data, SECRETEST));
    if ($data === false)
        throw new Exception("DADOSCORROMPIDOSb");

    $data = json_decode($data, true);
    if ($data === null)
        throw new Exception("DADOSCORROMPIDOSc");

    return $data;
}

function XORCrypt($value, $key) {
    $y = 0;
    $result = '';

    for ($x = 0; $x < strlen($value); $x++) {
        $result .= chr(ord($value{$x}) ^ ord($key{$y}));

        $y++;
        if ($y == strlen($key)) $y = 0;
    }

    return $result;
}