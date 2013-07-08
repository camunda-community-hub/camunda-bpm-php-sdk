<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 14:19
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\entity\response\ProcessInstance;
use org\camunda\php\sdk\entity\response\Variable;

class ProcessInstanceService extends RequestService {
  public function getInstance($id) {
    $processInstance = new ProcessInstance();
    $this->setRequestUrl('/process-instance/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    return $processInstance->cast($this->execute());
  }

  public function getInstances(ProcessInstanceRequest $request, $isPostRequest = false) {
    $processInstance = new ProcessInstance();
    $this->setRequestUrl('/process-instance/');
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
      $response['instance_'.$i] = $processInstance->cast($data);
      $i++;
    }
    return (object) $response;
  }

  public function getInstanceCount(ProcessInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/process-instance/count/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    return $this->execute()->count;
  }

  public function getProcessVariable($id, $variableId) {
    $variable = new Variable();
    $this->setRequestUrl('/process-instance/'.$id.'/variables/'.$variableId);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    return $variable->cast($this->execute());
  }

  public function putProcessVariable($id, $variableId, VariableRequest $request) {
    $this->setRequestUrl('/process-instance/'.$id.'/variables/'.$variableId);
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    $this->execute();
  }

  public function deleteProcessVariable($id, $variableId) {
    $this->setRequestUrl('/process-instance/'.$id.'/variables/'.$variableId);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    $this->execute();
  }

  public function getProcessVariables($id) {
    $variable = new Variable();
    $this->setRequestUrl('/process-instance/'.$id.'/variables');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    $prepare = $this->execute();
    $response = array();
    $i = 0;
    foreach($prepare AS $data) {
      $response['processVariable_'.$i] = $variable->cast($data);
      $i++;
    }
    return (object) $response;
  }


  public function updateOrDeleteProcessVariables($id, VariableRequest $request) {
    $this->setRequestUrl('/process-instance/'.$id.'/variables');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    $this->execute();
  }

  public function deleteInstance($id, ProcessInstanceRequest $request) {
    $this->setRequestUrl('/process-instance/'.$id);
    $this->setRequestObject($request);
    $this->setRequestMethod('DELETE');
  }
}