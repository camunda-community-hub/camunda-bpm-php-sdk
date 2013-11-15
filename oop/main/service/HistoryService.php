<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;


use Exception;
use org\camunda\php\sdk\entity\request\HistoricActivityInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricVariableInstanceRequest;
use org\camunda\php\sdk\entity\response\HistoricActivityInstance;
use org\camunda\php\sdk\entity\response\HistoricProcessInstance;
use org\camunda\php\sdk\entity\response\HistoricVariableInstance;

class HistoryService extends RequestService {

  /**
   * Query for historic activity instances that fulfill the given parameters.
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-activity-instances-historic
   *
   * @param HistoricActivityInstanceRequest $request
   * @throws \Exception
   * @return object
   */
  public function getActivityInstances(HistoricActivityInstanceRequest $request) {
    $this->setRequestUrl('/history/activity-instance');
    $this->setRequestObject($request);
    $this->getRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach($prepare AS $index => $data) {
        $historicActivityInstance = new HistoricActivityInstance();
        $response['historicActivityInstance_'.$index] = $historicActivityInstance->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Query for the number of historic activity instances that fulfill the given parameters.
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-activity-instances-count
   *
   * @param HistoricActivityInstanceRequest $request
   * @throws \Exception
   * @return Integer count
   */
  public function getActivityInstancesCount(HistoricActivityInstanceRequest $request) {
    $this->setRequestUrl('/history/activity-instance/count');
    $this->setRequestObject($request);
    $this->getRequestMethod('GET');

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Query for historic process instances that fulfill the given parameters.
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances-post
   *
   * @param HistoricProcessInstanceRequest $request
   * @param bool $isPostRequest
   * @throws \Exception
   * @return object
   */
  public function getProcessInstances(HistoricProcessInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/history/process-instance');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $historicProcessInstance = new HistoricProcessInstance();
        $response['historicProcessInstance_' . $index] = $historicProcessInstance->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Query for the number of historic process instances that fulfill the given parameters.
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances-count
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances-count-post
   *
   * @param HistoricProcessInstanceRequest $request
   * @param bool $isPostRequest
   * @throws \Exception
   * @return mixed
   */
  public function getProcessInstancesCount(HistoricProcessInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/history/process-instance/count');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Query for historic variable instances that fulfill the given parameters.
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances-post
   *
   * @param HistoricVariableInstanceRequest $request
   * @param bool $isPostRequest
   * @throws \Exception
   * @return object
   */
  public function getVariableInstances(HistoricVariableInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/history/variable-instance');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $historicVariableInstance = new HistoricVariableInstance();
        $response['historicVariableInstance_' . $index] = $historicVariableInstance->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Query for the number of historic variable instances that fulfill the given parameters.
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances-count
   * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances-count-post
   *
   * @param HistoricVariableInstanceRequest $request
   * @param bool $isPostRequest
   * @throws \Exception
   * @return mixed
   */
  public function getVariableInstancesCount(HistoricVariableInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/history/variable-instance/count');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

}