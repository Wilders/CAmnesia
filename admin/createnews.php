<?php
session_start();
if(!isset($_SESSION['id'])) {
    $_SESSION['flash']['danger'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: login.php');
    exit();
}
require_once('inc/db.php');
if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['text']) && isset($_POST['img_source'])) {
    if(empty($_POST['title']) OR empty($_POST['description']) OR empty($_POST['text'])) {
        $errors['emptyone'] = "Un des champs est vide";
    }
    if(empty($errors)){
        $req = $bdd->prepare("INSERT INTO news (title, description, author, text, img_type, img_source) VALUES (?, ?, ?, ?, ?, ?)");
        $req->execute([$_POST['title'], $_POST['description'], $_SESSION['id'], $_POST['text'], $_POST['img_type'], $_POST['img_source']]);
        $_SESSION['flash']['success'] = 'News envoyée!';
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
                                    <a href="news.php" class="active"><i class="fa fa-pencil"></i><span class="sidebar-mini-hide">News</span></a>
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
            <main>
                <div class="content">
                    <h2 class="content-heading">Créer une news</h2>
                    <div class="row gutters-tiny">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="block block-rounded block-themed">
                                    <div class="block-header bg-gd-primary">
                                        <h3 class="block-title">Nouvelle news</h3>
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
                                            <label class="col-12" for="title">Titre</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Titre de la news">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="img_type">Type d'image</label>
                                            <div class="col-12">
                                                <select class="js-select2 form-control" id="img_type" name="img_type" style="width: 100%;" data-placeholder="Choose one..">
                                                    <option></option>
                                                    <option value="0" selected>Aucune</option>
                                                    <option value="1">Image normal</option>
                                                    <option value="2">Youtube embed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">URL Image</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" id="img_source" name="img_source" placeholder="Lien direct sur l'image | https://youtube.com/embed/ID-DE-LA-VIDEO | Mettre 'Aucune'">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="description">Petite description</label>
                                            <div class="col-12">
                                                <textarea class="form-control" id="description" name="description" placeholder="Description visible sur la preview de la news" rows="6"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Texte de la news</label>
                                            <div class="col-12">
                                                <textarea class="form-control" id="js-ckeditor" name="text" placeholder="News" rows="8"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-primary">Créer la news</button>
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
        <script src="js/plugins/ckeditor/ckeditor.js"></script>
        <script src="js/plugins/select2/select2.full.min.js"></script>
        <script src="js/codebase.js"></script>
        <script>
            jQuery(function () {
                Codebase.helpers(['ckeditor', 'select2']);
            });
        </script>

    </body>
</html>