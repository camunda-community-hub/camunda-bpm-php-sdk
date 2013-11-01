<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:35
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;
use org\camunda\php\sdk\helper\CastHelper;

class Job extends CastHelper {
  protected $id;
  protected $dueDate;
  protected $processInstanceId;
  protected $executionId;
  protected $retries;
  protected $exceptionMessage;

  /**
   * @param mixed $dueDate
   */
  public function setDueDate($dueDate) {
    $this->dueDate = $dueDate;
  }

  /**
   * @return mixed
   */
  public function getDueDate() {
    return $this->dueDate;
  }

  /**
   * @param mixed $exceptionMessage
   */
  public function setExceptionMessage($exceptionMessage) {
    $this->exceptionMessage = $exceptionMessage;
  }

  /**
   * @return mixed
   */
  public function getExceptionMessage() {
    return $this->exceptionMessage;
  }

  /**
   * @param mixed $executionId
   */
  public function setExecutionId($executionId) {
    $this->executionId = $executionId;
  }

  /**
   * @return mixed
   */
  public function getExecutionId() {
    return $this->executionId;
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
   * @param mixed $retries
   */
  public function setRetries($retries) {
    $this->retries = $retries;
  }

  /**
   * @return mixed
   */
  public function getRetries() {
    return $this->retries;
  }


}