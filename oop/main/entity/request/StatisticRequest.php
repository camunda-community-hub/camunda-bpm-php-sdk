<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 21:07
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class StatisticRequest extends Request {
  protected $failedJobs;
  protected $incidents;
  protected $incidentsForType;

  /**
   * @param mixed $failedJobs
   * @return $this
   */
  public function setFailedJobs($failedJobs) {
    $this->failedJobs = $failedJobs;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFailedJobs() {
    return $this->failedJobs;
  }

  /**
   * @param mixed $incidents
   * @return $this
   */
  public function setIncidents($incidents) {
    $this->incidents = $incidents;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getIncidents() {
    return $this->incidents;
  }

  /**
   * @param mixed $incidentsForType
   * @return $this
   */
  public function setIncidentsForType($incidentsForType) {
    $this->incidentsForType = $incidentsForType;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getIncidentsForType() {
    return $this->incidentsForType;
  }


}