<?php

/**
Class to connect to MySql DataBase
*/
class MySqlDB
{

  //Attributes
  private $server = "localhost";
  private $database = "db_contato";
  private $user = "root";
  private $password = "";
  private $connection;

  /**
  *Get a connection ot database
  *@return PDO Connection object to database
  */
  public function getConnection()
  {
    try
    {
      // Create a connection to database
      $connection = new PDO("mysql:host={$this->server};dbname={$this->database}",$this->user,$this->password);

      //Set attributes to show error messages
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $connection;
    }catch(PDOException $e)
    {
      echo("ERRRO:".$e->getMessage());
    }
  }

  public function offConnection(){
    $connection = null;
  }

}

?>
