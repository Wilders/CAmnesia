<?php
session_start();
if(!isset($_SESSION['id'])) {
    $_SESSION['flash']['danger'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: login.php');
    exit();
}
require_once('inc/db.php');
if(isset($_POST['game']) && isset($_POST['name']) && isset($_POST['mode']) && isset($_POST['ip']) && isset($_POST['port']) && isset($_POST['collection']) && isset($_POST['description'])) {
    if(empty($_POST['game']) OR empty($_POST['name']) OR empty($_POST['mode']) OR empty($_POST['ip']) OR empty($_POST['port']) OR empty($_POST['collection']) OR empty($_POST['description'])) {
        $errors['emptyone'] = "Un des champs est vide";
    }
    if(empty($errors)){
        $req = $bdd->prepare("INSERT INTO servers (name, game, mode, ip, port, collection, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $req->execute([$_POST['name'], $_POST['game'], $_POST['mode'], $_POST['ip'], $_POST['port'], $_POST['collection'], $_POST['description']]);
        $_SESSION['flash']['success'] = 'Serveur de jeu ajouté!';
    }
}
$req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
$req->execute(['id' => $_SESSION['id']]);
$user = $req->fetch();
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
        <link rel="stylesheet" href="js/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="js/plugins/select2/select2-bootstrap.min.css">
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
                                    <a href="index.php"><i class="si si-fire"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                <li>
                                    <a href="news.php"><i class="fa fa-pencil"></i><span class="sidebar-mini-hide">News</span></a>
                                </li>
                                <li>
                                    <a href="servers.php" class="active"><i class="fa fa-server"></i><span class="sidebar-mini-hide">Serveurs</span></a>
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
            <main>
                <div class="content">
                    <h2 class="content-heading">Ajouter un serveur</h2>
                    <div class="row gutters-tiny">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="block block-rounded block-themed">
                                    <div class="block-header bg-gd-primary">
                                        <h3 class="block-title">Nouveau serveur de jeu</h3>
                                    </div>
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
                                    <div class="block-content block-content-full">
                                        <div class="form-group row">
                                            <label class="col-12" for="img_type">Jeu (disponlibe avec l'API)</label>
                                            <div class="col-12">
                                                <select class="js-select2 form-control" id="game" name="game" style="width: 100%;" data-placeholder="Choisir">
                                                    <option></option>
                                                    <option value="gmod">Garry's Mod</option>
                                                    <option value="7d2d">7 Days to Die</option>
                                                    <option value="alienswarm">Alien Swarn</option>
                                                    <option value="ark">Ark</option>
                                                    <option value="arma3">Arma 3</option>
                                                    <option value="bf3">Battleflied 3</option>
                                                    <option value="bf2">Battlefield 2</option>
                                                    <option value="bf2142">Battlefield 2142</option>
                                                    <option value="bf1942">Battlefield 1942</option>
                                                    <option value="bf4">Battlefield 4</option>
                                                    <option value="bfhl">Battlefield: Hardline</option>
                                                    <option value="brink">BRINK</option>
                                                    <option value="cod2">Call of Duty 2</option>
                                                    <option value="coduo">Call of Duty: United Offensive</option>
                                                    <option value="cod">Call of Duty</option>
                                                    <option value="cmw">Chivalry: Medieval Warfare</option>
                                                    <option value="cod4">Call of Duty 4</option>
                                                    <option value="codmw3">Call of Duty: Modern Warfare 3</option>
                                                    <option value="codwaw">Call of Duty: World at War</option>
                                                    <option value="cs">Counter-Strike 1.6</option>
                                                    <option value="dayz">DayZ Standalone</option>
                                                    <option value="dnl">Dark and Light</option>
                                                    <option value="css">Counter-Strike: Source</option>
                                                    <option value="csgo">Counter-Strike: Global Offensive</option>
                                                    <option value="mc/query">Minecraft Query</option>
                                                    <option value="mcpe">Minecraft: Pocket Edition</option>
                                                    <option value="quake2">Quake 2</option>
                                                    <option value="quake3">Quake 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">Nom</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom du serveur">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">Description</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Description du serveur">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">Mode</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" id="mode" name="mode" placeholder="Mode de jeu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">Adresse du Serveur</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="ip" name="ip" placeholder="IP du serveur">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" id="port" name="port" placeholder="Port du serveur">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">Lien vers la collection Steam</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" id="collection" name="collection" placeholder="Lien vers la collection Steam">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-primary">Ajouter le serveur</button>
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
        <script src="js/plugins/select2/select2.full.min.js"></script>
        <script src="js/codebase.js"></script>
        <script>
            jQuery(function () {
                Codebase.helpers(['select2']);
            });
        </script>

    </body>
</html>