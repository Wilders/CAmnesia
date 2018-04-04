<?php
require('inc/db.php');
$team = $bdd->query('SELECT * FROM team ORDER BY id');
?>
<!DOCTYPE html>
<!--/
                        _   _       _a_a
            _   _     _{.`=`.}_    {/ ''\_
      _    {.`'`.}   {.'  _  '.}  {|  ._oo)
     { \  {/ .-. \} {/  .' '.  \} {/  |
~^~^~`~^~`~^~`~^~`~^~^~`^~^~`^~^~^~^~^~^~`^~~`
/-->

<html lang="fr-FR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Communauté Amnésia">
    <meta name="author" content="Wilders.fr">
    <meta property="og:site_name" content="Communauté Amnésia" />
    <meta property="og:title" content="Amnésia - Notre équipe" />
    <meta property="og:description" content="Rejoignez-nous vite!" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://camnesia.fr/" />
    <meta property="og:image" content="http://camnesia.fr/img/logo.png" />
    <title>Communauté Amnésia | Notre équipe</title>
    <link rel="icon" type="image/icon" sizes="16x16" href="img/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/news.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php"><strong>Amnésia</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="servers.php">Nos serveurs</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="team.php">Notre équipe<span class="sr-only">(actif)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://statut.camnesia.fr/" target="_blank">Statut</a>
            </li>
          </ul>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://camnesia.fr/forum/" class="nav-link border border-light rounded" target="_blank"><i class="fa fa-comments mr-2"></i>Forum</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      <div class="container">
        <section class="pt-5">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="my-4">Notre équipe</h2>
            </div>
<?php while ($data = $team->fetch()) { ?>
            <div class="col-lg-4 col-sm-6 text-center mb-4">
              <img class="rounded-circle img-fluid d-block mx-auto" src="<?= $data['image']; ?>" alt="" height="200" width="200">
              <h3><?= $data['username']; ?>
              </h3>
              <p><?= $data['rank']; ?></p>
            </div>
<?php } ?>
          </div>
        </section>
      </div>
    </main>
    <footer class="page-footer text-center font-small mt-4">
      <div class="py-3">
        <a href="http://steamcommunity.com/groups/Communaute-Amnesia" target="_blank"><i class="fab fa-steam fa-2x mr-3"></i></a>
        <a href="https://discord.gg/emfgXRw" target="_blank"><i class="fab fa-discord fa-2x mr-3"></i></a>
        <a href="ts3server://ts.camnesia.fr"><i class="fas fa-headphones fa-2x mr-3"></i></a>
      </div>
      <div class="footer-copyright py-3">
        © 2018 Copyright: <a href="https://camnesia.fr"> Communauté Amnésia </a> | Made by <a href="http://wilders.fr">Wilders</a>
      </div>
    </footer>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
  </body>
</html>