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
  protected $name;
  protected $nameLike;
  protected $deploymentId;
  protected $key;
  protected $keyLike;
  protected $category;
  protected $categoryLike;
  protected $ver;
  protected $latest;
  protected $resourceName;
  protected $resourceNameLike;
  protected $startableBy;
  protected $active;
  protected $suspended;
  protected $incidentId;
  protected $incidentType;
  protected $incidentMessage;
  protected $incidentMessageLike;
  protected $sortBy;
  protected $sortOrder;
  protected $firstResult;
  protected $maxResults;
  protected $variables;
  protected $businessKey;
  protected $caseInstanceId;

  /**
   * @return mixed
   */
  public function getName() {
      return $this->name;
  }

  /**
   * @param mixed $name
   * @return this
   */
  public function setName($name) {
      $this->name = $name;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getNameLike() {
      return $this->nameLike;
  }

  /**
   * @param mixed $nameLike
   * @return this
   */
  public function setNameLike($nameLike) {
      $this->nameLike = $nameLike;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getDeploymentId() {
      return $this->deploymentId;
  }

  /**
   * @param mixed $deploymentId
   * @return this
   */
  public function setDeploymentId($deploymentId) {
      $this->deploymentId = $deploymentId;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getKey() {
      return $this->key;
  }

  /**
   * @param mixed $key
   * @return this
   */
  public function setKey($key) {
      $this->key = $key;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getKeyLike() {
      return $this->keyLike;
  }

  /**
   * @param mixed $keyLike
   * @return this
   */
  public function setKeyLike($keyLike) {
      $this->keyLike = $keyLike;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getCategory() {
      return $this->category;
  }

  /**
   * @param mixed $category
   * @return this
   */
  public function setCategory($category) {
      $this->category = $category;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getCategoryLike() {
      return $this->categoryLike;
  }

  /**
   * @param mixed $categoryLike
   * @return this
   */
  public function setCategoryLike($categoryLike) {
      $this->categoryLike = $categoryLike;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getVer() {
      return $this->ver;
  }

  /**
   * @param mixed $ver
   * @return this
   */
  public function setVer($ver) {
      $this->ver = $ver;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getLatest() {
      return $this->latest;
  }

  /**
   * @param mixed $latest
   * @return this
   */
  public function setLatest($latest) {
      $this->latest = $latest;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getResourceName() {
      return $this->resourceName;
  }

  /**
   * @param mixed $resourceName
   * @return this
   */
  public function setResourceName($resourceName) {
      $this->resourceName = $resourceName;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getResourceNameLike() {
      return $this->resourceNameLike;
  }

  /**
   * @param mixed $resourceNameLike
   * @return this
   */
  public function setResourceNameLike($resourceNameLike) {
      $this->resourceNameLike = $resourceNameLike;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getStartableBy() {
      return $this->startableBy;
  }

  /**
   * @param mixed $startableBy
   * @return this
   */
  public function setStartableBy($startableBy) {
      $this->startableBy = $startableBy;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getActive() {
      return $this->active;
  }

  /**
   * @param mixed $active
   * @return this
   */
  public function setActive($active) {
      $this->active = $active;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getSuspended() {
      return $this->suspended;
  }

  /**
   * @param mixed $suspended
   * @return this
   */
  public function setSuspended($suspended) {
      $this->suspended = $suspended;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getIncidentId() {
      return $this->incidentId;
  }

  /**
   * @param mixed $incidentId
   * @return this
   */
  public function setIncidentId($incidentId) {
      $this->incidentId = $incidentId;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getIncidentType() {
      return $this->incidentType;
  }

  /**
   * @param mixed $incidentType
   * @return this
   */
  public function setIncidentType($incidentType) {
      $this->incidentType = $incidentType;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getIncidentMessage() {
      return $this->incidentMessage;
  }

  /**
   * @param mixed $incidentMessage
   * @return this
   */
  public function setIncidentMessage($incidentMessage) {
      $this->incidentMessage = $incidentMessage;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getIncidentMessageLike() {
      return $this->incidentMessageLike;
  }

  /**
   * @param mixed $incidentMessageLike
   * @return this
   */
  public function setIncidentMessageLike($incidentMessageLike) {
      $this->incidentMessageLike = $incidentMessageLike;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getSortBy() {
      return $this->sortBy;
  }

  /**
   * @param mixed $sortBy
   * @return this
   */
  public function setSortBy($sortBy) {
      $this->sortBy = $sortBy;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getSortOrder() {
      return $this->sortOrder;
  }

  /**
   * @param mixed $sortOrder
   * @return this
   */
  public function setSortOrder($sortOrder) {
      $this->sortOrder = $sortOrder;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getFirstResult() {
      return $this->firstResult;
  }

  /**
   * @param mixed $firstResult
   * @return this
   */
  public function setFirstResult($firstResult) {
      $this->firstResult = $firstResult;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getMaxResults() {
      return $this->maxResults;
  }

  /**
   * @param mixed $maxResults
   * @return this
   */
  public function setMaxResults($maxResults) {
      $this->maxResults = $maxResults;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getVariables() {
      return $this->variables;
  }

  /**
   * @param mixed $variables
   * @return this
   */
  public function setVariables($variables) {
      $this->variables = $variables;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getBusinessKey() {
      return $this->businessKey;
  }

  /**
   * @param mixed $businessKey
   * @return this
   */
  public function setBusinessKey($businessKey) {
      $this->businessKey = $businessKey;
      return $this;
  }

  /**
   * @return mixed
   */
  public function getCaseInstanceId() {
      return $this->caseInstanceId;
  }

  /**
   * @param mixed $caseInstanceId
   * @return this
   */
  public function setCaseInstanceId($caseInstanceId) {
      $this->caseInstanceId = $caseInstanceId;
      return $this;
  }
}