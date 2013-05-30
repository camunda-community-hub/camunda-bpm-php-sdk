<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 29.05.13
 * Time: 08:40
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\demo\php\library;


class camundaPHP {

  private $engineUrl;
  private $cookieFilePath = './';
//  private $isAuthenticated;
//  private $sessionId;

  /**
   * @param String $engineUrl - URL of the rest api
   */
  public function __construct($engineUrl) {
    $this->engineUrl = $engineUrl;
  }

  /**
   * @param String $engineUrl url to rest api
   */
  public function setEngineUrl($engineUrl) {
    $this->engineUrl = $engineUrl;
  }

  /**
   * @return mixed url to rest api
   */
  public function getEngineUrl() {
    return $this->engineUrl;
  }
  /**
   * authenticate to use REST-API. This feature is actually not implemented
   * in the REST Api so that we don't need to do anything here until the
   * final release of camunda BPM 7.0.0
   *
   * @param $authenticationData array with username, password (, APIkey)
   */
  public function authenticate($authenticationData) {
      // not used
  }


/*---------------------- PROCESS ENGINE -------------------------------------*/

  /**
   * Retrieves the names of all process engines available on your platform.
   * @link http://docs.camunda.org/api-references/rest/#!/engine/get-names
   *
   * @return mixed  returns the server response
   */
  public function getEngineNames() {
    $query = 'engine';
    return $this->restGetRequest($query, null);
  }


/*---------------------- PROCESS INSTANCES -------------------------------------*/

  /**
   * get a single process instance from the REST API
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get
   *
   * @param String $id Id of the process instance
   * @return mixed  returns the server response
   */
  public function getSingleProcessInstance($id) {
    $query = 'process-instance/'.$id;
    return $this->restGetRequest($query, null);
  }

  /**
   * get all process instances from the REST API
   *@link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query
   *
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessInstances($parameterArray = null) {
    $query = 'process-instance';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * get count of all requested process instances
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query-count
   *
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessInstanceCount($parameterArray = null) {
    $query = 'process-instance/count';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * get all process instances with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query
   *
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessInstancesByPost($parameterArray = null) {
    $query = 'process-instance';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * get count of all requested process instances with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query-count
   *
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessInstanceCountByPost($parameterArray = null) {
    $query = 'process-instance/count';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * Retrieves all variables of a given process instance.
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-variables
   *
   * @param String $id Id of the process instance
   * @return mixed  returns the server response
   */
  public function getProcessVariables($id) {
    $query = 'process-instance/'.$id.'/variables';
    return $this->restGetRequest($query, null);
  }


/*---------------------- PROCESS DEFINITIONS -------------------------------------*/

  /**
   * get a single process definition from the REST API
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get
   *
   * @param String $id Id of the process definition
   * @return mixed  returns the server response
   */
  public function getSingleProcessDefinition($id) {
    $query = 'process-definition/'.$id;
    return $this->restGetRequest($query, null);
  }

  /**
   * get all process definitions from the REST API
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-query
   *
   * @param Array $parameterArray
   * @return mixed returns the server-response
   */
  public function getProcessDefinitions($parameterArray = null) {
    $query = 'process-definition';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * get count of all requested process definitions
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-query-count
   *
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessDefinitionCount($parameterArray = null) {
    $query = 'process-definition/count';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
 * Retrieves the BPMN 2.0 XML of this process definition.
 * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-xml
 *
 * @param String $id id of the process definition
 * @return mixed returns the server response
 */
  public function getBpmnXml($id) {
    $query = 'process-definition/'.$id.'/xml';
    return $this->restGetRequest($query, null);
  }

  /**
   * Instantiates a given process definition. Process variables may be supplied in the request body.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/post-start-process-instance
   *
   * @param String $id id of the process definition
   * @param Array $processVariables variables attached to the process instance
   * @return mixed returns the server response
   */
  public function startProcessInstance($id, $processVariables = null) {
    $query = 'process-definition/'.$id.'/start';
    return $this->restPostRequest($query, $processVariables);
  }

  /**
   * Retrieves runtime statistics of the process engine grouped by process definitions.
   * These statistics include the number of running process instances and optionally the number of failed jobs.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-statistics
   *
   * @param Array $parameterArray parameters
   * @return mixed returns the server response
   */
  public function getProcessInstanceStatistics($parameterArray = null) {
    $query = 'process-definition/statistics';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * Retrieves runtime statistics of a given process definition grouped by activities.
   * These statistics include the number of running activity instances and optionally the number of failed jobs.
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-activity-statistics
   *
   * @param String $id id of the process definition
   * @param Array $parameterArray parameters
   * @return mixed returns the server response
   */
  public function getActivityInstanceStatistics($id, $parameterArray = null) {
    $query = 'process-definition/'.$id.'/statistics';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * Retrieves the key of the start form for a process definition. The form key corresponds to the FormData#formKey
   * property in the engine
   * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-start-form-key
   *
   * @param String $id id of the process definition
   * @return mixed returns the server response
   */
  public function getStartFormKey($id) {
    $query = '/process-definition/'.$id.'/startForm';
    return $this->restGetRequest($query, null);
  }


/*---------------------- TASK OPERATIONS -------------------------------------*/

  /**
   * Retrieves a single task by its id.
   * @link http://docs.camunda.org/api-references/rest/#!/task/get
   *
   * @param String $id task id
   * @return mixed
   */
  public function getSingleTask($id) {
    $query = 'task/'.$id;
    return $this->restGetRequest($query, null);
  }

  /**
   * get all tasks from the rest api
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-query
   *
   * @param Array $parameterArray url parameter
   * @return mixed returns the server-response
   */
  public function getTasks($parameterArray = null) {
    $query = 'task';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * get count of all requested process definitions
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-query-count
   *
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function getTaskCount($parameterArray = null) {
    $query = 'task/count';
    return $this->restGetRequest($query, $parameterArray);
  }

  /**
   * get all tasks from the rest api with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-query
   *
   * @param Array $parameterArray url parameter
   * @return mixed returns the server-response
   */
  public function getTasksByPost($parameterArray = null) {
    $query = 'task';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * get count of all requested process definitions with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-query-count
   *
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function getTaskCountByPost($parameterArray = null) {
    $query = 'task/count';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * Retrieves the form key for a task. The form key corresponds to the FormData#formKey property in the engine.
   * This key can be used to do task-specific form rendering in client applications.
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-form-key
   *
   * @param String $id id of the task
   * @return mixed returns the server response
   */
  public function getFormKey($id) {
    $query = 'task/'.$id.'/count';
    return $this->restGetRequest($query, null);
  }

  /**
   * Claim a task for a specific user.
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-claim
   *
   * @param String $id id of the task
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function claimTask($id,$parameterArray) {
    $query = 'task/'.$id.'/claim';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * Resets a task's assignee. If successful, the task is not assigned to a user.
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-unclaim
   *
   * @param String $id id of the task
   * @return mixed returns the server response
   */
  public function unclaimTask($id) {
    $query = 'task/'.$id.'/unclaim';
    return $this->restPostRequest($query, null);
  }

  /**
 * Complete a task and update process variables.
 * @link http://docs.camunda.org/api-references/rest/#!/task/post-complete
 *
 * @param String $id id of the task
 * @param Array $parameterArray url parameter
 * @return mixed returns the server response
 */
  public function completeTask($id,$parameterArray) {
    $query = 'task/'.$id.'/complete';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * Resolve a task and update execution variables.
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-resolve
   *
   * @param String $id id of the task
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function resolveTask($id,$parameterArray) {
    $query = 'task/'.$id.'/resolve';
    return $this->restPostRequest($query, $parameterArray);
  }

  /**
   * Delegate a task to another user.
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-delegate)
   *
   * @param String $id id of the task
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function delegateTask($id,$parameterArray) {
    $query = 'task/'.$id.'/delegate';
    return $this->restPostRequest($query, $parameterArray);
  }


/*---------------------- MESSAGE OPERATIONS -------------------------------------*/

  /**
   * Deliver a message to the process engine to either trigger a message start or intermediate message catching event.
   * @link http://docs.camunda.org/api-references/rest/#!/message/post-message
   *
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function message($parameterArray) {
    $query = 'message';
    return $this->restPostRequest($query, $parameterArray);
  }


/*---------------------- IDENTITY OPERATIONS -------------------------------------*/

  /**
   * Gets the groups of a user and all users that share a group with the given user.
   * @link http://docs.camunda.org/api-references/rest/#!/identity/get-group-info
   *
   * @param Array $parameterArray url parameter
   * @return mixed returns the server-response
   */
  public function getUserGroups($parameterArray) {
    $query = '/identity/groups';
    return $this->restGetRequest($query, $parameterArray);
  }


/*---------------------- REQUEST OPERATIONS -------------------------------------*/
  /**
   * requests the data from the rest api as GET-REQUEST via curl or with stream api fallback
   *
   * @param String $query asked query of the rest api
   * @param Array $parameterArray parameters for filter
   * @return mixed returns the server-response
   */
  private function restGetRequest($query, $parameterArray) {
    $requestString = '/'. $query;


    if($parameterArray != null && !empty($parameterArray)) {
      $requestString .= '?';
      $i = 0;
      $countParameters = count($parameterArray);

      foreach($parameterArray AS $id => $value) {
        if($i == ($countParameters - 1)) {
          $requestString .= $id.'='.$value;
        } else {
          $requestString .= $id.'='.$value.'&';
          $i++;
        }
      }
    }
    if($this->checkCurl()) {
      $ch = curl_init($this->engineUrl.$requestString);
      curl_setopt ($ch, CURLOPT_COOKIEJAR, $this->cookieFilePath);
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->cookieFilePath);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

      $request = curl_exec($ch);
      curl_close($ch);
    } else {
     $request = file_get_contents($this->engineUrl.$requestString);
    }
      return json_decode($request);
  }

  /**
   * requests the data from the rest api as POST-REQUEST via curl or with stream api fallback
   *
   * @param String $query asked query of the rest api
   * @param Array $parameterArray parameters for filter
   * @return mixed returns the server-response
   */
  private function restPostRequest($query, $parameterArray) {
    $dataString = json_encode($parameterArray);

    if($this->checkCurl()) {
      $ch = curl_init($this->engineUrl.$query);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: '.strlen($dataString)
      ));

      $request = curl_exec($ch);
      curl_close($ch);
    } else {
      $streamContext = stream_context_create(array(
          'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json'."\r\n"
                        .'Content-Length:'.strlen($dataString)."\r\n",
            'content' => $dataString
          )
        )
      );

      $request = file_get_contents($this->engineUrl.$query, null, $streamContext);
    }

    return json_decode($request);

  }

  private function checkCurl() {
    return function_exists('curl_version');
  }
}