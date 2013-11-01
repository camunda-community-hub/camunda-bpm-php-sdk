<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 09.06.13
 * Time: 10:38
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class MessageSubscriptionRequest extends Request {
  protected $id;
  protected $eventType;
  protected $eventName;
  protected $executionId;
  protected $processInstanceId;
  protected $activityId;
  protected $createdDate;
  protected $messageName;
  protected $variables;

  /**
   * @param mixed $activityId
   */
  public function setActivityId($activityId) {
    $this->activityId = $activityId;
  }

  /**
   * @return mixed
   */
  public function getActivityId() {
    return $this->activityId;
  }

  /**
   * @param mixed $createdDate
   * @return $this
   */
  public function setCreatedDate($createdDate) {
    $this->createdDate = $createdDate;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCreatedDate() {
    return $this->createdDate;
  }

  /**
   * @param mixed $eventName
   * @return $this
   */
  public function setEventName($eventName) {
    $this->eventName = $eventName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getEventName() {
    return $this->eventName;
  }

  /**
   * @param mixed $eventType
   * @return $this
   */
  public function setEventType($eventType) {
    $this->eventType = $eventType;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getEventType() {
    return $this->eventType;
  }

  /**
   * @param mixed $executionId
   * @return $this
   */
  public function setExecutionId($executionId) {
    $this->executionId = $executionId;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getExecutionId() {
    return $this->executionId;
  }

  /**
   * @param mixed $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $messageName
   * @return $this
   */
  public function setMessageName($messageName) {
    $this->messageName = $messageName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMessageName() {
    return $this->messageName;
  }

  /**
   * @param mixed $processInstanceId
   * @return $this
   */
  public function setProcessInstanceId($processInstanceId) {
    $this->processInstanceId = $processInstanceId;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProcessInstanceId() {
    return $this->processInstanceId;
  }

  /**
   * @param mixed $variables
   * @return $this
   */
  public function setVariables($variables) {
    $this->variables = $variables;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getVariables() {
    return $this->variables;
  }


}