<?php
require('inc/db.php');
$game = $bdd->query('SELECT * FROM servers');
$vocal = $bdd->query('SELECT * FROM vocal');
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
    <meta property="og:title" content="Amnésia: nos serveurs" />
    <meta property="og:description" content="Retrouvez ici la liste des nos serveurs." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://camnesia.fr/servers.php" />
    <meta property="og:image" content="http://camnesia.fr/img/logo.png" />
    <title>Communauté Amnésia | Nos serveurs</title>
    <link rel="icon" type="image/icon" sizes="16x16" href="img/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/servers.css" rel="stylesheet">
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
            <li class="nav-item active">
              <a class="nav-link" href="servers.php">Nos serveurs<span class="sr-only">(actif)</span></a>
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
    <main>
		<div class="container">
			<section class="mt-5 pt-5">
				<div class="row">
					<div class="col-md-8">
						<h1 class="text-center"><strong>Serveurs de jeux</strong></h1>
						<table class="table table-responsive">
						    <thead class="mdb-color darken-3">
						        <tr class="text-white">
						            <th>Jeu</th>
						            <th>Nom</th>
						            <th>Mode</th>
						            <th>Adresse</th>
						            <th>Joueurs</th>
						            <th>Rejoindre</th>
						            <th>Plus d'infos</th>
						        </tr>
						    </thead>
						    <tbody>
<?php while ($data = $game->fetch()) { $url = "https://use.gameapis.net/".$data['game']."/query/info/".$data['ip'].":".$data['port'].""; $f = @file_get_contents($url); $arr = json_decode($f, true);?>
					            <div class="modal fade right" id="<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $data['id']; ?>" aria-hidden="true">
					                <div class="modal-dialog modal-full-height modal-right" role="document">
					                    <div class="modal-content">
					                        <div class="modal-header">
					                            <h4 class="modal-title w-100" id="<?= $data['id']; ?>"><?= $data['name']; ?></h4>
					                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                <span aria-hidden="true">&times;</span>
					                            </button>
					                        </div>
					                        <div class="modal-body">
					                        	<p class="text-muted"><?php if(isset($arr['name'])) { ?><?= $arr['name']; ?><?php } else { echo $data['name']; } ?></p>
					                            <p><?= $data['description']; ?></p>
					                            <ul class="list-group z-depth-0">
					                                <li class="list-group-item justify-content-between">
					                                    Adresse
					                                    <span class="float-right badge badge-primary badge-pill"><?= $data['ip'] . ":" . $data['port']; ?></span>
					                                </li>
					                                <li class="list-group-item justify-content-between">
					                                    Statut
					                                    <span class="float-right badge badge-<?php if(isset($arr['status'])) { if($arr['status'] == true) { echo "success";} else { echo "danger";}} else { echo "primary";}?> badge-pill"><?php if(isset($arr['status'])) { if($arr['status'] == true) { echo "En ligne";} else { echo "Hors Ligne";}} else { echo "Inconnu";} ?></span>
					                                </li>
					                                <li class="list-group-item justify-content-between">
					                                    Joueurs
					                                    <span class="float-right badge badge-<?php if(!isset($arr['players'])) { echo "warning";} else { if($arr['players']['online'] < $arr['players']['max']) { echo "success";} else {echo "warning";}} ?> badge-pill"><?php if(isset($arr['players']['online']) && isset($arr['players']['max'])) { ?><?= $arr['players']['online'] . "/" . $arr['players']['max']; ?><?php } else { echo "Inconnu"; } ?></span>
					                                </li>
					                                <li class="list-group-item justify-content-between">
					                                    Map
					                                    <span class="float-right badge badge-<?php if(!isset($arr['map'])) { echo "warning";} else { echo "primary";} ?> badge-pill"><?php if(isset($arr['map'])) { ?><?= $arr['map']; ?><?php } else { echo "Inconnu"; } ?></span>
					                                </li>
					                                <li class="list-group-item justify-content-between">
					                                    Version
					                                    <span class="float-right badge badge-<?php if(!isset($arr['version'])) { echo "warning";} else { echo "primary";} ?> badge-pill"><?php if(isset($arr['version'])) { ?><?= $arr['version']; ?><?php } else { echo "Inconnu"; } ?></span>
					                                </li>
					                                <li class="list-group-item justify-content-between">
					                                    Collection
					                                    <span class="float-right badge badge-primary badge-pill"><a href="<?= $data['collection']; ?>" target="_blank" style="color: white;">Cliquez-ici</a></span>
					                                </li>
					                            </ul>
					                        </div>
					                        <div class="modal-footer justify-content-center">
					                            <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
					                            <a href="<?php if(isset($arr['join'])) { ?><?= $arr['join']; ?><?php } else { echo "#"; } ?>" class="btn btn-primary">Se connecter</a>
					                        </div>
					                    </div>
					                </div>
					            </div>
						        <tr>
						            <td><span class="badge badge-primary badge-pill"><?= $data['game']; ?></span></td>
						            <td><span class="badge badge-primary badge-pill"><?= $data['name']; ?></span></td>
						            <td><span class="badge badge-primary badge-pill"><?= $data['mode']; ?></span></td>
						            <td><span class="badge badge-primary badge-pill"><?= $data['ip'] . ":" . $data['port']; ?></span></td>
						            <td><span class="badge badge-primary badge-pill"><?php if(isset($arr['players']['online']) && isset($arr['players']['max'])) { ?><?= $arr['players']['online'] . "/" . $arr['players']['max']; ?><?php } else { echo "Inconnu"; } ?></span></td>
						            <td><a href="<?php if(isset($arr['join'])) { ?><?= $arr['join']; ?><?php } else { echo "#"; } ?>" class="badge badge-primary badge-pill">Rejoindre</a></td>
						            <td><a class="badge badge-primary badge-pill" data-toggle="modal" data-target="#<?= $data['id']; ?>">Infos</span></td>
						        </tr>
<?php } ?>
						    </tbody>
						</table>
					</div>
					<div class="col-md-4">
						<h1 class="text-center"><strong>Serveurs vocaux</strong></h1>
						<table class="table table-responsive">
						    <thead class="mdb-color darken-3">
						        <tr class="text-white">
						            <th>Plateforme</th>
						            <th>Adresse</th>
						        </tr>
						    </thead>
						    <tbody>
<?php while ($voc = $vocal->fetch()) { ?>
						        <tr>
						            <th><span class="badge badge-primary badge-pill"><?= $voc['plateform']; ?></span></th>
						            <td><a class="badge badge-primary badge-pill" href="<?php if($voc['plateform'] == "TeamSpeak") { ?>ts3server://<?= $voc['address']; ?><?php } else { ?><?= $voc['address']; ?><?php } ?>"><?= $voc['address']; ?></a></td>
						        </tr>
<?php } ?>
						    </tbody>
						</table>
					</div>
				</div>
			</section>
		</div>
    </main>
    <footer class="footer page-footer text-center font-small mt-4">
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