<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:35
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;


use org\camunda\php\sdk\helper\CastHelper;

class VariableInstance extends CastHelper
{
    protected $name;
    protected $type;
    protected $value;
    protected $processInstanceId;
    protected $executionId;
    protected $taskId;
    protected $activityInstanceId;

    /**
     * @param mixed $activityInstanceId
     */
    public function setActivityInstanceId($activityInstanceId)
    {
        $this->activityInstanceId = $activityInstanceId;
    }

    /**
     * @return mixed
     */
    public function getActivityInstanceId()
    {
        return $this->activityInstanceId;
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }


}