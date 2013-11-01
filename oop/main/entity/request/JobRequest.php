<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:34
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class JobRequest extends Request {
  protected $jobId;
  protected $processInstanceId;
  protected $executionId;
  protected $withRetriesLeft;
  protected $executable;
  protected $timers;
  protected $messages;
  protected $dueDate;

  /**
   * @param mixed $dueDate
   */
  public function setDueDate($dueDate) {
    $this->dueDate = $dueDate;
  }

  /**
   * @return mixed
   */
  public function getDueDate() {
    return $this->dueDate;
  }
  protected $dueDates;
  protected $withException;
  protected $sortBy;
  protected $sortOrder;
  protected $firstResult;
  protected $maxResults;

  /**
   * @param mixed $dueDates
   * @return $this
   */
  public function setDueDates($dueDates) {
    $this->dueDates = $dueDates;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDueDates() {
    return $this->dueDates;
  }

  /**
   * @param mixed $executable
   * @return $this
   */
  public function setExecutable($executable) {
    $this->executable = $executable;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getExecutable() {
    return $this->executable;
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
   * @param mixed $jobId
   * @return $this
   */
  public function setJobId($jobId) {
    $this->jobId = $jobId;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getJobId() {
    return $this->jobId;
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
   * @param mixed $messages
   * @return $this
   */
  public function setMessages($messages) {
    $this->messages = $messages;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMessages() {
    return $this->messages;
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
   * @param mixed $timers
   * @return $this
   */
  public function setTimers($timers) {
    $this->timers = $timers;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getTimers() {
    return $this->timers;
  }

  /**
   * @param mixed $withException
   * @return $this
   */
  public function setWithException($withException) {
    $this->withException = $withException;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getWithException() {
    return $this->withException;
  }

  /**
   * @param mixed $withRetriesLeft
   * @return $this
   */
  public function setWithRetriesLeft($withRetriesLeft) {
    $this->withRetriesLeft = $withRetriesLeft;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getWithRetriesLeft() {
    return $this->withRetriesLeft;
  }


}