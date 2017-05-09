<?php
  require_once 'config.php';

  /*
  $sql = new Sql();

  $usuarios = $sql->select("SELECT * FROM tb_usuarios");

  echo json_encode($usuarios);
  */

  /* Carrega um usuario
  $usuario = new Usuario();

  $usuario->loadByID(1);

  echo $usuario;

  */

  /* Lista todos os usuarios
  $usersList = Usuario::getUsers();

  echo json_encode($usersList);
  */

  /* procura usuarios
  $search = Usuario::searchUser("Olivier");
  echo json_encode($search);
  */

  /* autentica usuario
  $usuario = new Usuario();
  $usuario->login("Olivier", "storm5310");
  echo $usuario;
  */

  /* inserindo usuario
  $aluno = new Usuario('aluno', '@luno');


  $aluno->insertUser();

  echo $aluno;
  */

  $usuario = new Usuario();
  $usuario->setIdusuario(10);
  $usuario->update('teste', 'teste');


?>
