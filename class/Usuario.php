<?php
  class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

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

        $this->setIdusuario($row['idusuario']);
        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new DateTime($row['dtcadastro']));
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
