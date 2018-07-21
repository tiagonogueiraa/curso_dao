<?php 


require_once("config.php");



$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");


echo json_encode($usuarios);

echo "<br>-----------------------<br>";
//carrega um usuario
$root = new Usuario();


$root->loadById(2);

echo $root;

echo "<br>--------------------------<br>";
//chamando metodo estatico
$lista = Usuario::getList();

echo json_encode($lista);


echo "<br>--------------------------<br>";

//carrega uma lista de usuarios buscando pelo login

$search = Usuario::search("te");

echo json_encode($search);


echo "<br>--------------------------<br>";


//carrega um usuário usando o login e a senha

$usuario = new Usuario();
$usuario->login("userteste","123456");

echo $usuario;



 ?>