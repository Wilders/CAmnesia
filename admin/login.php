<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location: index.php');
    die();
}
if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){
    require_once('inc/db.php');
    $req = $bdd->prepare('SELECT * FROM users WHERE username = :login');
    $req->execute(['login' => $_POST['login']]);
    $user = $req->fetch();
    if(sha1($_POST['password']) === $user['password']){
        $_SESSION['id'] = $user['id'];
        header('Location: index.php');
        die();
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }
}
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
        <title>Amnésia - Connexion</title>
        <meta name="description" content="Amnésia - Connexion au dashboard">
        <meta name="author" content="Wilders">
        <meta name="robots" content="noindex, nofollow">
        <!-- Open Graph Meta -->
        <meta property="og:title" content="Connexion au dashboard">
        <meta property="og:site_name" content="Communauté Amnésia">
        <meta property="og:description" content="Amnésia - Connexion au dashboard">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://camnesia.fr/admin/login.php">
        <meta property="og:image" content="http://camnesia.fr/img/logo.png">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <link rel="stylesheet" id="css-main" href="css/codebase.min.css">
    </head>
    <body>
        <div id="page-container" class="main-content-boxed">
            <main id="main-container">
                <div class="bg-body-dark bg-pattern" style="background-image: url('img/bg-pattern-inverse.png');">
                    <div class="row mx-0 justify-content-center">
                        <div class="hero-static col-lg-6 col-xl-4">
                            <div class="content content-full overflow-hidden">
                                <div class="py-30 text-center">
                                    <a class="link-effect font-w700" href="https://camnesia.fr">
                                        <i class="si si-fire"></i>
                                        <span class="font-size-xl text-primary-dark">CAmnesia</span><span class="font-size-xl">.fr</span>
                                    </a>
                                    <h1 class="h4 font-w700 mt-30 mb-10">Connexion au dashboard</h1>
                                </div>
                                <form class="js-validation-signin" action="" method="POST">
                                    <div class="block block-themed block-rounded block-shadow">
                                        <div class="block-header bg-gd-dusk">
                                            <h3 class="block-title">Connectez-vous</h3>
                                            <div class="block-options">
                                                <button type="button" class="btn-block-option">
                                                    <i class="si si-wrench"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="block-content">
<?php if(isset($_SESSION['flash'])): ?><?php foreach($_SESSION['flash'] as $type => $message): ?>
            								<div class="alert alert-<?= $type; ?> alert-dismissible fade show animated pulse">
                								<strong>Hey!</strong> <?= $message; ?>
                								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        											<span aria-hidden="true">&times;</span>
      											</button>
            								</div>
<?php endforeach; ?><?php unset($_SESSION['flash']); ?><?php endif; ?>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="login">Identifiant</label>
                                                    <input type="text" class="form-control" id="login" name="login">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="password">Mot de passe</label>
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-sm-6 d-sm-flex align-items-center push">
                                                    <div class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                        <label class="custom-control-label" for="remember">Se souvenir de moi</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-sm-right push">
                                                    <button type="submit" class="btn btn-alt-primary">
                                                        <i class="si si-login mr-10"></i> Connexion
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="js/core/jquery.min.js"></script>
        <script src="js/core/bootstrap.bundle.min.js"></script>
        <script src="js/core/jquery.slimscroll.min.js"></script>
        <script src="js/core/jquery.scrollLock.min.js"></script>
        <script src="js/codebase.js"></script>
    </body>
</html>