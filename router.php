<?php

  include_once("./controller/contato_controller.php");

  // Get controller to send data
  $controller = $_GET["controller"];

  // Get action to make some action
  $action = $_GET["action"];

  // Choose controller
  switch ($controller)
  {
    case 'contato':

      // Choose action
      switch($action)
      {
        case 'add': // Add new contact
          $contato = new Contato();

          $contato->name = $_POST["txtName"];
          $contato->email = $_POST["txtEmail"];
          $contato->senha = $_POST["txtPassWord"];

          // Add new contact
          Contato::addContact($contato);
        break;

        case 'update': // Update an existent contact
          $contato = new Contato();

          $contato->contactId = $_GET["id"];
          $contato->name = $_POST["txtName"];
          $contato->email = $_POST["txtEmail"];
          $contato->senha = $_POST["txtPassWord"];

          // Update an existent contact
          Contato::updateContact($contato);
        break;

        case 'delete': // Delete one contact
            Contato::deleteContact($_GET["id"]);
        break;

      }
      break;
  }


?>
