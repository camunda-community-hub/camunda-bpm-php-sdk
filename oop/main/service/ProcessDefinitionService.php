<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 09:13
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use Exception;
use org\camunda\php\sdk\entity\request\ProcessDefinitionRequest;
use org\camunda\php\sdk\entity\request\StatisticRequest;
use org\camunda\php\sdk\entity\response\Form;
use org\camunda\php\sdk\entity\response\ProcessDefinition;
use org\camunda\php\sdk\entity\response\ProcessInstance;
use org\camunda\php\sdk\entity\response\Statistic;

class ProcessDefinitionService extends RequestService {

  /**
   * Retrieves a single process definition according to the
   * ProcessDefinition interface in the engine.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get
   *
   * @param String $id ID of the requested definition
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\ProcessDefinition $this Requested definition
   */
  public function getDefinition($id) {
    $processDefinition = new ProcessDefinition();
    $this->setRequestUrl('/process-definition/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    try {
      return $processDefinition->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves a list of process definitions
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-query
   *
   * @param ProcessDefinitionRequest $request filter parameters
   * @throws \Exception
   * @return object list of retrieved process definitions
   */
  public function getDefinitions(ProcessDefinitionRequest $request) {
    $this->setRequestUrl('/process-definition/');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $processDefinition = new ProcessDefinition();
        $response['definition_' . $index] = $processDefinition->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Request the number of process definitions that fulfill the query criteria.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-query-count
   *
   * @param ProcessDefinitionRequest $request filtered parameters
   * @throws \Exception
   * @return int Amount of jobs
   */
  public function getCount(ProcessDefinitionRequest $request) {
    $this->setRequestUrl('/process-definition/count');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the BPMN 2.0 XML of this process definition.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-xml
   *
   * @param String $id process definition ID
   * @throws \Exception
   * @return mixed
   */
  public function getBpmn20Xml($id) {
    $this->setRequestUrl('/process-definition/'.$id.'/xml');
    $this->setRequestMethod('GET');
    $this->setRequestObject(null);

    try {
      return $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Instantiates a given process definition.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/post-start-process-instance
   *
   * @param String $id process definition ID
   * @param ProcessDefinitionRequest $request variables
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\ProcessInstance $this started process instance
   */
  public function startInstance($id, ProcessDefinitionRequest $request) {
    $processInstance = new ProcessInstance();
    $this->setRequestUrl('/process-definition/'.$id.'/start');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      return $processInstance->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves process instances statistics
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-statistics
   *
   * @param StatisticRequest $request
   * @throws \Exception
   * @return object list of process instance statistics
   */
  public function getProcessInstanceStatistic(StatisticRequest $request) {
    $this->setRequestUrl('/process-definition/statistics');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $statistic = new Statistic();
        $response['statistic_' . $index] = $statistic->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Get a list of activity instances statistics of the given process definition id
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-activity-statistics
   *
   * @param String $id process definition id
   * @param StatisticRequest $request parameters
   * @throws \Exception
   * @return object list of activity instance statistics
   */
  public function getActivityInstanceStatistic($id, StatisticRequest $request) {
    $this->setRequestUrl('/process-definition/'.$id.'/statistics');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $statistic = new Statistic();
        $response['statistic_' . $index] = $statistic->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * get form key of the start event
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-start-form-key
   * (Prepared for 7.1.0 - context Path will come ;) )
   *
   * @param String $id process definition ID
   * @throws \Exception
   * @return Form start form key
   */
  public function getStartFormKey($id) {
    $form = new Form();
    $this->setRequestUrl('/process-definition/'.$id.'/startForm');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    try {
      return $form->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }
}