<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 20:42
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\helper;


class CastHelper {

  /**
   * Helps to cast a standard class object
   * into a specific class object
   *
   * @param \stdClass $object
   * @return $this
   */
  public function cast(\stdClass $object) {
    foreach($object AS $index => $value) {
      $this->$index = $value;
    }

    return $this;
  }

  /**
   * provides a possible way to iterate over all
   * non public methods without implementation of
   * the more heavy Iterator class
   *
   * @return array
   */
  public function iterate() {
    $tmp = array();
    foreach ($this as $key => $value) {
      $tmp[$key] = $value;
    }

    return $tmp;
  }

}