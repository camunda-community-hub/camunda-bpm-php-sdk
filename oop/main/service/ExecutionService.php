<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 14:19
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use org\camunda\php\sdk\entity\request\ExecutionRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\entity\request\MessageSubscriptionRequest;
use org\camunda\php\sdk\entity\response\Execution;
use org\camunda\php\sdk\entity\response\Variable;
use org\camunda\php\sdk\entity\response\MessageSubscription;

class ExecutionService extends RequestService {
  public function getExecution($id) {
    $execution = new Execution();
    $this->setRequestUrl('/execution/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    return $execution->cast($this->execute());
  }

  public function getExecutions(ExecutionRequest $request, $isPostRequest = false) {
    $execution = new Execution();
    $this->setRequestUrl('/execution/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    $prepare = $this->execute();
    $response = array();
    $i = 0;
    foreach($prepare AS $data) {
      $response['instance_'.$i] = $execution->cast($data);
      $i++;
    }
    return (object) $response;
  }

  public function getExecutionsCount(ExecutionRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/execution/count/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    return $this->execute()->count;
  }

  public function getLocalExecutionVariable($id, $variableId) {
    $variable = new Variable();
    $this->setRequestUrl('/execution/'.$id.'/localVariables/'.$variableId);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    return $variable->cast($this->execute());
  }

  public function putExecutionVariable($id, $variableId, VariableRequest $request) {
    $this->setRequestUrl('/execution/'.$id.'/localVariables/'.$variableId);
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    $this->execute();
  }

  public function deleteExecutionVariable($id, $variableId) {
    $this->setRequestUrl('/execution/'.$id.'/localVariables/'.$variableId);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    $this->execute();
  }

  public function getExecutionVariables($id) {
    $variable = new Variable();
    $this->setRequestUrl('/execution/'.$id.'/localVariables');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    $prepare = $this->execute();
    $response = array();
    $i = 0;
    foreach($prepare AS $data) {
      $response['executionVariable_'.$i] = $variable->cast($data);
      $i++;
    }
    return (object) $response;
  }


  public function updateOrDeleteExecutionVariables($id, VariableRequest $request) {
    $this->setRequestUrl('/execution/'.$id.'/localVariables');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    $this->execute();
  }

  public function triggerExecution($id) {
    $this->setRequestUrl('/execution/'.$id .'/signal');
    $this->setRequestMethod('POST');
    $this->setRequestObject(null);

    $this->execute();
  }

  public function getMessageEventSubscription($id, $messageName, MessageSubscriptionRequest $request) {
    $messageSubscription = new MessageSubscription();
    $this->setRequestUrl('/execution/'.$id.'/messageSubscriptions/'.$messageName);
    $this->setRequestMethod('GET');
    $this->setRequestObject($request);

    return $messageSubscription->cast($this->execute());
  }

  public function triggerMessageSubscription($id, $messageName, MessageSubscriptionRequest $request) {
    $this->setRequestUrl('/execution/'.$id.'/messageSubscriptions/'.$messageName.'/trigger');
    $this->setRequestMethod('POST');
    $this->setRequestObject($request);

    $this->execute();
  }
}