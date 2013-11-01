<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 02.07.13
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use Exception;
use org\camunda\php\sdk\entity\request\MessageRequest;

class MessageService extends RequestService {
  /**
   * Deliver a message to the process engine to either trigger a message
   * start or intermediate message catching event.
   * @link http://docs.camunda.org/api-references/rest/#!/message/post-message
   *
   * @param MessageRequest $request request body
   * @throws \Exception
   */
  public function deliverMessage(MessageRequest $request) {
    $this->setRequestUrl('/message');
    $this->setRequestMethod('POST');
    $this->setRequestObject($request);

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }
}