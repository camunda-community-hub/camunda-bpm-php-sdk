<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 21:07
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;

use org\camunda\php\sdk\helper\CastHelper;

class Task extends CastHelper{
  protected $id;
  protected $key;
  protected $name;
  protected $assignee;
  protected $created;
  protected $due;
  protected $delegationState;
  protected $description;
  protected $executionId;
  protected $owner;
  protected $parentTaskId;
  protected $priority;
  protected $processDefinitionId;
  protected $processInstanceId;
  protected $taskDefinitionId;

  /**
   * @param mixed $assignee
   */
  public function setAssignee($assignee) {
    $this->assignee = $assignee;
  }

  /**
   * @return mixed
   */
  public function getAssignee() {
    return $this->assignee;
  }

  /**
   * @param mixed $created
   */
  public function setCreated($created) {
    $this->created = $created;
  }

  /**
   * @return mixed
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * @param mixed $delegationState
   */
  public function setDelegationState($delegationState) {
    $this->delegationState = $delegationState;
  }

  /**
   * @return mixed
   */
  public function getDelegationState() {
    return $this->delegationState;
  }

  /**
   * @param mixed $description
   */
  public function setDescription($description) {
    $this->description = $description;
  }

  /**
   * @return mixed
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param mixed $due
   */
  public function setDue($due) {
    $this->due = $due;
  }

  /**
   * @return mixed
   */
  public function getDue() {
    return $this->due;
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
   * @param mixed $key
   */
  public function setKey($key) {
    $this->key = $key;
  }

  /**
   * @return mixed
   */
  public function getKey() {
    return $this->key;
  }

  /**
   * @param mixed $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $owner
   */
  public function setOwner($owner) {
    $this->owner = $owner;
  }

  /**
   * @return mixed
   */
  public function getOwner() {
    return $this->owner;
  }

  /**
   * @param mixed $parentTaskId
   */
  public function setParentTaskId($parentTaskId) {
    $this->parentTaskId = $parentTaskId;
  }

  /**
   * @return mixed
   */
  public function getParentTaskId() {
    return $this->parentTaskId;
  }

  /**
   * @param mixed $priority
   */
  public function setPriority($priority) {
    $this->priority = $priority;
  }

  /**
   * @return mixed
   */
  public function getPriority() {
    return $this->priority;
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

  /**
   * @param mixed $taskDefinitionId
   */
  public function setTaskDefinitionId($taskDefinitionId) {
    $this->taskDefinitionId = $taskDefinitionId;
  }

  /**
   * @return mixed
   */
  public function getTaskDefinitionId() {
    return $this->taskDefinitionId;
  }


}