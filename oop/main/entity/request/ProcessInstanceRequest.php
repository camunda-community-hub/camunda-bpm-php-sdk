<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 21:07
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class ProcessInstanceRequest extends Request {
  private $businessKey;
  private $processDefinitionId;
  private $processDefinitionKey;
  private $superProcessInstance;
  private $subProcessInstance;
  private $active;
  private $suspended;
  private $variables;
  private $sortBy;
  private $sortOrder;
  private $deleteReason;
  private $firstResult;
  private $maxResults;

  /**
   * @param mixed $active
   */
  public function setActive($active) {
    $this->active = $active;
  }

  /**
   * @return mixed
   */
  public function getActive() {
    return $this->active;
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
   * @param mixed $deleteReason
   */
  public function setDeleteReason($deleteReason) {
    $this->deleteReason = $deleteReason;
  }

  /**
   * @return mixed
   */
  public function getDeleteReason() {
    return $this->deleteReason;
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
   * @param mixed $subProcessInstance
   */
  public function setSubProcessInstance($subProcessInstance) {
    $this->subProcessInstance = $subProcessInstance;
  }

  /**
   * @return mixed
   */
  public function getSubProcessInstance() {
    return $this->subProcessInstance;
  }

  /**
   * @param mixed $superProcessInstance
   */
  public function setSuperProcessInstance($superProcessInstance) {
    $this->superProcessInstance = $superProcessInstance;
  }

  /**
   * @return mixed
   */
  public function getSuperProcessInstance() {
    return $this->superProcessInstance;
  }

  /**
   * @param mixed $suspended
   */
  public function setSuspended($suspended) {
    $this->suspended = $suspended;
  }

  /**
   * @return mixed
   */
  public function getSuspended() {
    return $this->suspended;
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