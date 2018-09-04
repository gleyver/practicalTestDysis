<?php include_once("../../controller/contato_controller.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contatos - CRUD</title>
    <link type="text/css" rel="stylesheet" href="./view/css/add_contato_view.css">
    <script src="./view/js/jquery.js"></script>
    <script src="./view/js/useful.js"></script>
  </head>
  <body>

    <script>
      $(document).ready(function(){

        // Default action
        var action = "add";

        // Default contact's id
        var id = "-1";

        <?php
          // Verify if it's to update a contact
          if (isset($_POST["contactId"]))// It's to update a contact
          {
              // Get contact's id
              $contactId = $_POST["contactId"];

              // Get existent contact's data
              $contact = Contato::getContactById($contactId);
          ?>

              // Change action to "update" contact
              action = "update";

              // Set contact's id to update it
              id = "<?=$contactId?>";

              // Fill field with contact's name on value
              $("#txtName").attr("value","<?=$contact->nome?>");

              // Fill field with contact's email on value
              $("#txtEmail").attr("value","<?=$contact->email?>");

              // Fill field with contact's phone on value
              $("#txtPassWord").attr("value","<?=$contact->senha?>");

              // Change button's label to "Atualizar"
              $("#btnAddNewContact").attr("value","Atualizar");
          <?php
          }
        ?>

        // Close modal when click on "cancelar"
        $("#btnCloseModal").click(function(){
          $("#modal_container").slideToggle(1000);
        });
        // __________________________________><

        // Active it when form is submitted
        $("#frmAddNewContact").submit(function(e){

          // Remove default submit
          e.preventDefault();

          // Pass data to another page (router.php)
          $.ajax({
            type:"POST",
            url:"./router.php?controller=contato&action="+action+"&id="+id,
            data: new FormData($("#frmAddNewContact")[0]),
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            success:function(data){
              $("#modal_container").slideToggle(1000); // Close modal
              setTimeout(function(){location.reload()},1000); // Delay to reload the page
            }

          });
        });

      });
    </script>

    <!-- Main box -->
    <div id="main_box">

      <form id="frmAddNewContact" name="frmAddNewContact" action="./contatos_view.php" method="POST">

        <!-- Text field area (Name)-->
        <div class="text_field_area">

          <!-- Text field's label (name) -->
          <div class="label">
            name
          </div>

          <!-- Text field (name) -->
          <div class="text_field">
            <input id="txtName" onkeypress="return lockType('number', event)" type="text" required name="txtName" value="" maxlength="100">
          </div>

        </div>

        <!-- Text field area (Email)-->
        <div class="text_field_area">

          <!-- Text field's label (email) -->
          <div class="label">
            e-mail
          </div>

          <!-- Text field (email) -->
          <div class="text_field">
            <input id="txtEmail" type="email" required name="txtEmail" value="" maxlength="100">
          </div>

        </div>

        <!-- Text field area (Phone)-->
        <div class="text_field_area">

          <!-- Text field's label (email) -->
          <div class="label">
            senha
          </div>

          <!-- Text field (email) -->
          <div class="text_field">
            <input id="txtPassWord"  type="password" required name="txtPassWord" value="" maxlength="180">
          </div>

        </div>

        <!-- Button area -->
        <div id="button_area">
          <!-- close modal -->
          <input id="btnCloseModal" type="button" name="btnCloseModal" value="Cancelar">
          <!-- add new contact button -->
          <input id="btnAddNewContact" type="submit" name="btnAddNewContact" value="Adicionar">
        </div>

      </form>

    </div>

  </body>
</html>
