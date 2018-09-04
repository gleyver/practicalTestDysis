<?php

  // For imports
  $optionOne = "./model/contatoDAO_class.php";
  $optionTwo = "../../model/contatoDAO_class.php";
  // -----------------------------------------

  // Verify which include needs to do
  if(file_exists($optionOne) && is_readable($optionOne))
  {
    include_once($optionOne);
  }
  else
  {
    include_once($optionTwo);
  }

class Contato
{

  //Attributes
  public $contactId;
  public $name;
  public $email;
  public $senha;
  // -----------><

  /**
  *Add new contact
  */
  public static function addContact(Contato $contato)
  {
    $contatoDAO = new ContatoDAO();

    return $contatoDAO->insert($contato) ? true : false;
  }

  /**
  *Update an existent contact
  */
  public static function updateContact(Contato $updatedContact)
  {
    $contatoDAO = new ContatoDAO();

    return $contatoDAO->update($updatedContact) ? true : false;
  }

  /**
  *Delete an existent contact
  */
  public static function deleteContact($contactId)
  {
    $contatoDAO = new ContatoDAO();

    return $contatoDAO->delete($contactId) ? true : false;
  }

  /**
  *Get a list with all contacts existents
  */
  public static function getContactsList()
  {
    $contatoDAO = new ContatoDAO();

    return $contatoDAO->getList();
  }

  /**
  * Get one contact by id
  */
  public static function getContactById($contactId)
  {
    $contatoDAO = new ContatoDAO();

    return $contatoDAO->getContactById($contactId);
  }


}

?>
