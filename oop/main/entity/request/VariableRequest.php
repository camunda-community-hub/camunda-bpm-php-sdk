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
  protected $value;
  protected $type;
  protected $modifications;
  protected $deletions;

  /**
   * @param mixed $deletions
   * @return $this
   */
  public function setDeletions($deletions) {
    $this->deletions = $deletions;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDeletions() {
    return $this->deletions;
  }

  /**
   * @param mixed $modifications
   * @return $this
   */
  public function setModifications($modifications) {
    $this->modifications = $modifications;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getModifications() {
    return $this->modifications;
  }

  /**
   * @param mixed $type
   * @return $this
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
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
    return $this;
  }

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->value;
  }


}