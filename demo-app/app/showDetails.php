<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 27.05.13
 * Time: 15:59
 * To change this template use File | Settings | File Templates.
 */
namespace org\camunda\demo\php;

session_start();

require_once('../assets/php/Config.php');
require_once('../assets/php/Login.php');

if(Config::$isDemo == true) {
  require_once('../assets/php/RestDemoRequest.php');
} else {
  require_once('../assets/php/RestRequest.php');
}

$login = new Login();
if(!$login->checkSession()) {
  header('Location: security/login.php');
  exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <title>camunda PHP incubation demo</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../assets/vendor/twitter/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="../assets/vendor/twitter/bootstrap/css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="../assets/css/app.css" />

  <script src="../assets/vendor/jquery/js/jquery-1.9.1.js" language="javascript" type="text/javascript"></script>
  <script src="../assets/vendor/twitter/bootstrap/js/bootstrap.js" language="javascript" type="text/javascript"></script>
  <script src="../assets/js/"
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
      <div class="nav-collapse">
        <div class="btn-group">
          <button class="btn btn-mini" name="username"><?php echo $_SESSION['username'] ?></button>
          <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="?action=logout">Logout</a>
            </li>
          </ul>
        </div>
        <div class="btn-group">
          <button class="btn btn-mini" name="startProcess">Start Process... </button>
          <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <?php
            $processListRequest = new RestDemoRequest('ProcessDefinitions');
            foreach($processListRequest->getData() AS $data) {
              ?>
              <li>
                <a href="restService.php?action=startInstance&<?php echo $data->id; ?>"><?php echo $data->name; ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<nav class="container-fluid row-margin1 tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#Details">Details</a></li>
  </ul>
</nav>

<section class="container-fluid CA-container-fixed-height">
  <div class="row-fluid">
    <div class="span6 offset1">

    </div>
  </div>
</section>

<footer class="container-fluid">
  <p><a href="http://camunda.org">powered by camunda BPM</a> - Version: <?php echo Config::$applicationVersion ?>
</footer>
</body>
</html>
