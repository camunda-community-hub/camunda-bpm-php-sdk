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
  protected $processInstanceId;
  protected $processInstanceBusinessKey;
  protected $processDefinitionId;
  protected $processDefinitionKey;
  protected $processDefinitionName;
  protected $executionId;
  protected $assignee;
  protected $owner;
  protected $candidateGroup;
  protected $candidateUser;
  protected $involvedUser;
  protected $unassigned;
  protected $taskDefinitionKey;
  protected $taskDefinitionKeyLike;
  protected $name;
  protected $nameLike;
  protected $description;
  protected $descriptionLike;
  protected $priority;
  protected $maxPriority;
  protected $minPriority;
  protected $due;
  protected $dueAfter;
  protected $dueBefore;
  protected $created;
  protected $createdAfter;
  protected $createdBefore;
  protected $delegationState;
  protected $candidateGroups;
  protected $taskVariables;
  protected $processVariables;
  protected $sortBy;
  protected $sortOrder;
  protected $firstResult;
  protected $maxResults;
  protected $userId;
  protected $variables;
  protected $includeAssignedTasks;

  /**
   * @param mixed $assignee
   * @return $this
   */
  public function setAssignee($assignee) {
    $this->assignee = $assignee;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getAssignee() {
    return $this->assignee;
  }

  /**
   * @param mixed $candidateGroup
   * @return $this
   */
  public function setCandidateGroup($candidateGroup) {
    $this->candidateGroup = $candidateGroup;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCandidateGroup() {
    return $this->candidateGroup;
  }

  /**
   * @param mixed $candidateGroups
   * @return $this
   */
  public function setCandidateGroups($candidateGroups) {
    $this->candidateGroups = $candidateGroups;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCandidateGroups() {
    return $this->candidateGroups;
  }

  /**
   * @param mixed $candidateUser
   * @return $this
   */
  public function setCandidateUser($candidateUser) {
    $this->candidateUser = $candidateUser;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCandidateUser() {
    return $this->candidateUser;
  }

  /**
   * @param mixed $created
   * @return $this
   */
  public function setCreated($created) {
    $this->created = $created;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * @param mixed $createdAfter
   * @return $this
   */
  public function setCreatedAfter($createdAfter) {
    $this->createdAfter = $createdAfter;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCreatedAfter() {
    return $this->createdAfter;
  }

  /**
   * @param mixed $createdBefore
   * @return $this
   */
  public function setCreatedBefore($createdBefore) {
    $this->createdBefore = $createdBefore;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCreatedBefore() {
    return $this->createdBefore;
  }

  /**
   * @param mixed $delegationState
   * @return $this
   */
  public function setDelegationState($delegationState) {
    $this->delegationState = $delegationState;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDelegationState() {
    return $this->delegationState;
  }

  /**
   * @param mixed $description
   * @return $this
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param mixed $descriptionLike
   * @return $this
   */
  public function setDescriptionLike($descriptionLike) {
    $this->descriptionLike = $descriptionLike;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDescriptionLike() {
    return $this->descriptionLike;
  }

  /**
   * @param mixed $due
   * @return $this
   */
  public function setDue($due) {
    $this->due = $due;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDue() {
    return $this->due;
  }

  /**
   * @param mixed $dueAfter
   * @return $this
   */
  public function setDueAfter($dueAfter) {
    $this->dueAfter = $dueAfter;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDueAfter() {
    return $this->dueAfter;
  }

  /**
   * @param mixed $dueBefore
   * @return $this
   */
  public function setDueBefore($dueBefore) {
    $this->dueBefore = $dueBefore;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDueBefore() {
    return $this->dueBefore;
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
   * @param mixed $firstResult
   * @return $this
   */
  public function setFirstResult($firstResult) {
    $this->firstResult = $firstResult;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFirstResult() {
    return $this->firstResult;
  }

  /**
   * @param mixed $involvedUser
   * @return $this
   */
  public function setInvolvedUser($involvedUser) {
    $this->involvedUser = $involvedUser;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getInvolvedUser() {
    return $this->involvedUser;
  }

  /**
   * @param mixed $maxPriority
   * @return $this
   */
  public function setMaxPriority($maxPriority) {
    $this->maxPriority = $maxPriority;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMaxPriority() {
    return $this->maxPriority;
  }

  /**
   * @param mixed $maxResults
   * @return $this
   */
  public function setMaxResults($maxResults) {
    $this->maxResults = $maxResults;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMaxResults() {
    return $this->maxResults;
  }

  /**
   * @param mixed $minPriority
   * @return $this
   */
  public function setMinPriority($minPriority) {
    $this->minPriority = $minPriority;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMinPriority() {
    return $this->minPriority;
  }

  /**
   * @param mixed $name
   * @return $this
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $nameLike
   * @return $this
   */
  public function setNameLike($nameLike) {
    $this->nameLike = $nameLike;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getNameLike() {
    return $this->nameLike;
  }

  /**
   * @param mixed $owner
   * @return $this
   */
  public function setOwner($owner) {
    $this->owner = $owner;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getOwner() {
    return $this->owner;
  }

  /**
   * @param mixed $priority
   * @return $this
   */
  public function setPriority($priority) {
    $this->priority = $priority;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getPriority() {
    return $this->priority;
  }

  /**
   * @param mixed $processDefinitionId
   * @return $this
   */
  public function setProcessDefinitionId($processDefinitionId) {
    $this->processDefinitionId = $processDefinitionId;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProcessDefinitionId() {
    return $this->processDefinitionId;
  }

  /**
   * @param mixed $processDefinitionKey
   * @return $this
   */
  public function setProcessDefinitionKey($processDefinitionKey) {
    $this->processDefinitionKey = $processDefinitionKey;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProcessDefinitionKey() {
    return $this->processDefinitionKey;
  }

  /**
   * @param mixed $processDefinitionName
   * @return $this
   */
  public function setProcessDefinitionName($processDefinitionName) {
    $this->processDefinitionName = $processDefinitionName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProcessDefinitionName() {
    return $this->processDefinitionName;
  }

  /**
   * @param mixed $processInstanceBusinessKey
   * @return $this
   */
  public function setProcessInstanceBusinessKey($processInstanceBusinessKey) {
    $this->processInstanceBusinessKey = $processInstanceBusinessKey;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProcessInstanceBusinessKey() {
    return $this->processInstanceBusinessKey;
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
   * @param mixed $processVariables
   * @return $this
   */
  public function setProcessVariables($processVariables) {
    $this->processVariables = $processVariables;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getProcessVariables() {
    return $this->processVariables;
  }

  /**
   * @param mixed $sortBy
   * @return $this
   */
  public function setSortBy($sortBy) {
    $this->sortBy = $sortBy;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSortBy() {
    return $this->sortBy;
  }

  /**
   * @param mixed $sortOrder
   * @return $this
   */
  public function setSortOrder($sortOrder) {
    $this->sortOrder = $sortOrder;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSortOrder() {
    return $this->sortOrder;
  }

  /**
   * @param mixed $taskDefinitionKey
   * @return $this
   */
  public function setTaskDefinitionKey($taskDefinitionKey) {
    $this->taskDefinitionKey = $taskDefinitionKey;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getTaskDefinitionKey() {
    return $this->taskDefinitionKey;
  }

  /**
   * @param mixed $taskDefinitionKeyLike
   * @return $this
   */
  public function setTaskDefinitionKeyLike($taskDefinitionKeyLike) {
    $this->taskDefinitionKeyLike = $taskDefinitionKeyLike;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getTaskDefinitionKeyLike() {
    return $this->taskDefinitionKeyLike;
  }

  /**
   * @param mixed $taskVariables
   * @return $this
   */
  public function setTaskVariables($taskVariables) {
    $this->taskVariables = $taskVariables;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getTaskVariables() {
    return $this->taskVariables;
  }

  /**
   * @param mixed $unassigned
   * @return $this
   */
  public function setUnassigned($unassigned) {
    $this->unassigned = $unassigned;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getUnassigned() {
    return $this->unassigned;
  }

  /**
   * @param mixed $userId
   * @return $this
   */
  public function setUserId($userId) {
    $this->userId = $userId;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getUserId() {
    return $this->userId;
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

  /**
   * @param boolean $includeAssignedTasks
   * @return $this
   */
  public function setIncludeAssignedTasks($includeAssignedTasks) {
    $this->includeAssignedTasks = $includeAssignedTasks;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getIncludeAssignedTasks() {
    return $this->includeAssignedTasks;
  }
}
