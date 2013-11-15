<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:38
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class HistoricActivityInstanceRequest extends Request {
  protected $activityInstanceIds;
  protected $processInstanceId;
  protected $processDefinitionId;
  protected $executionId;
  protected $activityId;
  protected $activityName;
  protected $activityType;
  protected $taskAssignee;
  protected $finished;
  protected $unfinished;
  protected $sortBy;
  protected $sortOrder;
  protected $firstResult;
  protected $maxResults;

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
   * @param mixed $activityInstanceId
   */
  public function setActivityInstanceId($activityInstanceId) {
    $this->activityInstanceId = $activityInstanceId;
  }

  /**
   * @return mixed
   */
  public function getActivityInstanceId() {
    return $this->activityInstanceId;
  }

  /**
   * @param mixed $activityName
   */
  public function setActivityName($activityName) {
    $this->activityName = $activityName;
  }

  /**
   * @return mixed
   */
  public function getActivityName() {
    return $this->activityName;
  }

  /**
   * @param mixed $activityType
   */
  public function setActivityType($activityType) {
    $this->activityType = $activityType;
  }

  /**
   * @return mixed
   */
  public function getActivityType() {
    return $this->activityType;
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
   * @param mixed $finished
   */
  public function setFinished($finished) {
    $this->finished = $finished;
  }

  /**
   * @return mixed
   */
  public function getFinished() {
    return $this->finished;
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
   * @param mixed $taskAssignee
   */
  public function setTaskAssignee($taskAssignee) {
    $this->taskAssignee = $taskAssignee;
  }

  /**
   * @return mixed
   */
  public function getTaskAssignee() {
    return $this->taskAssignee;
  }

  /**
   * @param mixed $unfinished
   */
  public function setUnfinished($unfinished) {
    $this->unfinished = $unfinished;
  }

  /**
   * @return mixed
   */
  public function getUnfinished() {
    return $this->unfinished;
  }


}