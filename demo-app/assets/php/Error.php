<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.05.13
 * Time: 13:06
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\demo\php;


class Error {
  private $message;

  public function __construct() {
    $this->message = '';
  }

  public function setMessage($message) {
    $this->message = $message;
  }

  public function getMessage() {
    return $this->message;
  }
}