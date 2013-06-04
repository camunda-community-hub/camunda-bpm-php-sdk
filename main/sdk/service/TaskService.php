<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 04.06.13
 * Time: 11:13
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use org\camunda\php\sdk\entity\Request;

class TaskService extends RestService {

  public function getTaskCount() {
    $request = new Request();
    $request->setUrl('/task/count');

    $restResponse = $this->restGetRequest($request);
    echo $restResponse->count;
  }

}