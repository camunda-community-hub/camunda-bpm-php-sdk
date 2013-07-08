<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 09.06.13
 * Time: 10:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;

use org\camunda\php\sdk\helper\CastHelper;

class Execution extends CastHelper {
  protected $id;
  protected $processInstanceId;
  protected $definitionId;
  protected $businessKey;
  protected $suspended;
  protected $ended;

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
   * @param mixed $definitionId
   */
  public function setDefinitionId($definitionId) {
    $this->definitionId = $definitionId;
  }

  /**
   * @return mixed
   */
  public function getDefinitionId() {
    return $this->definitionId;
  }

  /**
   * @param mixed $ended
   */
  public function setEnded($ended) {
    $this->ended = $ended;
  }

  /**
   * @return mixed
   */
  public function getEnded() {
    return $this->ended;
  }

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $processInstanceId
   */
  public function setProcessInstanceId($processInstanceId) {
    $this->processInstanceId = $processInstanceId;
  }

  /**
   * @return mixed
   */
  public function getProcessInstanceId() {
    return $this->processInstanceId;
  }

  /**
   * @param mixed $suspended
   */
  public function setSuspended($suspended) {
    $this->suspended = $suspended;
  }

  /**
   * @return mixed
   */
  public function getSuspended() {
    return $this->suspended;
  }


}