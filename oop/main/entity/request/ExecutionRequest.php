<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 09.06.13
 * Time: 10:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class ExecutionRequest extends Request {
  protected $businessKey;
  protected $processDefinitionId;
  protected $processDefinitionKey;
  protected $processInstanceId;
  protected $activityId;
  protected $signalEventSubscriptionName;
  protected $messageEventSubscriptionName;
  protected $active;
  protected $suspended;
  protected $variables;
  protected $processVariables;
  protected $sortBy;
  protected $sortOrder;
  protected $firstResult;
  protected $maxResults;

  /**
   * @param mixed $active
   * @return $this
   */
  public function setActive($active) {
    $this->active = $active;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getActive() {
    return $this->active;
  }

  /**
   * @param mixed $suspended
   * @return $this
   */
  public function setSuspended($suspended) {
    $this->suspended = $suspended;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSuspended() {
    return $this->suspended;
  }

  /**
   * @param mixed $activityId
   * @return $this
   */
  public function setActivityId($activityId) {
    $this->activityId = $activityId;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getActivityId() {
    return $this->activityId;
  }

  /**
   * @param mixed $businessKey
   * @return $this
   */
  public function setBusinessKey($businessKey) {
    $this->businessKey = $businessKey;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getBusinessKey() {
    return $this->businessKey;
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
   * @param mixed $messageEventSubscriptionName
   * @return $this
   */
  public function setMessageEventSubscriptionName($messageEventSubscriptionName) {
    $this->messageEventSubscriptionName = $messageEventSubscriptionName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMessageEventSubscriptionName() {
    return $this->messageEventSubscriptionName;
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
   * @param mixed $signalEventSubscriptionName
   * @return $this
   */
  public function setSignalEventSubscriptionName($signalEventSubscriptionName) {
    $this->signalEventSubscriptionName = $signalEventSubscriptionName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSignalEventSubscriptionName() {
    return $this->signalEventSubscriptionName;
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