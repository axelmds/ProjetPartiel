<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TrouverLEKdo</title>
  </head>
  <body>
    <?php include("header.php"); ?>
    <?php include("nav.php"); ?>

    <div class="block block-search">
      <div class="inner">

        <div class="findsearch">
          <a href="savesearch.php">Retrouver une recherche</a>
        </div>

        <div class="title-search">
          <h2>Trouver <strong>le</strong> Kdo</h2>
        </div>

        <div class="explication">
          <p>
            Afin de trouver LE kdo parfait pour vous ou l’un de vos proches,
            Kelkdo a mis en place un questionnaire afin de vous proposer une recherche affinée
            et de trouver les meilleurs kdos
          </p>
        </div>

        <div class="list-search">
          <div class=" list pourqui">
            <h3>Pour qui ?</h3>
          </div>
          <div class="listsearch search1">
            <ul>
              <li class="buttonsearch">
                <input type="checkbox" id="pourmoi" name="qui">
                <label for="pourmoi">Pour moi</label>
              </li>
              <li>
                <input type="checkbox" id="pouroffrir" name="qui" checked>
                <label for="pouroffrir">Pour offrir</label>
              </li>
            </ul>
          </div>

          <div class="list plusexactement">
            <h3>Plus exactement ?</h3>
          </div>
          <div class="listsearch search2">
            <ul>
              <li>
                <input type="checkbox" id="femme" name="femme" checked>
                <label for="femme">Femme</label>
              </li>
              <li>
                <input type="checkbox" id="homme" name="homme">
                <label for="homme">Homme</label>
              </li>
              <li>
                <input type="checkbox" id="couple" name="couple">
                <label for="couple">Couple</label>
              </li>
            </ul>
          </div>

          <div class=" list règles">
            <h3>Réglez ces petits détails</h3>
          </div>
          <div class="listsearch search3">
            <ul>
              <li>
                <div class="rulerage">
                  <div class="age">

                  </div>
                  <input type="checkbox" name="age">
                  <label for="age">Âge</label>
                </div>
              </li>
              <li>
                <div class="rulerbudgetmax">
                  <input type="checkbox" name="budget">
                  <label for="budget">Budget Max</label>
                </div>
              </li>
            </ul>
          </div>

          <div class="list interetsevenements">
            <h3>Centres d'intérêts et évènements</h3>
          </div>
          <div class="listsearch search4">
            <ul>
              <li>
                <input type="checkbox" id="mode" name="mode" checked>
                <label for="mode">Mode</label>
              </li>
              <li>
                <input type="checkbox" id="deco" name="deco" checked>
                <label for="deco">Déco</label>
              </li>
              <li>
                <input type="checkbox" id="sport" name="sport">
                <label for="sport">Sport</label>
              </li>
              <li>
                <input type="checkbox" id="dessin" name="dessin">
                <label for="dessin">Dessin</label>
              </li>
              <li>
                <input type="checkbox" id="beaute" name="beaute" checked>
                <label for="beaute">Beauté</label>
              </li>
              <li>
                <input type="checkbox" id="personnalise" name="personnalise">
                <label for="personnalise">Personnalisé</label>
              </li>
              <li>
                <input type="checkbox" id="hightech" name="hightech">
                <label for="hightech">High-tech</label>
              </li>
              <li>
                <input type="checkbox" id="videogames" name="videogames">
                <label for="videogames">Jeux vidéos</label>
              </li>
              <li>
                <input type="checkbox" id="alimentaire" name="alimentaire">
                <label for="alimentaire">Alimentaire</label>
              </li>
              <li>
                <input type="checkbox" id="musique" name="musique">
                <label for="musique">Musique</label>
              </li>
              <li>
                <input type="checkbox" id="noel" name="noel">
                <label for="noel">Noël</label>
              </li>
              <li>
                <input type="checkbox" id="anniv" name="anniv" checked>
                <label for="anniv">Anniversaire</label>
              </li>
              <li>
                <input type="checkbox" id="mariage" name="mariage">
                <label for="mariage">Mariage</label>
              </li>
              <li>
                <input type="checkbox" id="cremaillere" name="cremaillere">
                <label for="cremaillere">Crémaillère</label>
              </li>
            </ul>
          </div>

          <div class="savefind">
            <ul>
              <li>
                <a href="savesearch.php">Enregistrer la recherche</a>
              </li>
              <li>
                <a href="mykdos.php">Trouver MON Kdo</a>
              </li>
            </ul>
          </div>

        </div>

      </div>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>
