<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 02.07.13
 * Time: 11:08
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;


class ProcessEngineService extends RequestService {

  public function getEngineNames() {
    $this->setRequestUrl('/engine');
    $this->setRequestMethod("GET");
    $this->setRequestObject(null);

    return $this->execute();
  }
}