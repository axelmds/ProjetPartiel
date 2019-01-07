<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=kelkdo', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(isset($_GET['id']) AND $_GET['id'] > 2)
{
  $getid = intval($_GET['id']);
  $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // MISE EN FORME
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

    <?php
    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
    {
    ?>
    <div class="block block-profil">
      <div class="inner">

        <div class="titleprofil">
          <img class="pdp" src="images/profil/pp.png" alt="Photo de profil">
          <h2 class="pseudo"><?php echo $userinfo['pseudo']; ?></h2>
          <p class="mailuser"><?php echo $userinfo['mail']; ?></p>
        </div>

        <div class="optionprofil">

          <div class="my myinfos">
            <div class="backgroundimg">
              <img src="images/profil/femme.png" alt="Profil">
            </div>
            <a href="editionprofil.php">Editer mon profil</a>
          </div>

          <div class="my myideas">
            <div class="backgroundimg">
              <img src="images/profil/gift.png" alt="Kdos">
            </div>
            <a href="#">Mes Kdo favoris</a>
          </div>

          <div class="my myadvices">
            <div class="backgroundimg">
              <img src="images/profil/stars.gif" alt="Avis">
            </div>
            <a href="#">Mes avis</a>
          </div>

          <div class="my mysearch">
            <div class="backgroundimg">
              <img src="images/profil/logok.jpg" alt="Recherches">
            </div>
            <a href="savesearch.php">Mes recherches</a>
          </div>

        </div>

        <div class="deconnect">
          <a href="deconnexion.php">Se déconnecter</a>
        </div>


    </div>
    <?php
    }
    ?>

      </div>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>
<?php
}
 ?>
