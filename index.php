<?php 


require_once("config.php");

/*

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

echo "<br>--------------------------<br>";


$aluno = new Usuario();

$aluno->setDeslogin("aluno");
$aluno->setDessenha("@1un0");

$aluno->insert();

echo "$aluno";


echo "<br>--------------------------<br>";


$aluno = new Usuario("aluno", "@lun0");

$aluno->insert();

echo "$aluno";


*/


/*echo "<br>--------------------------<br>";
ALTERAR USUARIO
 
echo "update<br>";


$usuario = new Usuario();

$usuario->loadById(9);

$usuario->update("professor","senha");

echo "$usuario";


*/


$usuario = new Usuario();

$usuario->loadById(7);

$usuario->delete();

echo $usuario;

 ?>