<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test Formulaire</title>
  </head>
  <body>
    <form action="profil.php" method="post">
      <p><label>Prénom : <input type="text" name="prenom" /></label></p>
      <p>
        <label>Cherchez-vous un kdo pour noël ?
          <input type="radio" name="find-kdo" value="oui" /> <label>Oui</label>
          <input type="radio" name="find-kdo" value="non" /> <label>Non</label>
        </label>
      </p>
      <p><input type="submit" /></p>
    </form>
  </body>
</html>
