<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 02.07.13
 * Time: 11:14
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use org\camunda\php\sdk\entity\request\IdentityRequest;
use org\camunda\php\sdk\entity\response\Identity;

class IdentityService extends RequestService{
  public function getUserGroup(IdentityRequest $request) {
    $identity = new Identity();
    $this->setRequestUrl('/identity/groups');
    $this->setRequestMethod('GET');
    $this->setRequestObject($request);

    return $identity->cast($this->execute());
  }
}