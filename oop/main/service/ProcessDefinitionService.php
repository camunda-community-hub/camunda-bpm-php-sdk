<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 09:13
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\entity\request\ProcessDefinitionRequest;
use org\camunda\php\sdk\entity\request\StatisticRequest;
use org\camunda\php\sdk\entity\response\ProcessDefinition;
use org\camunda\php\sdk\entity\response\ProcessInstance;
use org\camunda\php\sdk\entity\response\Statistic;

class ProcessDefinitionService extends RequestService {
  public function getDefinition($id) {
    $processDefinition = new ProcessDefinition();
    $this->setRequestUrl('/process-definition/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    return $processDefinition->cast((object) $this->execute());
  }

  public function getDefinitions(ProcessDefinitionRequest $request) {
    $processDefinition = new ProcessDefinition();
    $this->setRequestUrl('/process-definition/');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    $prepare = $this->execute();
    $response = array();
    $i = 0;
    foreach($prepare AS $data) {
      $response['processDefinition_'.$i] = $processDefinition->cast($data);
      $i++;
    }
    return (object) $response;
  }

  public function getDefinitionCount(ProcessDefinitionRequest $request) {
    $this->setRequestUrl('/process-definition/count');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    return $this->execute()->count;
  }

  public function getBpmn20Xml($id) {
    $this->setRequestUrl('/process-definition/'.$id.'/xml');
    $this->setRequestMethod('GET');
    $this->setRequestObject(null);

    return $this->execute();
  }

  public function startInstance($id, ProcessDefinitionRequest $request) {
    $processInstance = new ProcessInstance();
    $this->setRequestUrl('/process-definition/'.$id.'/start');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');
    return $processInstance->cast($this->execute());
  }

  public function getProcessInstanceStatistic(StatisticRequest $request) {
    $statistic = new Statistic();
    $this->setRequestUrl('/process-definition/statistics');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    return $statistic->cast($this->execute());
  }

  public function getActivityInstanceStatistic($id, StatisticRequest $request) {
    $statistic = new Statistic();
    $this->setRequestUrl('/process-definition/'.$id.'/statistics');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    return $statistic->cast($this->execute());
  }

  public function getStartFormKey($id) {
    $this->setRequestUrl('/process-definition/'.$id.'/startForm');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    return $this->execute()->key;
  }
}