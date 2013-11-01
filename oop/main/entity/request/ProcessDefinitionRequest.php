<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 09.06.13
 * Time: 10:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class ProcessDefinitionRequest extends Request {
  protected $businessKey;
  protected $processDefinitionId;
  protected $processDefinitionKey;
  protected $superProcessInstance;
  protected $subProcessInstance;
  protected $active;
  protected $suspended;
  protected $variables;
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
   * @param mixed $subProcessInstance
   * @return $this
   */
  public function setSubProcessInstance($subProcessInstance) {
    $this->subProcessInstance = $subProcessInstance;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSubProcessInstance() {
    return $this->subProcessInstance;
  }

  /**
   * @param mixed $superProcessInstance
   * @return $this
   */
  public function setSuperProcessInstance($superProcessInstance) {
    $this->superProcessInstance = $superProcessInstance;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSuperProcessInstance() {
    return $this->superProcessInstance;
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