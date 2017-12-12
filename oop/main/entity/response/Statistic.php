<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 21:07
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;

use org\camunda\php\sdk\helper\CastHelper;

class Statistic extends CastHelper
{
    protected $id;
    protected $instances;
    protected $failedJobs;
    protected $definition;
    protected $incidents;

    /**
     * @param mixed $definition
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }

    /**
     * @return mixed
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param mixed $failedJobs
     */
    public function setFailedJobs($failedJobs)
    {
        $this->failedJobs = $failedJobs;
    }

    /**
     * @return mixed
     */
    public function getFailedJobs()
    {
        return $this->failedJobs;
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
     * @param mixed $incidents
     */
    public function setIncidents($incidents)
    {
        $this->incidents = $incidents;
    }

    /**
     * @return mixed
     */
    public function getIncidents()
    {
        return $this->incidents;
    }

    /**
     * @param mixed $instances
     */
    public function setInstances($instances)
    {
        $this->instances = $instances;
    }

    /**
     * @return mixed
     */
    public function getInstances()
    {
        return $this->instances;
    }


}