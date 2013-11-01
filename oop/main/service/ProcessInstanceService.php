<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 14:19
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use Exception;
use org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\entity\response\Activity;
use org\camunda\php\sdk\entity\response\ProcessInstance;
use org\camunda\php\sdk\entity\response\Variable;

class ProcessInstanceService extends RequestService {

  /**
   * Retrieves a single instance with given ID
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get
   *
   * @param String $id Process instance ID
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\ProcessInstance $this requested process instance
   */
  public function getInstance($id) {
    $processInstance = new ProcessInstance();
    $this->setRequestUrl('/process-instance/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    try {
      return $processInstance->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves all process instances within a given context.
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query
   *
   * @param ProcessInstanceRequest $request filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return object list of process instances
   */
  public function getInstances(ProcessInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/process-instance/');
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
        $processInstance = new ProcessInstance();
        $response['instance_' . $index] = $processInstance->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the amount of process instances within a given context
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query-count
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query-count
   *
   * @param ProcessInstanceRequest $request filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return int amount of process instances
   */
  public function getCount(ProcessInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/process-instance/count/');
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
   * Retrieves the requested variable within a given process instance context
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-single-variable
   *
   * @param String $id process instance ID
   * @param String $variableId process variable ID
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\Variable $this requested variable
   */
  public function getProcessVariable($id, $variableId) {
    $variable = new Variable();
    $this->setRequestUrl('/process-instance/'.$id.'/variables/'.$variableId);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    try {
      return $variable->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Sets a variable of a given process instance
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/put-single-variable
   *
   * @param String $id process instance ID
   * @param String $variableId variable ID
   * @param VariableRequest $request variable properties
   * @throws \Exception
   */
  public function putProcessVariable($id, $variableId, VariableRequest $request) {
    $this->setRequestUrl('/process-instance/'.$id.'/variables/'.$variableId);
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Removes a variable from a given process instance
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/delete-single-variable
   *
   * @param String $id process instance ID
   * @param String $variableId variable ID
   * @throws \Exception
   */
  public function deleteProcessVariable($id, $variableId) {
    $this->setRequestUrl('/process-instance/'.$id.'/variables/'.$variableId);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves all variables within a given process instance
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-variables
   *
   * @param String $id process instance ID
   * @throws \Exception
   * @return object list of variables
   */
  public function getProcessVariables($id) {
    $variable = new Variable();
    $this->setRequestUrl('/process-instance/'.$id.'/variables');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $response['variable_' . $index] = $variable->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Updates or removes multiple process variables
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-variables
   *
   * @param String $id process instance ID
   * @param VariableRequest $request modification and/or deletion parameters
   * @throws \Exception
   */
  public function updateOrDeleteProcessVariables($id, VariableRequest $request) {
    $this->setRequestUrl('/process-instance/'.$id.'/variables');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Removes a given process instance
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/delete
   *
   * @param String $id process instance ID
   * @throws \Exception
   */
  public function deleteInstance($id) {
    $this->setRequestUrl('/process-instance/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    try {
      $this->execute();
    } catch(Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves all activity instances within a given process instance context
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-activity-instances
   *
   * @param String $id process instance ID
   * @param ProcessInstanceRequest $request filter parameters
   * @throws \Exception
   * @return object activity instance tree
   */
  public function getActivityInstances($id, ProcessInstanceRequest $request) {
    $this->setRequestUrl('/process-instance/'. $id . '/activity-instances');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      return $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Activate or suspend a given process instance.
   * @link http://docs.camunda.org/latest/api-references/rest/#process-instance-activatesuspend-process-instance
   *
   * @param String $id process instance ID
   * @param ProcessInstanceRequest $request
   * @throws \Exception
   */
  public function activateOrSuspendInstance($id, ProcessInstanceRequest $request) {
    $this->setRequestUrl('/process-instance/'.$id.'/suspended');
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }
}