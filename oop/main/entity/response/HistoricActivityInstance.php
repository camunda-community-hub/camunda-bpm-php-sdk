<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:30
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;


use org\camunda\php\sdk\helper\CastHelper;

class HistoricActivityInstance extends CastHelper
{
    protected $id;
    protected $parentActivityInstanceId;
    protected $activityId;
    protected $activityName;
    protected $activityType;
    protected $processDefinitionId;
    protected $processInstanceId;
    protected $executionId;
    protected $taskId;
    protected $assignee;
    protected $calledProcessInstanceId;
    protected $startTime;
    protected $endTime;
    protected $durationInMillis;

    /**
     * @param mixed $activityId
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;
    }

    /**
     * @return mixed
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * @param mixed $activityName
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;
    }

    /**
     * @return mixed
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * @param mixed $activityType
     */
    public function setActivityType($activityType)
    {
        $this->activityType = $activityType;
    }

    /**
     * @return mixed
     */
    public function getActivityType()
    {
        return $this->activityType;
    }

    /**
     * @param mixed $assignee
     */
    public function setAssignee($assignee)
    {
        $this->assignee = $assignee;
    }

    /**
     * @return mixed
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @param mixed $calledProcessInstanceId
     */
    public function setCalledProcessInstanceId($calledProcessInstanceId)
    {
        $this->calledProcessInstanceId = $calledProcessInstanceId;
    }

    /**
     * @return mixed
     */
    public function getCalledProcessInstanceId()
    {
        return $this->calledProcessInstanceId;
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
     * @param mixed $executionId
     */
    public function setExecutionId($executionId)
    {
        $this->executionId = $executionId;
    }

    /**
     * @return mixed
     */
    public function getExecutionId()
    {
        return $this->executionId;
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
     * @param mixed $parentActivityInstanceId
     */
    public function setParentActivityInstanceId($parentActivityInstanceId)
    {
        $this->parentActivityInstanceId = $parentActivityInstanceId;
    }

    /**
     * @return mixed
     */
    public function getParentActivityInstanceId()
    {
        return $this->parentActivityInstanceId;
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
     * @param mixed $taskId
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

}