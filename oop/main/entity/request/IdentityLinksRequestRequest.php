<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:02
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class IdentityLinksRequest extends Request {
  protected $type;

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

}