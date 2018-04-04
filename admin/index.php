<?php
session_start();
if(!isset($_SESSION['id'])) {
    $_SESSION['flash']['danger'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: login.php');
    exit();
}
require_once('inc/db.php');
$req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
$req->execute(['id' => $_SESSION['id']]);
$user = $req->fetch();
if(isset($_POST['titre1']) && isset($_POST['titre2']) && isset($_POST['titre3'])) {
	if(empty($_POST['titre1']) OR empty($_POST['titre2']) OR empty($_POST['titre3'])) {
		$errors['emptyone'] = "Un des titres est vide";
	}
    if(empty($errors)){
        $req = $bdd->prepare("UPDATE textindex SET titre1 = ?, titre2 = ?, titre3 = ?");
        $req->execute([$_POST['titre1'], $_POST['titre2'], $_POST['titre3']]);
        $_SESSION['flash']['success'] = 'Les titres ont été changés!';
    }
}
if(isset($_POST['texte1']) && isset($_POST['texte2']) && isset($_POST['texte3'])) {
	if(empty($_POST['texte1']) OR empty($_POST['texte1']) OR empty($_POST['texte3'])) {
		$errors['emptyone'] = "Un des textes est vide";
	}
    if(empty($errors)){
        $req = $bdd->prepare("UPDATE textindex SET text1 = ?, text2 = ?, text3 = ?");
        $req->execute([$_POST['texte1'], $_POST['texte2'], $_POST['texte3']]);
        $_SESSION['flash']['success'] = 'Les textes ont été changés!';
    }
}
$settings = $bdd->prepare('SELECT * FROM textindex');
$settings->execute();
$index = $settings->fetch();
?>
<!doctype html>
<!--/
                        _   _       _a_a
            _   _     _{.`=`.}_    {/ ''\_
      _    {.`'`.}   {.'  _  '.}  {|  ._oo)
     { \  {/ .-. \} {/  .' '.  \} {/  |
~^~^~`~^~`~^~`~^~`~^~^~`^~^~`^~^~^~^~^~^~`^~~`
/-->
<!--[if lte IE 9]>     <html lang="fr-FR" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="fr-FR" class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Amnésia - Dashboard</title>
        <meta name="description" content="Amnésia : Dashboard">
        <meta name="author" content="Wilders">
        <meta name="robots" content="noindex, nofollow">
        <meta property="og:title" content="Amnésia - Dashboard">
        <meta property="og:site_name" content="Amnésia Dashboard">
        <meta property="og:description" content="Amnésia : Dashboard">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://cmanesia.fr/admin/">
        <meta property="og:image" content="https://camnesia.fr/img/logo.png">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <link rel="stylesheet" id="css-main" href="css/codebase.min.css">
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed page-header-modern main-content-boxed">
            <nav id="sidebar">
                <div id="sidebar-scroll">
                    <div class="sidebar-content">
                        <div class="content-header content-header-fullrow px-15">
                            <div class="content-header-section sidebar-mini-visible-b">
                                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">C</span><span class="text-primary">A</span>
                                </span>
                            </div>
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                                <div class="content-header-item">
                                    <a class="link-effect font-w700" href="https://camnesia.fr/admin/">
                                        <i class="si si-fire text-primary"></i>
                                        <span class="font-size-xl text-dual-primary-dark">CAmnesia</span><span class="font-size-xl text-primary">.fr</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="content-side content-side-full content-side-user px-10 align-parent">
                            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                                <img class="img-avatar img-avatar32" src="img/avatars/unknown.png" alt="">
                            </div>
                            <div class="sidebar-mini-hidden-b text-center">
                                <a class="img-link" href="profile.php">
                                    <img class="img-avatar" src="img/avatars/unknown.png" alt="">
                                </a>
                                <ul class="list-inline mt-10">
                                    <li class="list-inline-item">
                                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="profile.php"><?= $user['username']; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a href="index.php" class="active"><i class="si si-fire"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                <li>
                                    <a href="news.php"><i class="fa fa-pencil"></i><span class="sidebar-mini-hide">News</span></a>
                                </li>
                                <li>
                                    <a href="servers.php"><i class="fa fa-server"></i><span class="sidebar-mini-hide">Serveurs</span></a>
                                </li>
                                <li>
                                    <a href="users.php"><i class="si si-user"></i><span class="sidebar-mini-hide">Utlisateurs</span></a>
                                </li>
<?php if($_SESSION['id'] == "1") { ?>
                                <li>
                                    <a href="team.php"><i class="si si-user"></i><span class="sidebar-mini-hide">Equipe</span></a>
                                </li>
<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <header id="page-header">
                <div class="content-header">
                    <div class="content-header-section">
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                    </div>
                    <div class="content-header-section">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $user['username']; ?><i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="si si-user mr-5"></i> Mes infos
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="si si-logout mr-5"></i> Déconnexion
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main id="main-container">
                <div class="content">
<?php if(isset($_SESSION['flash'])): ?><?php foreach($_SESSION['flash'] as $type => $message): ?>
            								<div class="alert alert-<?= $type; ?> alert-dismissible fade show animated pulse">
                								<strong>Hey!</strong> <?= $message; ?>
                								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        											<span aria-hidden="true">&times;</span>
      											</button>
            								</div>
<?php endforeach; ?><?php unset($_SESSION['flash']); ?><?php endif; ?>
<?php if(!empty($errors)): ?><?php foreach($errors as $error): ?>
                                            <div class="alert alert-danger alert-dismissible fade show animated pulse" role="alert">
                                                <strong>Oops!</strong> <?= $error; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
<?php endforeach; ?><?php endif; ?>
                    <div class="block block-fx-shadow">
                        <div class="block-content">
                        	<form action="" method="POST">
	                            <h2 class="content-heading text-black">Changement des titres</h2>
	                            <div class="row items-push">
	                                <div class="col-lg-3">
	                                    <p class="text-muted">
	                                        Titres sur la page d'accueil
	                                    </p>
	                                </div>
	                                <div class="col-lg-7 offset-lg-1">
	                                    <div class="form-group row">
	                                        <div class="col-12">
	                                            <label for="titre1">Titre n°1</label>
	                                            <input type="text" class="form-control form-control-lg" name="titre1" value="<?= $index['titre1']; ?>">
	                                        </div>
	                                    </div>
	                                   <div class="form-group row">
	                                        <div class="col-12">
	                                            <label for="titre2">Texte n°2</label>
	                                            <input type="text" class="form-control form-control-lg" name="titre2" value="<?= $index['titre2']; ?>">
	                                        </div>
	                                    </div>
	                                   <div class="form-group row">
	                                        <div class="col-12">
	                                            <label for="titre3">Titre n°3</label>
	                                            <input type="text" class="form-control form-control-lg" name="titre3" value="<?= $index['titre3']; ?>">
	                                        </div>
	                                    </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-primary">Mettre à jour</button>
                                            </div>
                                        </div>
	                                </div>
	                            </div>
	                        </form>
                            <form action="" method="POST">
                                <h2 class="content-heading text-black">Changement des textes</h2>
                                <div class="row items-push">
                                    <div class="col-lg-3">
                                        <p class="text-muted">
                                            Textes sur la page d'accueil
                                        </p>
                                    </div>
                                    <div class="col-lg-7 offset-lg-1">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="texte1">Texte n°1</label>
                                                <input type="text" class="form-control form-control-lg" name="texte1" id="texte1" value="<?= $index['text1']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="texte2">Texte n°2</label>
                                                <input type="text" class="form-control form-control-lg" name="texte2" id="texte2" value="<?= $index['text2']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="texte3">Texte n°3</label>
                                                <input type="text" class="form-control form-control-lg" name="texte3" id="texte3" value="<?= $index['text3']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-primary">Mettre à jour</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Created with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="http://wilders.fr" target="_blank">Wilders</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://camnesia.fr/admin/">camnesia.fr 1.0</a> &copy; <span class="js-year-copy">2018</span>
                    </div>
                </div>
            </footer>
        </div>
        <script src="js/core/jquery.min.js"></script>
        <script src="js/core/bootstrap.bundle.min.js"></script>
        <script src="js/core/jquery.slimscroll.min.js"></script>
        <script src="js/core/jquery.scrollLock.min.js"></script>	
        <script src="js/core/jquery.appear.min.js"></script>
        <script src="js/codebase.js"></script>
    </body>
</html>