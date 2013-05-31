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
 * Time: 13:27
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\example\overview;


class Login {
  private $username;
  private $password;

  public function __construct() {
    $this->username = '';
    $this->password = '';
    $this->session = null;
  }

  public function setCredentials($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  public function getUsername() {
    return $this->username;
  }

  /**
   * Log us into our website or throw an error if we have forgotten the username
   * Be aware!: This is a demo so we don't have implemented any security feature
   *
   * @return Error thrown if username empty
   */
  public function doLogin() {
    $error = null;
    if($this->checkLogin()) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['isLoggedIn'] = true;
      $_SESSION['lastActivity'] = time();
      $error = true;
    } else {
      $error = new Error();
      $error->setMessage('Please enter a username');
    }
    return $error;
  }

  /**
   * Checks if the username is empty - the only AT for "security"
   *
   * @return bool username empty or not
   */
  private function checkLogin() {
    if($this->username == '') {
      return false;
    } else {
      return true;
    }
  }

  public function checkSession() {
    if(!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
      return false;
    } else {
      if(time() - $_SESSION['lastActivity'] > 1800 || (isset($_GET['action']) && $_GET['action'] == 'logout')) {
        session_unset();
        session_destroy();
        return false;
      } else {
        $_SESSION['lastActivity'] = time();
        return true;
      }
    }
  }
}
