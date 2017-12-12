<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:33
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;


use org\camunda\php\sdk\helper\CastHelper;

class HistoricProcessInstance extends CastHelper
{
    protected $id;
    protected $superProcessInstanceId;
    protected $processDefinitionId;
    protected $businessKey;
    protected $startTime;
    protected $endTime;
    protected $durationInMillis;
    protected $startUserId;
    protected $startActivityId;
    protected $deleteReason;

    /**
     * @param mixed $businessKey
     */
    public function setBusinessKey($businessKey)
    {
        $this->businessKey = $businessKey;
    }

    /**
     * @return mixed
     */
    public function getBusinessKey()
    {
        return $this->businessKey;
    }

    /**
     * @param mixed $deleteReason
     */
    public function setDeleteReason($deleteReason)
    {
        $this->deleteReason = $deleteReason;
    }

    /**
     * @return mixed
     */
    public function getDeleteReason()
    {
        return $this->deleteReason;
    }

    /**
     * @param mixed $durationInMillis
     */
    public function setDurationInMillis($durationInMillis)
    {
        $this->durationInMillis = $durationInMillis;
    }

    /**
     * @return mixed
     */
    public function getDurationInMillis()
    {
        return $this->durationInMillis;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @param mixed $startActivityId
     */
    public function setStartActivityId($startActivityId)
    {
        $this->startActivityId = $startActivityId;
    }

    /**
     * @return mixed
     */
    public function getStartActivityId()
    {
        return $this->startActivityId;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startUserId
     */
    public function setStartUserId($startUserId)
    {
        $this->startUserId = $startUserId;
    }

    /**
     * @return mixed
     */
    public function getStartUserId()
    {
        return $this->startUserId;
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


}