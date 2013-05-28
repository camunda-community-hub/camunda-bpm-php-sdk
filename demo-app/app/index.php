<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.05.13
 * Time: 10:32
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
    <li class="active"><a href="#tasks" data-toggle="tab">Tasks</a></li>
    <li><a href="#processInstances" data-toggle="tab">Process Instances</a></li>
    <li><a href="#processDefinitions" data-toggle="tab">Process Definitions</a></li>
  </ul>
</nav>

<section class="container-fluid CA-container-fixed-height">
  <div class="row-fluid">
    <div class="span6 offset1 tab-content">
      <div class="tab-pane active" id="tasks">
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Assignee</th>
            <th>created</th>
            <th>Due-Date</th>
          </tr>
          <?php
          $taskRequest = new RestDemoRequest('Tasks');
          foreach($taskRequest->getData() AS $data) {
            ?>
            <tr>
              <td><?php echo $data->id; ?></td>
              <td><?php echo $data->name; ?></td>
              <td><?php echo $data->assignee; ?></td>
              <td><?php echo $data->created; ?></td>
              <td><?php echo $data->due; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="tab-pane" id="processInstances">
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Process Definition</th>
            <th>Business Key</th>
          </tr>
          <?php
          $processInstanceRequest = new RestDemoRequest('ProcessInstances');
          foreach($processInstanceRequest->getData() AS $data) {
            ?>
            <tr>
              <td><?php echo $data->id; ?></td>
              <td><a href="showDetails.php?type=processDefinition&id=<?php echo $data->definitionId; ?>"><?php echo $data->definitionId; ?></a></td>
              <td><?php echo $data->businessKey; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="tab-pane" id="processDefinitions">
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Version</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
          <?php
          $processDefinitionsRequest = new RestDemoRequest('ProcessDefinitions');
          foreach($processDefinitionsRequest->getData() AS $data) {
            ?>
            <tr>
              <td><?php echo $data->id; ?></td>
              <td><?php echo $data->name; ?></td>
              <td><?php echo $data->version; ?></td>
              <td><?php echo $data->category; ?></td>
              <td>
                <a href="showDetails.php?type=processDefinition&id=<?php echo $data->id; ?>" class="btn btn-mini">Details</a>
                <a href="restService.php?action=startInstance&<?php echo $data->id; ?>" class="btn btn-mini">Start Instance</a>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>

<footer class="container-fluid">
  <p><a href="http://camunda.org">powered by camunda BPM</a> - Version: <?php echo Config::$applicationVersion ?>
</footer>
</body>
</html>
