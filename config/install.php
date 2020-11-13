<?php

include_once './dbclass.php';
try 
{
  $dbclass = new DBClass(); 
  $connection = $dbclass.getConnection();
  $sql = file_get_contents("data/database.sql"); 
  $connection->exec($sql);
  echo "Banco de Dados e Tabelas criadas com sucesso!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}