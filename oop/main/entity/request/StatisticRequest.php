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
  private $failedJobs;
  private $incidents;
  private $incidentsForType;

  /**
   * @param mixed $failedJobs
   */
  public function setFailedJobs($failedJobs) {
    $this->failedJobs = $failedJobs;
  }

  /**
   * @return mixed
   */
  public function getFailedJobs() {
    return $this->failedJobs;
  }

  /**
   * @param mixed $incidents
   */
  public function setIncidents($incidents) {
    $this->incidents = $incidents;
  }

  /**
   * @return mixed
   */
  public function getIncidents() {
    return $this->incidents;
  }

  /**
   * @param mixed $incidentsForType
   */
  public function setIncidentsForType($incidentsForType) {
    $this->incidentsForType = $incidentsForType;
  }

  /**
   * @return mixed
   */
  public function getIncidentsForType() {
    return $this->incidentsForType;
  }


}