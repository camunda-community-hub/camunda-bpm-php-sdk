<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 09:59
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;


use org\camunda\php\sdk\helper\CastHelper;

class ResourceOption extends CastHelper {
  protected $method;
  protected $href;
  protected $rel;

  /**
   * @param mixed $href
   */
  public function setHref($href) {
    $this->href = $href;
  }

  /**
   * @return mixed
   */
  public function getHref() {
    return $this->href;
  }

  /**
   * @param mixed $method
   */
  public function setMethod($method) {
    $this->method = $method;
  }

  /**
   * @return mixed
   */
  public function getMethod() {
    return $this->method;
  }

  /**
   * @param mixed $rel
   */
  public function setRel($rel) {
    $this->rel = $rel;
  }

  /**
   * @return mixed
   */
  public function getRel() {
    return $this->rel;
  }


}