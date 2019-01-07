<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=kelkdo', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(isset($_SESSION['id']))
{
  $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  $newpseudo = htmlspecialchars($_POST['newpseudo']);
  $newmail = htmlspecialchars($_POST['newmail']);
  $mdp1n = sha1($_POST['newmdp1']);
  $mdp2n = sha1($_POST['newmdp2']);

  if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) // si le champ est isset, qu'il n'est pas vide et différent du pseudo actuel
  {
    $reqnewpseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
    $reqnewpseudo->execute(array($newpseudo));
    $newpseudoexist = $reqnewpseudo->rowCount();
    if($newpseudoexist == 0)
    {
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
      if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
      {
        if(filter_var($newmail, FILTER_VALIDATE_EMAIL))
        {
          $reqnewmail = $bdd->prepare('SELECT * FROM membres WHERE mail = ?');
          $reqnewmail->execute(array($newmail));
          $newmailexist = $reqnewmail->rowCount();
          if($newmailexist == 0)
          {
            $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
            if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']) AND $_POST['newmdp1'] == $_POST['newmdp2'])
            {
              $insertmdp = $bdd->prepare("UPDATE membres SET mdp = ? WHERE id = ?");
              $insertmdp->execute(array($mdp1n, $_SESSION['id']));
              header('Location: profil.php?id='.$_SESSION['id']);
            }
            else
            {
              $erreurnewmdp = "Vos deux mots de passe ne correspondent pas";
            }
          }
          else
          {
            $erreurnewmail = "Ce mail existe déjà !";
          }
        }
      }
    }
    else
    {
      $erreurnewpseudo = "Ce pseudo est déjà prit !";
    }
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // MISE EN FORME
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Votre profil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
  </head>
  <body>

    <?php include("header.php"); ?>
    <?php include("nav.php"); ?>

   <div class="block block-formedit">
    <div class="inner">
      <div class="editprofil">
          <div class="titre-editprofil">
            <h2>Modifier votre profil</h2>
          </div>
          <form class="form-editprofil" action="" method="post">
            <p>
              <label><img class="logoeditprofil" src="images/inscription/avatar.png" alt="Pseudo : "></label>
              <input type="text" name="newpseudo" placeholder="Nouveau pseudo" value="<?php echo $user['pseudo']; ?>">
            </p>
            <p>
              <label><img class="logoeditprofil" src="images/updateprofile/updatemail.png" alt="Mail : "></label>
              <input type="text" name="newmail" placeholder="Nouveau mail" value="<?php echo $user['mail']; ?>">
            </p>
            <p>
              <label><img class="logoeditprofil" src="images/updateprofile/updatemdp.png" alt="Mot de passe : "></label>
              <input type="password" name="newmdp1" placeholder="Nouveau mot de passe">
            </p>
            <p>
              <label><img class="logoeditprofil" src="images/valcoor/valmdp.png" alt="Mot de passe : "></label>
              <input type="password" name="newmdp2" placeholder="Confirmation nouveau mot de passe">
            </p>
            <p>
              <input type="submit" name="updateprofile" value="Mettre à jour mon profil">
            </p>
          </form>
          <p>
            <?php
            if(isset($erreurnewmdp))
            {
              echo '<font color ="red">'.$erreurnewmdp."</font>"; // met l'erreur en rouge
            }
            ?>
          </p>
          <p>
            <?php
            if(isset($erreurnewpseudo))
            {
              echo '<font color ="red">'.$erreurnewpseudo."</font>"; // met l'erreur en rouge
            }
           ?>
          </p>
          <p>
            <?php
            if(isset($erreurnewmail))
            {
              echo '<font color ="red">'.$erreurnewmail."</font>"; // met l'erreur en rouge
            }
           ?>
          </p>
        </div>
      </div>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>

<?php
}
else
{
  header('Location: connexion_inscription.php');
}
?>
