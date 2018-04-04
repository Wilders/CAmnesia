<?php
require('inc/db.php');
$news = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 0,3');
$text = $bdd->prepare('SELECT * FROM textindex');
$text->execute();
$texts = $text->fetch();
$api = file_get_contents("http://steamcommunity.com/groups/Communaute-Amnesia/memberslistxml/?xml=1");
$xml = simplexml_load_string($api);
if(isset($xml->groupDetails->memberCount)) {
  $members = $xml->groupDetails->memberCount;
} else {
  $members = "plus de 1000";
}
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
    <meta property="og:title" content="Amnésia - Accueil" />
    <meta property="og:description" content="Rejoignez-nous vite!" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://camnesia.fr/" />
    <meta property="og:image" content="http://camnesia.fr/img/logo.png" />
    <title>Communauté Amnésia</title>
    <link rel="icon" type="image/icon" sizes="16x16" href="img/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php"><strong>Amnésia</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Accueil<span class="sr-only">(actif)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="servers.php">Nos serveurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="team.php">Notre équipe</a>
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
    <div class="view" style="background-image: url('img/background.jpg'); background-repeat: no-repeat; background-size: cover;">
      <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
        <div class="text-center white-text mx-5">
          <h1 class="mb-4"><strong>Communauté Amnésia</strong></h1>
          <p><strong>Bienvenue sur notre nouveau site!</strong></p>
          <p class="mb-4 d-none d-md-block"><strong>Notre communauté vous attends, <?= $members; ?> joueurs nous font confiance, pourquoi pas vous?</strong></p>
          <a href="https://discord.gg/emfgXRw" target="_blank" class="btn btn-outline-white btn-lg"><i class="fab fa-discord fa-lg mr-2"></i>Discord</a><a href="http://steamcommunity.com/groups/Communaute-Amnesia" target="_blank" class="btn btn-outline-white btn-lg"><i class="fab fa-steam fa-lg mr-2"></i>Steam</a><a href="ts3server://ts.camnesia.fr" class="btn btn-outline-white btn-lg"><i class="fas fa-headphones fa-lg mr-2"></i></i>TeamSpeak</a>
        </div>
      </div>
    </div>
    <main>
      <div class="container">
        <section>
          <h3 class="h3 text-center py-5">A propos</h3>
          <div class="row">
            <div class="col-lg-6 col-md-12 px-4">
              <div class="row">
                <div class="col-1 mr-3">
                  <i class="far fa-check-circle fa-2x indigo-text"></i>
                </div>
                <div class="col-10">
                  <h5 class="feature-title"><?= $texts['titre1']; ?></h5>
                  <p class="grey-text"><?= $texts['text1']; ?></p>
                </div>
              </div>
              <div style="height:30px"></div>
              <div class="row">
                <div class="col-1 mr-3">
                  <i class="fas fa-check-circle fa-2x blue-text"></i>
                </div>
                <div class="col-10">
                  <h5 class="feature-title"><?= $texts['titre2']; ?></h5>
                  <p class="grey-text"><?= $texts['text2']; ?></p>
                </div>
              </div>
              <div style="height:30px"></div>
              <div class="row">
                <div class="col-1 mr-3">
                  <i class="far fa-check-circle fa-2x cyan-text"></i>
                </div>
                <div class="col-10">
                  <h5 class="feature-title"><?= $texts['titre3']; ?></h5>
                  <p class="grey-text"><?= $texts['text3']; ?></p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <p class="h5 text-center mb-4"> Regardez notre vidéo de présentation</p>
              <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/uiTc_aLRT68" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </section>
        <section class="pt-5">
          <div>
            <h2 class="h1 text-center mb-5">Dernières news</h2>
            <p class="text-center mb-5 pb-2">Voici les dernières news postées sur le site.</p>
          </div>
<?php while ($data = $news->fetch()) { ?>
          <div class="row">
            <div class="col-lg-5 col-xl-4 mb-4">
              <div class="view rounded z-depth-1-half">
<?php if($data['img_type'] == 1) { ?>
				<img src="<?= $data['img_source']; ?>" class="img-fluid" alt="<?= $data['title']; ?>">
<?php } elseif($data['img_type'] == 2) { ?>
                <div class="view rounded embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="<?= $data['img_source']; ?>" allowfullscreen></iframe>
                </div>
<?php } else { ?>
				<img src="img/nocover.jpg" class="img-fluid" alt="<?= $data['title']; ?>">
<?php } ?>
              </div>
            </div>
            <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
              <h3 class="mb-3 font-weight-bold dark-grey-text">
                <strong><?= $data['title']; ?></strong>
              </h3>
              <p class="grey-text"><?= $data['description']; ?></p>
              <a href="news.php?id=<?= $data['id']; ?>" class="btn btn-primary btn-md">Lire <i class="fa fa-play ml-2"></i></a>
            </div>
          </div>
          <hr class="mb-5">
<?php } $news->closeCursor(); ?>
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