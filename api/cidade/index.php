<?php
require_once "../../dataModels/cidade.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = [];

$method = $_SERVER['REQUEST_METHOD'];
$codCidade = $_REQUEST['codCidade'] ?? 0;
$nome = $_REQUEST['nome'] ?? "";

$cidade = new Cidade;
$cidade->setCodCidade($codCidade);


if($method == "POST" && $nome !== null ){
    $cidade->setNome($nome);
    $data["cidade"] = $cidade->create();
}

if($method === "GET") {

    $data["cidade"] = $cidade->read();
}

if($method == "PUT" && $nome !== null && $codCidade > 0 ){

    $cidade->setNome($nome);

    $data["cidade"] = $cidade->update();
}
if($method == "DELETE" && $codCidade > 0){
    $data["cidade"] = $cidade->delete();
}



die(json_encode($data));
?>