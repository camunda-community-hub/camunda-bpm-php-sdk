<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:35
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class VariableInstanceRequest extends Request
{
    protected $variableName;
    protected $variableNameLike;
    protected $processInstanceIdIn;
    protected $executionIdIn;
    protected $taskIdIn;
    protected $activityInstanceIdIn;
    protected $variableValues;
    protected $sortBy;
    protected $sortOrder;
    protected $firstResult;
    protected $maxResults;

    /**
     * @param mixed $activityInstanceIdIn
     * @return $this
     */
    public function setActivityInstanceIdIn($activityInstanceIdIn)
    {
        $this->activityInstanceIdIn = $activityInstanceIdIn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActivityInstanceIdIn()
    {
        return $this->activityInstanceIdIn;
    }

    /**
     * @param mixed $executionIdIn
     * @return $this
     */
    public function setExecutionIdIn($executionIdIn)
    {
        $this->executionIdIn = $executionIdIn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExecutionIdIn()
    {
        return $this->executionIdIn;
    }

    /**
     * @param mixed $firstResult
     * @return $this
     */
    public function setFirstResult($firstResult)
    {
        $this->firstResult = $firstResult;
        return $this;
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
     * @return $this
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @param mixed $processInstanceIdIn
     * @return $this
     */
    public function setProcessInstanceIdIn($processInstanceIdIn)
    {
        $this->processInstanceIdIn = $processInstanceIdIn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceIdIn()
    {
        return $this->processInstanceIdIn;
    }

    /**
     * @param mixed $sortBy
     * @return $this
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        return $this;
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
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param mixed $taskIdIn
     * @return $this
     */
    public function setTaskIdIn($taskIdIn)
    {
        $this->taskIdIn = $taskIdIn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaskIdIn()
    {
        return $this->taskIdIn;
    }

    /**
     * @param mixed $variableName
     * @return $this
     */
    public function setVariableName($variableName)
    {
        $this->variableName = $variableName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariableName()
    {
        return $this->variableName;
    }

    /**
     * @param mixed $variableNameLike
     * @return $this
     */
    public function setVariableNameLike($variableNameLike)
    {
        $this->variableNameLike = $variableNameLike;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariableNameLike()
    {
        return $this->variableNameLike;
    }

    /**
     * @param mixed $variableValues
     * @return $this
     */
    public function setVariableValues($variableValues)
    {
        $this->variableValues = $variableValues;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariableValues()
    {
        return $this->variableValues;
    }


}