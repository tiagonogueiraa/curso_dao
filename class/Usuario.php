<?php 


class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;



    public function getIdusuario()
    {
        return $this->idusuario;
    }


    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;


    }


    public function getDeslogin()
    {
        return $this->deslogin;
    }


    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        
    }


    public function getDessenha()
    {
        return $this->dessenha;
    }


    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        
    }

    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }


    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        
    }


    public function loadById($id){

    	$sql = new Sql();

    	$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

           ":ID"=>$id
       ));

    	if (count($results) > 0){// verifica se existe

    		$this->setData($results[0]);

    	}
    }

//static pois não precisa instanciar
    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function __toString(){

    	return json_encode(array(
    		"idusuario"=>$this->getIdusuario(),
    		"deslogin"=>$this->getDeslogin(),
    		"dessenha"=>$this->getDessenha(),
    		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
    	));
    }


    public function login($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(

            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if (count($results) > 0){// verifica se existe

         $this->setData($results[0]);

     } else {

        throw new Exception(" Login ou senha inválidos");

    }

}

public function setData($data){

    $this->setIdusuario($data['idusuario']);
    $this->setDeslogin($data['deslogin']);
    $this->setDessenha($data['dessenha']);
    $this->setDtcadastro(new DateTime($data['dtcadastro']));

}


public function insert(){

    $sql = new Sql();

        //tored procedures são rotinas definidas no banco de dados, identificadas por um nome pelo qual podem ser invocadas. Um procedimento desses pode executar uma série de instruções, receber parâmetros e retornar valores.
    //por ser mysql usa o CALL e parenteses para as varíaveis
    $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
        ':LOGIN'=>$this->getDeslogin(),
        ':PASSWORD'=>$this->getDessenha()    
    ));

    if (count($results) > 0) {

        $this->setData($results[0]);
    }
}


    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDessenha(),
                ':ID'=>$this->getIdusuario()
        ));
    }

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());

    }


    public function __construct($login = "", $password = ""){

        $this->setDeslogin($login);
        $this->setDessenha($password);

    }
}

?>