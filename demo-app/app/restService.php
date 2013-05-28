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