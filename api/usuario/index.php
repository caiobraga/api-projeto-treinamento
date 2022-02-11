<?php
require_once "../../dataModels/usuario.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = [];

$method = $_SERVER['REQUEST_METHOD'];
$email = $_REQUEST['email'] ?? "";
$nome = $_REQUEST['nome'] ?? "";
$urlFoto = $_REQUEST['urlFoto'] ?? "";

$usuario = new usuario;
$usuario->setEmail($email);


if($method == "POST" && $nome !== null ){
    $usuario->setNome($nome);
    $data["usuario"] = $usuario->post();
}

if($method === "GET") {

    $data["usuario"] = $usuario->get();
}

if($method == "PUT" && $nome !== null && $email != "" && $email != null ){

    $usuario->setNome($nome);

    $data["usuario"] = $usuario->put();
}
if($method == "DELETE" && $email != null && $email != ""){
    $data["cidade"] = $cidade->delete();
}



die(json_encode($data));
?>