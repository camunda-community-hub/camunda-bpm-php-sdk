<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 09.06.13
 * Time: 10:38
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;

use org\camunda\php\sdk\helper\CastHelper;

class MessageSubscription extends CastHelper {
  protected $id;
  protected $eventType;
  protected $eventName;
  protected $executionId;
  protected $processInstanceId;
  protected $activityId;

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
   * @param mixed $eventName
   */
  public function setEventName($eventName) {
    $this->eventName = $eventName;
  }

  /**
   * @return mixed
   */
  public function getEventName() {
    return $this->eventName;
  }

  /**
   * @param mixed $eventType
   */
  public function setEventType($eventType) {
    $this->eventType = $eventType;
  }

  /**
   * @return mixed
   */
  public function getEventType() {
    return $this->eventType;
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


}