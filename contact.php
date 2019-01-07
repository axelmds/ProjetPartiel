<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Votre profils</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
  </head>
  <body>

    <?php include("header.php"); ?>
    <?php include("nav.php"); ?>`

     
     <h2 class="title_contact">Nous contacter</h2>
    

      <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">
        <div class="row row1">
          <label class="required" for="name">Votre pseudo :</label><br />
          <input class="button_contact" class="input" name="name" type="text" size="30" placeholder="Votre pseudo" /><br />
        </div>

        <div class="row row2">
          <label class="required" for="email">Votre email :</label><br />
          <input class="button_contact" class="input" name="email" type="text" size="30"
        placeholder="Votre email" /><br />
        </div>

        <div class="row row3">
          <label class="required" for="message">Votre message :</label><br />
          <input type="textarea" class="button_contact" class="input" name="message" rows="40" cols="40" size="10"  placeholder="Votre message"></textarea><br />
        </div>

          <input class="submit_button" type="submit" value="Envoyer" style="height: 40px" />
      </form>

    

    <?php include('footer.php'); ?>
  </body>
</html>
