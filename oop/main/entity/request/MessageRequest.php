<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 09.06.13
 * Time: 10:38
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class MessageRequest extends Request {
  private $messageName;
  private $businessKey;
  private $correlationKeys;
  private $processVariables;

  /**
   * @param mixed $businessKey
   */
  public function setBusinessKey($businessKey) {
    $this->businessKey = $businessKey;
  }

  /**
   * @return mixed
   */
  public function getBusinessKey() {
    return $this->businessKey;
  }

  /**
   * @param mixed $correlationKeys
   */
  public function setCorrelationKeys($correlationKeys) {
    $this->correlationKeys = $correlationKeys;
  }

  /**
   * @return mixed
   */
  public function getCorrelationKeys() {
    return $this->correlationKeys;
  }

  /**
   * @param mixed $messageName
   */
  public function setMessageName($messageName) {
    $this->messageName = $messageName;
  }

  /**
   * @return mixed
   */
  public function getMessageName() {
    return $this->messageName;
  }

  /**
   * @param mixed $processVariables
   */
  public function setProcessVariables($processVariables) {
    $this->processVariables = $processVariables;
  }

  /**
   * @return mixed
   */
  public function getProcessVariables() {
    return $this->processVariables;
  }


}