<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.05.13
 * Time: 10:32
 * To change this template use File | Settings | File Templates.
 */

/*
 * I am aware that this login check is useless but the story wish that I implement some
 * login script with no security check so that everyone can login
 */
namespace org\camunda\demo\php;

session_start();

require_once('../../assets/php/Error.php');
require_once('../../assets/php/Login.php');

if(isset( $_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
  header('Location: ../index.php');
  exit();
}

if(isset($_POST['login'])) {
    $login = new Login();
    $login->setCredentials($_POST['username'], $_POST['password']);
    $error = $login->doLogin();

    if($error === true) {
      header('Location: ../index.php');
      exit();
    }

}
?>
<!doctype html>
<html lang="en">
<head>
  <title>camunda PHP incubation demo</title>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="../../assets/img/favicon.ico">

  <link rel="stylesheet" type="text/css" href="../../assets/vendor/twitter/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="../../assets/vendor/twitter/bootstrap/css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="../../assets/css/app.css" />

  <script src="../../assets/vendor/jquery/js/jquery-1.9.1.js" language="javascript" type="text/javascript"></script>
  <script src="../../assets/vendor/twitter/bootstrap/js/bootstrap.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<header class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="#"></a>
    </div>
  </div>
</header>

<nav class="container-fluid row-margin1">
  <?php if(isset($error)) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Warning!</strong> <?php echo $error->getMessage(); ?>
  </div>
  <?php }?>
</nav>

<section class="container-fluid CA-container-fixed-height">
  <div class="row-fluid">
    <div class="span3"></div>
    <div class="span4">
      <form class="login-form" method="POST">
        <h2>Please sign in</h2>
        <label for="username">Username:</label>
        <input id="username" type="text" name="username" placeholder="Username"/>

        <label for="password">Password:</label>
        <input id="password" type="password" name="password" placeholder="Password">
        <br />
        <button type="submit" id="login" name="login" value="Login">Login</button>
      </form>
    </div>
  </div>
</section>

<footer class="container-fluid">
  <p><a href="http://camunda.org">powered by camunda BPM</a>
</footer>
</body>
</html>
