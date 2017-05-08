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

  $usersList = Usuario::getUsers();

  echo json_encode($usersList);

?>
