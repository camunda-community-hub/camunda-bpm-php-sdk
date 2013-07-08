<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 21:07
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class TaskRequest extends Request {
  private $processInstanceId;
  private $processInstanceBusinessKey;
  private $processDefinitionId;
  private $processDefinitionKey;
  private $processDefinitionName;
  private $executionId;
  private $assignee;
  private $owner;
  private $candidateGroup;
  private $candidateUser;
  private $involvedUser;
  private $unassigned;
  private $taskDefinitionKey;
  private $taskDefinitionKeyLike;
  private $name;
  private $nameLike;
  private $description;
  private $descriptionLike;
  private $priority;
  private $maxPriority;
  private $minPriority;
  private $due;
  private $dueAfter;
  private $dueBefore;
  private $created;
  private $createdAfter;
  private $createdBefore;
  private $delegationState;
  private $candidateGroups;
  private $taskVariables;
  private $processVariables;
  private $sortBy;
  private $sortOrder;
  private $firstResult;
  private $maxResults;
  private $userId;
  private $variables;

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
   * @param mixed $candidateGroup
   */
  public function setCandidateGroup($candidateGroup) {
    $this->candidateGroup = $candidateGroup;
  }

  /**
   * @return mixed
   */
  public function getCandidateGroup() {
    return $this->candidateGroup;
  }

  /**
   * @param mixed $candidateGroups
   */
  public function setCandidateGroups($candidateGroups) {
    $this->candidateGroups = $candidateGroups;
  }

  /**
   * @return mixed
   */
  public function getCandidateGroups() {
    return $this->candidateGroups;
  }

  /**
   * @param mixed $candidateUser
   */
  public function setCandidateUser($candidateUser) {
    $this->candidateUser = $candidateUser;
  }

  /**
   * @return mixed
   */
  public function getCandidateUser() {
    return $this->candidateUser;
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
   * @param mixed $createdAfter
   */
  public function setCreatedAfter($createdAfter) {
    $this->createdAfter = $createdAfter;
  }

  /**
   * @return mixed
   */
  public function getCreatedAfter() {
    return $this->createdAfter;
  }

  /**
   * @param mixed $createdBefore
   */
  public function setCreatedBefore($createdBefore) {
    $this->createdBefore = $createdBefore;
  }

  /**
   * @return mixed
   */
  public function getCreatedBefore() {
    return $this->createdBefore;
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
   * @param mixed $descriptionLike
   */
  public function setDescriptionLike($descriptionLike) {
    $this->descriptionLike = $descriptionLike;
  }

  /**
   * @return mixed
   */
  public function getDescriptionLike() {
    return $this->descriptionLike;
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
   * @param mixed $dueAfter
   */
  public function setDueAfter($dueAfter) {
    $this->dueAfter = $dueAfter;
  }

  /**
   * @return mixed
   */
  public function getDueAfter() {
    return $this->dueAfter;
  }

  /**
   * @param mixed $dueBefore
   */
  public function setDueBefore($dueBefore) {
    $this->dueBefore = $dueBefore;
  }

  /**
   * @return mixed
   */
  public function getDueBefore() {
    return $this->dueBefore;
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
   * @param mixed $firstResult
   */
  public function setFirstResult($firstResult) {
    $this->firstResult = $firstResult;
  }

  /**
   * @return mixed
   */
  public function getFirstResult() {
    return $this->firstResult;
  }

  /**
   * @param mixed $involvedUser
   */
  public function setInvolvedUser($involvedUser) {
    $this->involvedUser = $involvedUser;
  }

  /**
   * @return mixed
   */
  public function getInvolvedUser() {
    return $this->involvedUser;
  }

  /**
   * @param mixed $maxPriority
   */
  public function setMaxPriority($maxPriority) {
    $this->maxPriority = $maxPriority;
  }

  /**
   * @return mixed
   */
  public function getMaxPriority() {
    return $this->maxPriority;
  }

  /**
   * @param mixed $maxResults
   */
  public function setMaxResults($maxResults) {
    $this->maxResults = $maxResults;
  }

  /**
   * @return mixed
   */
  public function getMaxResults() {
    return $this->maxResults;
  }

  /**
   * @param mixed $minPriority
   */
  public function setMinPriority($minPriority) {
    $this->minPriority = $minPriority;
  }

  /**
   * @return mixed
   */
  public function getMinPriority() {
    return $this->minPriority;
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
   * @param mixed $nameLike
   */
  public function setNameLike($nameLike) {
    $this->nameLike = $nameLike;
  }

  /**
   * @return mixed
   */
  public function getNameLike() {
    return $this->nameLike;
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
   * @param mixed $processDefinitionKey
   */
  public function setProcessDefinitionKey($processDefinitionKey) {
    $this->processDefinitionKey = $processDefinitionKey;
  }

  /**
   * @return mixed
   */
  public function getProcessDefinitionKey() {
    return $this->processDefinitionKey;
  }

  /**
   * @param mixed $processDefinitionName
   */
  public function setProcessDefinitionName($processDefinitionName) {
    $this->processDefinitionName = $processDefinitionName;
  }

  /**
   * @return mixed
   */
  public function getProcessDefinitionName() {
    return $this->processDefinitionName;
  }

  /**
   * @param mixed $processInstanceBusinessKey
   */
  public function setProcessInstanceBusinessKey($processInstanceBusinessKey) {
    $this->processInstanceBusinessKey = $processInstanceBusinessKey;
  }

  /**
   * @return mixed
   */
  public function getProcessInstanceBusinessKey() {
    return $this->processInstanceBusinessKey;
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

  /**
   * @param mixed $sortBy
   */
  public function setSortBy($sortBy) {
    $this->sortBy = $sortBy;
  }

  /**
   * @return mixed
   */
  public function getSortBy() {
    return $this->sortBy;
  }

  /**
   * @param mixed $sortOrder
   */
  public function setSortOrder($sortOrder) {
    $this->sortOrder = $sortOrder;
  }

  /**
   * @return mixed
   */
  public function getSortOrder() {
    return $this->sortOrder;
  }

  /**
   * @param mixed $taskDefinitionKey
   */
  public function setTaskDefinitionKey($taskDefinitionKey) {
    $this->taskDefinitionKey = $taskDefinitionKey;
  }

  /**
   * @return mixed
   */
  public function getTaskDefinitionKey() {
    return $this->taskDefinitionKey;
  }

  /**
   * @param mixed $taskDefinitionKeyLike
   */
  public function setTaskDefinitionKeyLike($taskDefinitionKeyLike) {
    $this->taskDefinitionKeyLike = $taskDefinitionKeyLike;
  }

  /**
   * @return mixed
   */
  public function getTaskDefinitionKeyLike() {
    return $this->taskDefinitionKeyLike;
  }

  /**
   * @param mixed $taskVariables
   */
  public function setTaskVariables($taskVariables) {
    $this->taskVariables = $taskVariables;
  }

  /**
   * @return mixed
   */
  public function getTaskVariables() {
    return $this->taskVariables;
  }

  /**
   * @param mixed $unassigned
   */
  public function setUnassigned($unassigned) {
    $this->unassigned = $unassigned;
  }

  /**
   * @return mixed
   */
  public function getUnassigned() {
    return $this->unassigned;
  }

  /**
   * @param mixed $userId
   */
  public function setUserId($userId) {
    $this->userId = $userId;
  }

  /**
   * @return mixed
   */
  public function getUserId() {
    return $this->userId;
  }

  /**
   * @param mixed $variables
   */
  public function setVariables($variables) {
    $this->variables = $variables;
  }

  /**
   * @return mixed
   */
  public function getVariables() {
    return $this->variables;
  }


}