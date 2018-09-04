<?php

// For imports
$optionOne = "./model/Database_class.php";
$optionTwo = "../../model/Database_class.php";
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


class ContatoDAO
{

  /**
  *Insert new record (contact) into database
  *@param $contact Contact object that will insert into database
  *@return true Contact was inserted with successful
  *@return false Fail in to insert a new contact into database
  */
  public function insert(Contato $contact)
  {
    $db = new MySqlDB();

    // Get connection to database
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO tbl_contato(nome,email,senha) VALUES(?,?,?)");
    $stmt->bindParam(1,$contact->name);
    $stmt->bindParam(2,$contact->email);
    $stmt->bindParam(3,$contact->senha);

    // Keep the answer that if record was inserted with successful or not
    $answer = $stmt->execute();

    // Close connection to database
    $db->offConnection();

    // Verify if insert was okay
    if($answer) return true; // Inserted with successful

    // Fail to insert it
    return false;
  }

  /**
  *Delete a record by id into database
  *@param $contactId Contact's id that will be deleted into database
  *@return true Contact was deleted with successful
  *@return false Fail in to delete contact into database
  */
  public function delete($contactId)
  {
    $db = new MySqlDB();

    // Get connection to database
    $conn = $db->getConnection();

    $stmt = $conn->prepare("DELETE FROM tbl_contato WHERE id_contato = ?");
    $stmt->bindParam(1, $contactId);

    // Keep the answer that if record was inserted with successful or not
    $answer = $stmt->execute();

    // Close connection to database
    $db->offConnection();

    // Verify if insert was okay
    if($answer) return true; // Inserted with successful

    // Fail to insert it
    return false;
  }

  /**
  *Update a contact into database
  *@param $contact Contact object that will be insert into database
  *@return true Contact was insert with successful into database
  *@return false Fail in to insert contact into database
  */
  public function update(Contato $contact)
  {
    $db = new MySqlDB();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("UPDATE tbl_contato SET nome = ?, email = ?, senha = ? WHERE id_contato = ?");
    $stmt->bindParam(1, $contact->name);
    $stmt->bindParam(2, $contact->email);
    $stmt->bindParam(3, $contact->senha);
    $stmt->bindParam(4, $contact->contactId);

    // Keep the answer that if record was inserted with successful or not
    $answer = $stmt->execute();

    // Close connection to database
    $db->offConnection();

    // Verify if insert was okay
    if($answer) return true; // Inserted with successful

    // Fail to insert it
    return false;
  }

  /**
  *Get a list with contacts objects existents into database
  *@return Array Array with contacts objects existents into database
  */
  public function getList()
  {
    $db = new MySqlDB();
    $conn = $db->getConnection();

    $contacts = array();

    $rs = $conn->query("SELECT * FROM tbl_contato");

    if ($rs->rowCount() > 0)
    {
      while ($contact = $rs->fetch(PDO::FETCH_OBJ)) {
        $contacts[] = $contact;
      }
    }

    return $contacts;

    $db->offConnection();
  }

  /**
  *Get a existent contact by id
  *@param $contactId Contact's id that will used to search it
  *@return Contato Contact object that was found into database
  */
  public function getContactById($contactId)
  {
    $db = new MySqlDB();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM tbl_contato WHERE id_contato = ?");
    $stmt->bindParam(1,$contactId);
    $stmt->execute();

    // Close connection to database
    $db->offConnection();

    if($stmt->rowCount() > 0)
    {
      while ($contact = $stmt->fetch(PDO::FETCH_OBJ)) {
        return $contact;
      }
    }
  }

}

?>
