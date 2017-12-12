<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class HistoricProcessInstanceRequest extends Request
{
    protected $processInstanceId;
    protected $processInstanceBusinessKey;
    protected $superProcessInstanceId;
    protected $processDefinitionId;
    protected $processDefinitionKey;
    protected $processDefinitionKeyNotIn;
    protected $finished;
    protected $unfinished;
    protected $startedBy;
    protected $startedBefore;
    protected $startedAfter;
    protected $finishedBefore;
    protected $finishedAfter;
    protected $variables;
    protected $sortBy;
    protected $sortOrder;
    protected $firstResult;
    protected $maxResults;

    /**
     * @param mixed $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finishedAfter
     */
    public function setFinishedAfter($finishedAfter)
    {
        $this->finishedAfter = $finishedAfter;
    }

    /**
     * @return mixed
     */
    public function getFinishedAfter()
    {
        return $this->finishedAfter;
    }

    /**
     * @param mixed $finishedBefore
     */
    public function setFinishedBefore($finishedBefore)
    {
        $this->finishedBefore = $finishedBefore;
    }

    /**
     * @return mixed
     */
    public function getFinishedBefore()
    {
        return $this->finishedBefore;
    }

    /**
     * @param mixed $firstResult
     */
    public function setFirstResult($firstResult)
    {
        $this->firstResult = $firstResult;
    }

    /**
     * @return mixed
     */
    public function getFirstResult()
    {
        return $this->firstResult;
    }

    /**
     * @param mixed $maxResults
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
    }

    /**
     * @return mixed
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @param mixed $processDefinitionId
     */
    public function setProcessDefinitionId($processDefinitionId)
    {
        $this->processDefinitionId = $processDefinitionId;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionId()
    {
        return $this->processDefinitionId;
    }

    /**
     * @param mixed $processDefinitionKey
     */
    public function setProcessDefinitionKey($processDefinitionKey)
    {
        $this->processDefinitionKey = $processDefinitionKey;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionKey()
    {
        return $this->processDefinitionKey;
    }

    /**
     * @param mixed $processDefinitionKeyNotIn
     */
    public function setProcessDefinitionKeyNotIn($processDefinitionKeyNotIn)
    {
        $this->processDefinitionKeyNotIn = $processDefinitionKeyNotIn;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionKeyNotIn()
    {
        return $this->processDefinitionKeyNotIn;
    }

    /**
     * @param mixed $processInstanceBusinessKey
     */
    public function setProcessInstanceBusinessKey($processInstanceBusinessKey)
    {
        $this->processInstanceBusinessKey = $processInstanceBusinessKey;
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceBusinessKey()
    {
        return $this->processInstanceBusinessKey;
    }

    /**
     * @param mixed $processInstanceId
     */
    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    /**
     * @param mixed $sortBy
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
    }

    /**
     * @return mixed
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * @param mixed $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param mixed $startedAfter
     */
    public function setStartedAfter($startedAfter)
    {
        $this->startedAfter = $startedAfter;
    }

    /**
     * @return mixed
     */
    public function getStartedAfter()
    {
        return $this->startedAfter;
    }

    /**
     * @param mixed $startedBefore
     */
    public function setStartedBefore($startedBefore)
    {
        $this->startedBefore = $startedBefore;
    }

    /**
     * @return mixed
     */
    public function getStartedBefore()
    {
        return $this->startedBefore;
    }

    /**
     * @param mixed $startedBy
     */
    public function setStartedBy($startedBy)
    {
        $this->startedBy = $startedBy;
    }

    /**
     * @return mixed
     */
    public function getStartedBy()
    {
        return $this->startedBy;
    }

    /**
     * @param mixed $superProcessInstanceId
     */
    public function setSuperProcessInstanceId($superProcessInstanceId)
    {
        $this->superProcessInstanceId = $superProcessInstanceId;
    }

    /**
     * @return mixed
     */
    public function getSuperProcessInstanceId()
    {
        return $this->superProcessInstanceId;
    }

    /**
     * @param mixed $unfinished
     */
    public function setUnfinished($unfinished)
    {
        $this->unfinished = $unfinished;
    }

    /**
     * @return mixed
     */
    public function getUnfinished()
    {
        return $this->unfinished;
    }

    /**
     * @param mixed $variables
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
    }

    /**
     * @return mixed
     */
    public function getVariables()
    {
        return $this->variables;
    }


}