<?php
  class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function __construct($login = null, $senha = null){
      $this->setDeslogin($login);
      $this->setDessenha($senha);
    }

    public function getIdusuario(){
      return $this->idusuario;
    }

    public function setIdusuario($idusuario){
      $this->idusuario = $idusuario;
    }

    public function getDeslogin(){
      return $this->deslogin;
    }

    public function setDeslogin($deslogin){
      $this->deslogin = $deslogin;
    }

    public function getDessenha(){
      return $this->dessenha;
    }

    public function setDessenha($dessenha){
      $this->dessenha = $dessenha;
    }

    public function getDtcadastro(){
      return $this->dtcadastro;
    }
    public function setDtcadastro($dtcadastro){
      $this->dtcadastro = $dtcadastro;
    }

    public function loadByID($id){
      $sql = new Sql();
      $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
        ":ID"=>$id
      ));

      if(count($results) > 0){
        $row = $results[0];

        $this->setData($results[0]);
      }

    }

    public static function getUsers(){
      $sql = new Sql();

      return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function searchUser($login){
      $sql = new Sql();

      return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
        "SEARCH"=>"%".$login."%"
      ));
    }

    public function login($login, $senha){
      $sql = new Sql();
      $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
        ":LOGIN"=>$login,
        ":SENHA"=>$senha
      ));

      if(count($results) > 0){
        $row = $results[0];

        $this->setData($results[0]);

      } else {
        throw new Exception("Login e/ou senha incorretos");

      }
    }

    public function setData($data){
      $this->setIdusuario($data['idusuario']);
      $this->setDeslogin($data['deslogin']);
      $this->setDessenha($data['dessenha']);
      $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insertUser(){
      $sql = new Sql();

      $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
        "LOGIN"=>$this->getDeslogin(),
        "PASSWORD"=>$this->getDessenha()
      ));

      if(count($results) > 0){
        $this->setData($results[0]);
      } else{
        echo 'Erro ao cadastrar';
      }
    }

    public function update($login, $senha){

      $this->setDeslogin($login);
      $this->setDessenha($senha);

      $sql = new Sql();
      $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
        "LOGIN"=>$this->getDeslogin(),
        "PASSWORD"=>$this->getDessenha(),
        "ID"=>$this->getIdusuario()
      ));
    }

    public function delete(){
      $sql = new Sql();

      $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
        "ID"=>$this->getIdusuario()
      ));

      $this->setIdusuario(null);
      $this->setDeslogin(null);
      $this->setDessenha(null);
      $this->setDtcadastro(null);
    }

    public function __toString(){
      return json_encode(array(
        "idusuario"=> $this->getIdusuario(),
        "deslogin"=> $this->getDeslogin(),
        "dessenha"=> $this->getDessenha(),
        "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
      ));
    }

  }
?>
