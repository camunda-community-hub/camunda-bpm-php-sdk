<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 02.07.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use org\camunda\php\sdk\entity\request\MessageRequest;

class MessageService extends RequestService {
  public function deliverMessage(MessageRequest $request) {
    $this->setRequestUrl('/message');
    $this->setRequestMethod('POST');
    $this->setRequestObject($request);

    $this->execute();
  }
}