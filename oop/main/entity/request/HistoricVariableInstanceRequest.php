<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class HistoricVariableInstanceRequest extends Request
{
    protected $variableName;
    protected $variableNameLike;
    protected $variableValue;
    protected $processInstanceId;
    protected $sortBy;
    protected $sortOrder;
    protected $firstResult;
    protected $maxResults;

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
     * @param mixed $variableName
     */
    public function setVariableName($variableName)
    {
        $this->variableName = $variableName;
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
     */
    public function setVariableNameLike($variableNameLike)
    {
        $this->variableNameLike = $variableNameLike;
    }

    /**
     * @return mixed
     */
    public function getVariableNameLike()
    {
        return $this->variableNameLike;
    }

    /**
     * @param mixed $variableValue
     */
    public function setVariableValue($variableValue)
    {
        $this->variableValue = $variableValue;
    }

    /**
     * @return mixed
     */
    public function getVariableValue()
    {
        return $this->variableValue;
    }


}