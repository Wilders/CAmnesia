<?php
session_start();
if(!isset($_SESSION['id'])) {
    $_SESSION['flash']['danger'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: login.php');
    exit();
}
require_once('inc/db.php');
$utilisateur = $bdd->query('SELECT * FROM users ORDER BY id DESC');
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
                                    <a href="servers.php"><i class="fa fa-server"></i><span class="sidebar-mini-hide">Serveurs</span></a>
                                </li>
                                <li>
                                    <a href="users.php" class="active"><i class="si si-user"></i><span class="sidebar-mini-hide">Utlisateurs</span></a>
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
                    <div class="row invisible" data-toggle="appear">
                        <div class="col-md-12">
                            <div class="block block-rounded block-bordered">
                                <div class="block-header block-header-default border-b">
                                    <h3 class="block-title">Utilisateurs</h3>
                                    <span class="float-right"><a href="createuser.php">Créer un utilisateur</a></span>
                                </div>
                                <div class="block-content">
                                    <table class="table table-responsive table-borderless table-striped">
                                        <thead>
                                            <tr>
                                                <th class="d-none d-sm-table-cell" style="width: 100px;">#</th>
                                                <th>Pseudo</th>
                                                <th class="text-center">Bio</th>
                                                <th class="text-center">SteamID64</th>
<?php if($_SESSION['id'] == "1") { ?>
                                                <th class="text-center">Action</th>
<?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php while ($data = $utilisateur->fetch()) { ?>
                                            <tr>
                                                <td class="d-none d-sm-table-cell">
                                                    <?= $data['id']; ?>
                                                </td>
                                                <td>
                                                    <?= $data['username']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $data['bio']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $data['steamid']; ?>
                                                </td>
<?php if($_SESSION['id'] == "1") { ?>
                                                <td class="text-center">
                                                    <a href="deluser.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
<?php } ?>
                                            </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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