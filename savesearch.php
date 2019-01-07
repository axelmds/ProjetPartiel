<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=kelkdo', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));



?>
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
    <?php include("nav.php"); ?>

    <div class="block block-savesearch">
      <div class="inner">
        <div class="retourprofil">
          <a href="profil.php?id=16">
            Retour profil
          </a>
        </div>

        <div class="title-savesearch">
          <h2>Mes recherches</h2>
        </div>

        <div class="wrapper">

          <div class="savesearch savesearch1">
            <a href="trouverlekdosavesearch.php">Maman</a>
          </div>
          <div class="savesearch savesearch2">
            <a href="trouverlekdosavesearch.php">Papa</a>
          </div>
          <div class="savesearch savesearch3">
            <a href="trouverlekdosavesearch.php">Georges</a>
          </div>
          <div class="savesearch savesearch4">
            <a href="trouverlekdosavesearch.php">Tony</a>
          </div>
          <div class="savesearch savesearch5">
            <a href="trouverlekdosavesearch.php">Anaïs</a>
          </div>
          <div class="free savesearch6">
            <a href="trouverlekdo.php">Libre</a>
          </div>
          <div class="free savesearch7">
            <a href="trouverlekdo.php">Libre</a>
          </div>
          <div class="free savesearch8">
            <a href="trouverlekdo.php">Libre</a>
          </div>
          <div class="free savesearch9">
            <a href="trouverlekdo.php">Libre</a>
          </div>
          <div class="free savesearch10">
            <a href="trouverlekdo.php">Libre</a>
          </div>

        </div>

      </div>
    </div>

    <?php include("footer.php"); ?>
  </body>
</html>
