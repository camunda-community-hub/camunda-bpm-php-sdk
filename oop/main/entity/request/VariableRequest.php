<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 14:54
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class VariableRequest extends Request {
  private $value;
  private $type;
  private $modifications;
  private $deletions;

  /**
   * @param mixed $deletions
   */
  public function setDeletions($deletions) {
    $this->deletions = $deletions;
  }

  /**
   * @return mixed
   */
  public function getDeletions() {
    return $this->deletions;
  }

  /**
   * @param mixed $modifications
   */
  public function setModifications($modifications) {
    $this->modifications = $modifications;
  }

  /**
   * @return mixed
   */
  public function getModifications() {
    return $this->modifications;
  }

  /**
   * @param mixed $type
   */
  public function setType($type) {
    $this->type = $type;
  }

  /**
   * @return mixed
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param mixed $value
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->value;
  }


}