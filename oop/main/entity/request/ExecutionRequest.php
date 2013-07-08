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
  private $businessKey;
  private $processDefinitionId;
  private $processDefinitionKey;
  private $processInstanceId;
  private $activityId;
  private $signalEventSubscriptionName;
  private $messageEventSubscriptionName;
  private $variables;
  private $processVariables;
  private $sortBy;
  private $sortOrder;
  private $firstResult;
  private $maxResults;

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
   * @param mixed $businessKey
   */
  public function setBusinessKey($businessKey) {
    $this->businessKey = $businessKey;
  }

  /**
   * @return mixed
   */
  public function getBusinessKey() {
    return $this->businessKey;
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
   * @param mixed $messageEventSubscriptionName
   */
  public function setMessageEventSubscriptionName($messageEventSubscriptionName) {
    $this->messageEventSubscriptionName = $messageEventSubscriptionName;
  }

  /**
   * @return mixed
   */
  public function getMessageEventSubscriptionName() {
    return $this->messageEventSubscriptionName;
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
   * @param mixed $signalEventSubscriptionName
   */
  public function setSignalEventSubscriptionName($signalEventSubscriptionName) {
    $this->signalEventSubscriptionName = $signalEventSubscriptionName;
  }

  /**
   * @return mixed
   */
  public function getSignalEventSubscriptionName() {
    return $this->signalEventSubscriptionName;
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