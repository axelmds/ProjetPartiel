<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=kelkdo', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_SESSION['id'])) // si li y a une id
{
  header('Location: profil.php?id='.$_SESSION['id']); // je renvoie sur la page du profil co
}

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // INSCRIPTION
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  if(isset($_POST['forminscription']))
  { //forminscription = bouton s'inscrire
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']); // sécurise les mdp dans les bases de données => mode text dans la base de donnée
    $mdp2 = sha1($_POST['mdp2']); // sécurise les mdp dans les bases de données => mode text dans la base de donnée

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    { // si tout ca est différent de vide, donc rempli
      $pseudolength = strlen($pseudo); // stock la longueur du pseudo dans une variable
      if($pseudolength <= 255) // test la longueur du pseudo
      {
        if($mail == $mail2)
          {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            { // valide si il s'agit bien d'un email
              //requête pour récupérer tous les mails de la table
              $reqmail = $bdd->prepare('SELECT * FROM membres WHERE mail = ?');
              $reqmail->execute(array($mail));
              $mailexist = $reqmail->rowCount(); // compte combien de mail que l'utilisateur a rentré existe
              if($mailexist == 0) // si le mail n'existe pas exécute le créer sinon demande d'en choisir une autre
              {
                $reqpseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
                $reqpseudo->execute(array($pseudo));
                $pseudoexist = $reqpseudo->rowCount(); // compte combien pseudo que l'utilisateur a rentré existe
                if($pseudoexist == 0)
                {
                  if($mdp == $mdp2) // si les mots de passes correspondent
                  {
                    // création du membre dans la base de donnée
                    $insertmbr = $bdd->prepare('INSERT INTO membres(pseudo, mail, mdp) VALUES(?, ?, ?)'); // prépare une requête pour la base de donnée
                    $insertmbr->execute(array($pseudo, $mail, $mdp)); // la requête est exécuté
                    $_SESSION['comptecree'] = 'Votre compte a bien été crée !'; // stock les info utilisateurs dans comptecree tant qu'il ne ferme pas la page
                    header("Location: connexion_inscription.php"); // renvoie vers la page index.php
                    // header('Location: index.php'); //redirige vers la page index.php si le compte a été crée
                  }
                  else
                  {
                    $erreurinscription = 'Vos mots de passes doivent correspondrent';
                  }
                }
                else
                {
                  $erreurinscription = 'Votre pseudo est déjà prit, choisissez en un autre';
                }
              }
              else
              {
                $erreurinscription = "Adresse mail déjà utilisée";
              }
            }
            else
            {
              $erreurinscription = 'Votre adresse mail n\'est pas valide';
            }
          }
            else
            {
              $erreurinscription = 'Vos adresses mails ne correspondent pas';
            }
          }
      else
      {
        $erreurinscription = 'Votre pseudo ne doit  pas dépacer 255 caractères';
      }
    }
    else
    {
      $erreurinscription = "Tous les champs doivent être complétés";
    }
  }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // CONNEXION
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  if(isset($_POST['formconnexion']))
  {
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']); // stocker dans un variable sécurisée
    $mdpconnect = sha1($_POST['mdpconnect']); // stocker dans un variable sécurisée
    if(!empty($pseudoconnect) AND !empty($mdpconnect)) // si les deux inputs sont remplis
    {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND mdp = ?");
      $requser->execute(array($pseudoconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1)
      {
        $userinfo = $requser->fetch(); //permet de recevoir les informations
        $_SESSION['id'] = $userinfo['id'];
        $_SESSION['pseudo'] = $userinfo['pseudo'];
        $_SESSION['mail'] = $userinfo['mail'];
        header('Location: profil.php?id='.$_SESSION['id']); // Redirige vers le profil de la personne via l'id
      }
      else
      {
        $erreurconnexion = "Mauvais pseudo ou mot de passe";
      }
    }
    else
    {
      $erreurconnexion = "Tous les champs doivent être complétés !";
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
    <title>Inscription/Connexion KelKdo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
  </head>
  <body>

    <?php include("header.php"); ?>
    <?php include("nav.php"); ?>

    <div class="block block-form">
      <div class="inner">
            <div class="inscription">
              <div class="titre-inscription">
                <h2>S 'inscrire</h2>
              </div>
              <!-- </br> </br> -->
              <div class="form-inscription">
                <form class="formulaire" method="POST" action=" ">
                  <table class="tableau-inscription">
                    <tr> <!--mit dans un tableau pour question de présentation -->
                      <td class="td pseudo" align="right">
                        <label for="pseudo"><img class="logoinscription pseudo" src="images/inscription/avatar.png" alt="Pseudo"></label>
                      </td>
                      <td>
                        <input class="input-inscription" type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo"/value="<?php if(isset($pseudo)) {echo $pseudo;} ?>"> <!-- for permet de cliquer aussi sur pseudo pour écrire dans le formulaire -->
                      </td>
                    </tr>

                    <tr>
                      <td class=""align="right">
                        <label for="mail"><img class="logoinscription mail"src="images/inscription/mail.png" alt="Mail"></label>
                      </td>
                      <td>
                        <input class="input-inscription" type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"/> <!-- for permet de cliquer aussi sur pseudo pour écrire dans le formulaire -->
                      </td>
                    </tr>

                    <tr>
                      <td align="right">
                        <label for="mail2"><img class="logoinscription confirmmail" src="images/valcoor/valmail.png" alt="Mail"></label>
                      </td>
                      <td>
                        <input class="input-inscription" type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) {echo $mail2;} ?>"/> <!-- for permet de cliquer aussi sur pseudo pour écrire dans le formulaire -->
                      </td>
                    </tr>

                    <tr>
                      <td align="right">
                        <label for="mdp"><img class="logoinscription mdp" src="images/inscription/lock.png" alt="Mot de passe"></label>
                      </td>
                      <td>
                        <input class="input-inscription" type="password" placeholder="Mot de passe" id="mdp" name="mdp"/> <!-- for permet de cliquer aussi sur pseudo pour écrire dans le formulaire -->
                      </td>
                    </tr>

                    <tr>
                      <td align="right">
                        <label for="mdp2"><img class="logoinscription confirmmdp" src="images/valcoor/valmdp.png" alt="Mot de passe"></label>
                      </td>
                      <td>
                        <input class="input-inscription" type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2"/> <!-- for permet de cliquer aussi sur pseudo pour écrire dans le formulaire -->
                      </td>
                    </tr>
                  </table>
                  <div class="erreur-inscription">
                    <?php
                    if(isset($erreurinscription)) // si il y a une erreur
                    {
                      echo '<font color ="red">'.$erreurinscription."</font>"; // met l'erreur en rouge
                    }
                    ?>
                  </div>
                  <div class="inscrit">
                    <input type="submit" name="forminscription" value="Je m'inscris">
                  </div>
                </form>
              </div>
            </div>

            <div class="connexion">
              <div class="titre-connexion">
                <h2>Se connecter</h2>
              </div>
              <!-- </br> </br> -->
              <div class="form-connexion">
                <form class="formulaire" method="POST" action=" ">
                  <table class="tableau-connexion">
                    <tr>
                       <td>
                        <label for="pseudoconnect"><img class="logoconnexion" src="images/inscription/avatar.png" alt="Pseudo"></label>
                      </td>
                      <td>
                        <input class="input-connexion" type="text" name="pseudoconnect" placeholder="Votre pseudo">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label for="mdpconnect"><img class="logoconnexion" src="images/inscription/lock.png" alt="Mot de passe"></label>
                      </td>
                      <td>
                        <input class="input-connexion" type="password" name="mdpconnect" placeholder="Mot de passe">
                      </td>
                    </tr>
                  </table>
                  <div class="erreur-connexion">
                    <?php
                    if(isset($erreurconnexion)) // si il y a une erreur
                    {
                      echo '<font color ="red">'.$erreurconnexion."</font>"; // met l'erreur en rouge
                    }
                    ?>
                  </div>
                  <div class="connecté">
                    <input type="submit" name="formconnexion" value="Je me connecte">
                  </div>
                </form>
              </div>
            </div>

      </div>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>
