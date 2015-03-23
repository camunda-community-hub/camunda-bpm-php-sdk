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

class HistoricActivityStatistic extends CastHelper{
  protected $id;
  protected $instances;
  protected $canceled;
  protected $finished;
  protected $completeScope;

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $instances
   */
  public function setInstances($instances) {
    $this->instances = $instances;
  }

  /**
   * @return mixed
   */
  public function getInstances() {
    return $this->instances;
  }

    /**
   * @param mixed $canceled
   * @return $this
   */
  public function setCanceled($canceled) {
    $this->canceled = $canceled;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCanceled() {
    return $this->canceled;
  }

  /**
   * @param mixed $finished
   * @return $this
   */
  public function setFinished($finished) {
    $this->finished = $finished;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFinished() {
    return $this->finished;
  }

  /**
   * @param mixed $completeScope
   * @return $this
   */
  public function setCompleteScope($completeScope) {
    $this->completeScope = $completeScope;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCompleteScope() {
    return $this->completeScope;
  }


}