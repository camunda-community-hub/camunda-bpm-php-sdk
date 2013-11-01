<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 10:48
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;

use org\camunda\php\sdk\helper\CastHelper;

class Activity extends CastHelper {
  protected $id;
  protected $activityId;
  protected $processInstanceId;
  protected $processDefinitionId;
  protected $childActivityInstances;
  protected $childTransitionInstances;
  protected $executionIds;

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
   * @param mixed $childActivityInstances
   */
  public function setChildActivityInstances($childActivityInstances) {
    $this->childActivityInstances = $childActivityInstances;
  }

  /**
   * @return mixed
   */
  public function getChildActivityInstances() {
    return $this->childActivityInstances;
  }

  /**
   * @param mixed $childTransitionInstances
   */
  public function setChildTransitionInstances($childTransitionInstances) {
    $this->childTransitionInstances = $childTransitionInstances;
  }

  /**
   * @return mixed
   */
  public function getChildTransitionInstances() {
    return $this->childTransitionInstances;
  }

  /**
   * @param mixed $executionIds
   */
  public function setExecutionIds($executionIds) {
    $this->executionIds = $executionIds;
  }

  /**
   * @return mixed
   */
  public function getExecutionIds() {
    return $this->executionIds;
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
   * @param mixed $processDefinitionId
   */
  public function setProcessDefinitionId($processDefinitionId) {
    $this->processDefinitionId = $processDefinitionId;
  }

  /**
   * @return mixed
   */
  public function getProcessDefinitionId() {
    return $this->processDefinitionId;
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