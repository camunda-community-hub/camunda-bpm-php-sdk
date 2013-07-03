<?php
/**
 * Copyright 2013 camunda services GmbH
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 *limitations under the License.
 *
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.05.13
 * Time: 10:32
 * To change this template use File | Settings | File Templates.
 */
namespace org\camunda\php\example\overview;

session_start();

require_once('../assets/php/Config.php');
require_once('../assets/php/Login.php');
require_once('../../../sdk/camundaRestClient.php');

if(Config::$isDemo == true) {
  require_once('../assets/php/example/RestRequest.php');
} else {
  require_once('../assets/php/RestRequest.php');
}

$login = new Login();
if(!$login->checkSession()) {
  header('Location: security/login.php');
  exit();
}
$restRequest = new RestRequest("http://localhost:8080/engine-rest");
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
            foreach($restRequest->getProcessDefinitions() AS $data) {
              ?>
              <li>
                <a href="restService.php?action=startInstance&id=<?php echo $data->id ?>"><?php echo $data->name; ?></a>
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
    <div class="span10 offset1 tab-content">
      <div class="tab-pane active" id="tasks">
        <p>Total: <?php echo $restRequest->getTaskCount()->count ?></p>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Assignee</th>
            <th>created</th>
            <th>Due-Date</th>
          </tr>
          <?php
          foreach($restRequest->getTasks() AS $data) {
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
        <p>Total: <?php echo $restRequest->getProcessInstanceCount()->count ?></p>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Process Definition</th>
            <th>Business Key</th>
          </tr>
          <?php
          foreach($restRequest->getProcessInstances() AS $data) {
            ?>
            <tr>
              <td><?php echo $data->id; ?></td>
              <td><a href="showDetails.php?type=processDefinition&id=<?php echo $data->id; ?>"><?php echo $restRequest->getSingleProcessDefinition($data->definitionId)->name; ?></a></td>
              <td><?php echo $data->businessKey; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
      <div class="tab-pane" id="processDefinitions">
        <p>Total: <?php echo $restRequest->getProcessDefinitionCount()->count ?></p>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Version</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
          <?php
          foreach($restRequest->getProcessDefinitions() AS $data) {
            ?>
            <tr>
              <td><?php echo $data->id; ?></td>
              <td><?php echo $data->name; ?></td>
              <td><?php echo $data->version; ?></td>
              <td>
                <a href="showDetails.php?id=<?php echo $data->id; ?>" class="btn btn-mini">Details</a>
                <a href="restService.php?action=startInstance&id=<?php echo $data->id; ?>" class="btn btn-mini">Start Instance</a>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>

<footer class="container-fluid">
  <p><a href="http://camunda.org">powered by camunda BPM</a> - Version: <?php echo Config::$applicationVersion ?></p>
</footer>
</body>
</html>
