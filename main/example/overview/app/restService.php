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
 *
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 27.05.13
 * Time: 15:59
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

if(isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'startInstance':
      $restRequest->startProcessInstance($_GET['id']);
      header('Location: index.php#processInstances');
      break;
    default:
      header('Location: '.$_SERVER['HTTP_REFERER']);
      break;
  }
}


