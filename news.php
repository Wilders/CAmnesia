<?php
require('inc/db.php');
if(!isset($_GET['id'])) {
  header('Location: index.php');
  die();
} elseif(!is_numeric($_GET['id'])) {
  header('Location: index.php');
  die();
}
$checkid = $bdd->prepare('SELECT * FROM news WHERE id = :id');
$checkid->bindParam(':id', $_GET['id']);
$checkid->execute();
if($checkid->rowCount() > 0) {
  $news = $checkid->fetch();
  $randnews = $bdd->query('SELECT * FROM news ORDER BY RAND() DESC LIMIT 0,3');
  $profil = $bdd->prepare('SELECT * FROM users WHERE id = :id');
  $profil->bindParam(':id', $news['author']);
  $profil->execute();
  $user = $profil->fetch();
  if($user == TRUE) {
    $url = 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=38BE29714EC894BC33B8BC8F03C580DA&steamids='.$user['steamid'];
    $f = file_get_contents($url);
    $arr = json_decode($f, true);
    if (isset($arr['response']['players'][0]['avatarfull'])) {
      $avatar = $arr['response']['players'][0]['avatarfull'];
    } else {
      $avatar = "http://cdn.akamai.steamstatic.com/steamcommunity/public/images/avatars/d6/d6cd5fcd90396746061496076b27c5e79c17532d_full.jpg";
    }
  } else {
    $user = array('username' => 'Console', 'steamid' => '0', 'bio' => 'Cette news a été postée par un ancien Staff.');
    $avatar = "http://cdn.akamai.steamstatic.com/steamcommunity/public/images/avatars/d6/d6cd5fcd90396746061496076b27c5e79c17532d_full.jpg";
  }
} else {
  header('Location: index.php');
  die();
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
    <meta property="og:title" content="Amnésia news n°<?= $news['id']; ?> | <?= $news['title']; ?>" />
    <meta property="og:description" content="<?= $news['description']; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://camnesia.fr/news.php?id=<?= $news['id']; ?>" />
<?php if($news['img_type'] == 1) { ?>
    <meta property="og:image" content="<?= $news['img_source']; ?>" />
<?php } elseif($news['img_type'] == 2) { ?> 
    <meta property="og:image" content="http://cmanesia.fr/img/logo.png" />
<?php } ?>
    <title>Communauté Amnésia | News n°<?= $news['id']; ?></title>
    <link rel="icon" type="image/icon" sizes="16x16" href="img/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/news.css" rel="stylesheet">
  </head>
  <body class="grey lighten-3">
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
              <a class="nav-link" href="servers.php">Nos Serveurs</a>
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
    <main class="mt-5 pt-5">
        <div class="container">
            <section class="mt-4">
                <div class="row">
                    <div class="col-md-8 mb-4">
<?php if($news['img_type'] == 1) { ?>
                        <div class="card mb-4">
                          <img src="<?= $news['img_source']; ?>" class="img-fluid" alt="<?= $news['title']; ?>">
                        </div>
<?php } elseif($news['img_type'] == 2) { ?>
                        <div class="card mb-4">
                          <div class="view rounded embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?= $news['img_source']; ?>" allowfullscreen></iframe>
                          </div>
                        </div>
<?php } ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="h5 my-4"><?= $news['title']; ?></p>
                                <p class="text-muted"><?= $news['description']; ?></p>
                                <p><?= $news['text']; ?></p>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header font-weight-bold">
                                <span>Informations sur l'auteur</span>
                            </div>
                            <div class="card-body">
                                <div class="media d-block d-md-flex mt-3">
                                    <img class="d-flex mb-3 mx-auto z-depth-1" src="<?= $avatar; ?>" alt="<?= $user['username']; ?>" style="width: 100px;">
                                    <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                        <h5 class="mt-0 font-weight-bold"><a href="https://steamcommunity.com/profiles/<?= $user['steamid']; ?>" target="_blank"><?= $user['username']; ?></a></h5>
                                        <p class="text-muted"><?= $user['bio']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card gradient mb-4">
                            <div class="card-body text-white text-center">
                                <h4 class="mb-4">
                                    <strong>Communauté Amnésia</strong>
                                </h4>
                                <p>
                                    <strong>News n°<?= $news['id']; ?></strong>
                                </p>
                                <p class="mb-4">
                                    <strong>Posté le <?= date("d/m/Y", strtotime($news['date'])); ?> par <?= $user['username']; ?></strong>
                                </p>
                                <a target="_blank" href="https://camnesia.fr/forum/" class="btn btn-outline-white btn-md">Accéder au forum <i class="fa fa-comments ml-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">News aléatoires..</div>
                            <div class="card-body">
                                <ul class="list-unstyled">
<?php while ($data = $randnews->fetch()) { ?>
                                    <li class="media mt-2">
<?php if($data['img_type'] == 1) { ?>
                                      <img src="img/text.png" class="d-flex mr-3" alt="<?= $data['title']; ?>" style="max-height: 60px; max-width: 70px;">
<?php } elseif($data['img_type'] == 2) { ?>
                                      <img src="img/ytb.png" class="d-flex mr-3" alt="<?= $data['title']; ?>" style="max-height: 60px; max-width: 60px;">
<?php } else { ?>
                                      <img src="img/text.png" class="d-flex mr-3" alt="<?= $data['title']; ?>" style="max-height: 60px; max-width: 70px;">
<?php } ?>
                                        <div class="media-body">
                                            <a href="news.php?id=<?= $data['id']; ?>">
                                                <h5 class="mt-0 mb-1 font-weight-bold"><?= $data['title']; ?></h5>
                                            </a>
                                            <p class="text-muted"><?= $data['description']; ?></p>
                                        </div>
                                    </li>
<?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
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