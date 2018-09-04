<?php include_once("./controller/contato_controller.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contatos - CRUD</title>
    <script src="./view/js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="./view/css/contatos_view.css">
  </head>
  <body>

    <script>
      $(document).ready(function(){

        // Open modal when click on "add new contact"
        $("#btnNewContact").click(function(){ // Button to open modal

          // Show modal
          $("#modal_container").fadeIn(500);

          // Load modal page on current page
          $.ajax({
            type:"POST",
            url:"./view/contatos/add_contato_view.php",
            async: true,
            success: function(data){
              $("#modal").html(data);
            }
          });
        });
        // _________________________________________________________

        // Delete contact when it click on delete button
        $(".actionButton").click(function(){

          var id = $(this).data("id"); // Get contact's id
          var action = $(this).data("action"); // Get action (delete, insert or update)

          if (action == "delete")
          {
            // Get user's answer
            var answer = confirm("Deseja realmente excluir este contato ?");

            // Check if answer is to delete it
            if (answer)// It's to delete it
            {
              // Send to router to do the action
              $.ajax({
                type:"POST",
                url:"./router.php?controller=contato&action="+action+"&id="+id,
                async:true,
                success: function(data){
                  location.reload(); // Refresh current page
                }
              });
            }
          }
          else
          {

            // Show modal
            $("#modal_container").fadeIn(500);

            // Load modal page on current page to update the contact
            $.ajax({
              type:"POST",
              url:"./view/contatos/add_contato_view.php",
              data:{contactId:id},
              async: true,
              success: function(data){
                $("#modal").html(data);
              }
            });
          }

        });
        // _________________________________________________________




      });

    </script>

    <!-- Modal container (full screen) -->
    <div id="modal_container">
      <!-- Modal -->
      <div id="modal">

      </div>
    </div>


    <!-- ********************* Main container *********************** -->
    <div id="main">

      <header>
        Contatos
      </header>

      <!-- ************************ GRID **************************** -->
      <div id="dataGrid">

        <!-- ********** Tabs (name, email and phone) ****************** -->

        <!-- Just labels -->
        <div class="field_box">

          <!-- ******** LABEL *********** -->
          <!-- Name (Label) -->
          <div class="tab_label">
            Nome
          </div>

          <!-- Email (Label)-->
          <div class="tab_label">
            e-mail
          </div>

          <!-- Phone (Label) -->
          <div class="tab_label">
            Senha
          </div>

          <!-- Action tab (Label)-->
          <div id="action_tab_label">
            Excluir/Editar
          </div>

        </div>
        <!-- ¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨ -->

        <?php

          // Get all contacts existents
          $contacts = Contato::getContactsList();

          // Show each contact into grid
          foreach($contacts as $contact)
          {
          ?>
              <!-- Just fields to will be fill with contacts data -->
              <div class="field_box">

                <!-- ******** FIELD *********** -->
                <!-- Name (Fild with contacts data) -->
                <div class="tab_field">
                  <?=$contact->nome?>
                </div>

                <!-- Email (Fild with contacts data) -->
                <div class="tab_field">
                  <?=$contact->email?>
                </div>

                <!-- Phone (Fild with contacts data) -->
                <div class="tab_field">
                  <?=$contact->senha?>
                </div>

                <!-- Delete (button)-->
                <div class="action_tab">
                  <a class="actionButton" data-id="<?=$contact->id_contato?>" data-action="delete" href="#">
                    <img title="Deletar contato" alt="deletar este contato" src="./view/pictures/icons/delete256px.png">
                  </a>
                </div>

                <!-- Update (button)-->
                <div class="action_tab">
                  <a class="actionButton" data-id="<?=$contact->id_contato?>" data-action="update" href="#">
                    <img title="Editar contato" alt="editar este contato" src="./view/pictures/icons/update256px.png">
                  </a>
                </div>

                <!-- ¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨ -->
              </div>
          <?php
          }

        ?>

      </div>
      <!-- __________________________________________________________ -->

      <!-- New contact button area -->
      <div id="new_contact_button_area">
        <!-- Add new contact -->
        <input id="btnNewContact" title="Adicionar um novo contato" type="button" name="btnNewContact" value="+">
      </div>
      <!-- __________________________________________________________ -->

    </div>
    <!-- __________________________________________________________ -->

  </body>
</html>
