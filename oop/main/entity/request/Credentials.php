<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 20:46
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

use org\camunda\php\sdk\entity\request\Request;

class Credentials extends Request {
  private $username;
  private $password;
  private $apiKey;

  public function __construct($parameterArray = null) {
    if($parameterArray != null && !empty($parameterArray)) {
      if(array_key_exists('username', $parameterArray)) {
        $this->username = $parameterArray['username'];
      }
      if(array_key_exists('password', $parameterArray)) {
        $this->password = $parameterArray['password'];
      }
      if(array_key_exists('apiKey', $parameterArray)) {
        $this->apiKey = $parameterArray['apiKey'];
      }
      if( !array_key_exists('username', $parameterArray) &&
          !array_key_exists('password', $parameterArray) &&
          !array_key_exists('apiKey', $parameterArray)) {
        throw new \UnexpectedValueException;
      }
    }
  }

  /**
   * @param String $apiKey
   */
  public function setApiKey($apiKey) {
    $this->apiKey = $apiKey;
  }

  /**
   * @return String
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * @param String $password
   */
  public function setPassword($password) {
    $this->password = $password;
  }

  /**
   * @return String
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param String $username
   */
  public function setUsername($username) {
    $this->username = $username;
  }

  /**
   * @return String
   */
  public function getUsername() {
    return $this->username;
  }
}