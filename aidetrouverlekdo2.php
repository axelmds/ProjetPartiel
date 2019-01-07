<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test Formulaire</title>
  </head>
  <body>
    <?php
      if ($_POST['find-kdo'] == 'oui')
      //if (isset($_POST['find-kdo'])) // si la case je cherche un cadeau est cochée
      {
        echo '<p>Bonjour '.htmlspecialchars($_POST['prenom']).', tu es sur le bon site pour trouver le kdo qu\'il te faut !</p>';
        //htmlspecialchars empeche l'utilisateur de rentrer du code html 'FAILLE XSS'
      } else{
        echo '<p>Bonjour '.htmlspecialchars($_POST['prenom']).' !</p>';
      }
     ?>
  </body>
</html>
