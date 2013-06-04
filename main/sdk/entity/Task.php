<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.05.13
 * Time: 18:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity;


class Task {
  private $id;
  private $name;
  private $assignee;
  private $owner;
  private $created;
  private $due;
  private $delegationState;
  private $description;
  private $executionId;
  private $parentTaskId;
  private $priority;
  private $processDefinitionId;
  private $processInstanceId;
  private $taskDefinitionKey;

  public function setId($id) {
    $this->id = $id;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setAssignee($assignee) {
    $this->assignee = $assignee;
  }

  public function setOwner($owner) {
    $this->owner = $owner;
  }

  public function setCreated($created) {
    $this->created = $created;
  }

  public function setDue($due) {
    $this->due = $due;
  }

  public function setDelegationState($delegationState) {
    $this->delegationState = $delegationState;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setExecutionId($executionId) {
    $this->executionId = $executionId;
  }

  public function setParentTaskId($parentTaskId) {
    $this->parentTaskId = $parentTaskId;
  }

  public function setPriority($priority) {
    $this->priority = $priority;
  }

  public function setProcessDefinitionId($processDefinitionId) {
    $this->processDefinitionId = $processDefinitionId;
  }

  public function setProcessInstanceId($processInstanceId) {
    $this->processInstanceId = $processInstanceId;
  }

  public function setTaskDefinitionKey($taskDefinitionKey) {
    $this->taskDefinitionKey = $taskDefinitionKey;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getAssignee() {
    return $this->assignee;
  }

  public function getOwner() {
    return $this->owner;
  }

  public function getCreated() {
    return $this->created;
  }

  public function getDue() {
    return $this->due;
  }

  public function getDelegationState() {
    return $this->delegationState;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getExecutionId() {
    return $this->executionId;
  }

  public function getParentTaskId() {
    return $this->parentTaskId;
  }

  public function getPriority() {
    return $this->priority;
  }

  public function getProcessDefinitionId() {
    return $this->processDefinitionId;
  }

  public function getProcessInstanceId() {
    return $this->processInstanceId;
  }

  public function getTaskDefinitionKey() {
    return $this->taskDefinitionKey;
  }
}