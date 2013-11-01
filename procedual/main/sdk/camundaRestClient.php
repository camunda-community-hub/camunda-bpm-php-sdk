<?php
/**
 * Copyright 2013 camunda services GmbH
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 *limitations under the License.
 *
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 29.05.13
 * Time: 08:40
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk;

/**
 * representing the camunda rest api
 *
 * Class camundaAPI
 * @package org\camunda\php\sdk
 */
class camundaRestClient {

  private $engineUrl;
  private $pathSeparator = '/';

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
    return $this->restRequest('GET', $query, null);
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
    return $this->restRequest('GET', $query, null);
  }

  /**
   * get all process instances from the REST API
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query
   *
   * @param Array $parameterArray
   * @param bool $isPostRequest triggers a post request instead a get request
   * @return mixed returns the server response
   */
  public function getProcessInstances($parameterArray = null, $isPostRequest = false) {
    $query = 'process-instance';
    if(!$isPostRequest) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * get count of all requested process instances
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query-count
   *
   * @param Array $parameterArray
   * @param bool $isPostRequest triggers a post request instead a get request
   * @return mixed returns the server response
   */
  public function getProcessInstanceCount($parameterArray = null, $isPostRequest = false) {
    $query = 'process-instance/count';
    if(!$isPostRequest) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * get all process instances with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query
   *
   * @deprecated instead use getProcessInstances with $isPostRequest-Parameter
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessInstanceByPost($parameterArray = null) {
    return $this->getProcessInstances($parameterArray, true);
  }

  /**
   * get count of all requested process instances with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query-count
   *
   * @deprecated instead use getProcessInstanceCount function with $isPostRequest-Parameter
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getProcessInstanceCountByPost($parameterArray = null) {
    return $this->getProcessInstanceCount($parameterArray, true);
  }


  /**
   * Retrieves a variable of a given process instance.
   * @Link http://docs.camunda.org/api-references/rest/#!/process-instance/get-single-variable
   *
   * @param String $id
   * @param String $varId
   * @param Array $parameterArray
   * @return mixed returns the server response
   */
  public function getSingleProcessVariable($id, $varId, $parameterArray = null) {
    $query = 'process-instance/'.$id.'/variables/'.$varId;
    return $this->restRequest('GET', $query, $parameterArray);
  }

  /**
   * Sets a variable of a given process instance.
   * @Link http://docs.camunda.org/api-references/rest/#!/process-instance/put-single-variable
   *
   * @param String $id Process-Instance ID
   * @param String $varId Variable ID
   * @param mixed $parameterArray Variable value
   */
  public function putSingleProcessVariable($id, $varId, $parameterArray) {
    $query = 'process-instance/'.$id.'/variables/'.$varId;
    $this->restRequest('PUT', $query, $parameterArray);
  }

  /**
   * Deletes a variable of a given process instance.
   * @Link http://docs.camunda.org/api-references/rest/#!/process-instance/delete-single-variable
   *
   * @param String $id Process-Instance ID
   * @param String $varId Variable ID
   */
  public function deleteSingleProcessVariable($id, $varId) {
    $query = 'process-instance/'.$id.'/variables/'.$varId;
    $this->restRequest('DELETE', $query);
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
    return $this->restRequest('GET', $query, null);
  }

  /**
   * Updates or deletes the variables of a process instance.
   * Updates precede deletes. So if a variable is updated AND deleted, the deletion overrides the update.
   * @Link http://docs.camunda.org/api-references/rest/#!/process-instance/post-variables
   *
   * @param String $id Process-Instance ID
   * @param Array $parameterArray Request Parameters
   */
  public function updateOrRemoveProcessVariables($id, $parameterArray) {
    $query = 'process-instance/'.$id.'/variables';
    $this->restRequest('POST', $query, $parameterArray);
  }

  /**
   * Deletes a running process instance.
   * @Link http://docs.camunda.org/api-references/rest/#!/process-instance/delete
   *
   * @param String $id Process-Instance ID
   * @param String $reason Reason for delete
   */
  public function deleteProcessInstance($id, $reason) {
    $query = 'process-instance/'.$id;
    $this->restRequest('DELETE', $query);
  }

  /**
   * get all activity instances from given process-instance
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-activity-instances
   *
   * @param String $id process instance id
   * @return mixed server response
   */
  public function getActivityInstances($id) {
    $query = 'process-instance/'.$id.'/activity-instances';
    return $this->restRequest('GET', $query, null);
  }


  /*---------------------- EXECUTIONS -------------------------------------*/

  /**
   * Retrieves a single execution according to the Execution interface in the engine
   * @link http://docs.camunda.org/api-references/rest/#!/execution/get
   *
   * @param String $id Id of the execution
   * @return mixed  returns the server response
   */
  public function getSingleExecution($id) {
    $query = 'execution/'.$id;
    return $this->restRequest('GET', $query, null);
  }

  /**
   * Query for the number of executions that fulfill given parameters.
   * Parameters may be static as well as dynamic runtime properties of executions.
   * @link http://docs.camunda.org/api-references/rest/#!/execution/get-query
   *
   * @param Array $parameterArray Request parameters
   * @param bool $isPostRequest triggers a post request instead a get request
   * @return mixed returns the server response
   */
  public function getExecutions($parameterArray = null, $isPostRequest = false) {
    $query = 'execution';
    if(!$isPostRequest) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * Query for the number of executions that fulfill given parameters.
   * @link http://docs.camunda.org/api-references/rest/#!/execution/get-query-count
   *
   * @param Array $parameterArray Request parameters
   * @param bool $isPostRequest triggers a post request instead a get request
   * @return mixed returns the server response
   */
  public function getExecutionsCount($parameterArray = null, $isPostRequest = false) {
    $query = 'execution/count';
    if(!$isPostRequest) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * Query for executions that fulfill given parameters through a json object.
   * @link http://docs.camunda.org/api-references/rest/#!/execution/post-query
   *
   * @deprecated use $isPostRequest-Parameter in normal getExecutions-function
   * @param Array $parameterArray Request Parameter
   * @return mixed returns the server response
   */
  public function getExecutionsByPost($parameterArray = null) {
    return $this->getExecutions($parameterArray, true);
  }

  /**
   * Query for the number of executions that fulfill given parameters.
   * @link http://docs.camunda.org/api-references/rest/#!/execution/post-query-count
   *
   * @deprecated use $isPostRequest-Parameter in normal getExecutionsCount-function
   * @param Array $parameterArray Request parameter
   * @return mixed returns the server response
   */
  public function getExecutionsCountByPost($parameterArray = null) {
    return $this->getExecutionsCount($parameterArray, true);
  }

  /**
   * Retrieves a variable from the context of a given execution. Does not traverse the parent execution hierarchy.
   * @Link http://docs.camunda.org/api-references/rest/#!/execution/get-local-variable
   *
   * @param String $id execution ID
   * @param String $varId variables ID
   * @return mixed all found executions
   */
  public function getLocalExecutionVariable($id, $varId) {
    $query = 'execution/'.$id.'/localVariables/'.$varId;
    return $this->restRequest('GET', $query, null);
  }

  /**
   * Sets a variable in the context of a given execution. Update does not propagate upwards in the execution hierarchy.
   * @Link http://docs.camunda.org/api-references/rest/#!/execution/put-local-variable
   *
   * @param String $id execution ID
   * @param String $varId variables ID
   * @param mixed $parameterArray variables value
   */
  public function putLocalExecutionVariable($id, $varId, $parameterArray) {
    $query = 'execution/'.$id.'/localVariables/'.$varId;
    $this->restRequest('PUT', $query, $parameterArray);
  }

  /**
   * Deletes a variable in the context of a given execution. Deletion does not propagate upwards in the
   * execution hierarchy.
   * @Link http://docs.camunda.org/api-references/rest/#!/execution/delete-local-variable
   *
   * @param $id
   * @param $varId
   */
  public function deleteLocalExecutionVariable($id, $varId) {
    $query = 'execution/'.$id.'/localVariables/'.$varId;
    $this->restRequest('DELETE', $query);
  }

  /**
   * Retrieves all variables of a given execution
   * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-variables
   *
   * @param String $id Id of the process instance
   * @return mixed  returns the server response
   */
  public function getLocalExecutionVariables($id) {
    $query = 'execution/'.$id.'/localVariables';
    return $this->restRequest('GET', $query, null);
  }

  /**
   * Updates or deletes the variables in the context of an execution. The updates do not propagate upwards in the
   * execution hierarchy. Updates precede deletes. So if a variable is updated AND deleted, the deletion overrides
   * the update.
   * @Link http://docs.camunda.org/api-references/rest/#!/execution/post-local-variables
   *
   * @param String $id execution ID
   * @param Array $parameterArray Request parameters
   */
  public function updateOrRemoveLocalExecutionVariables($id, $parameterArray) {
    $query = 'execution/'.$id.'/localVariables';
    $this->restRequest('POST', $query, $parameterArray);
  }

  /**
   * Get a message event subscription for a specific execution and a message name.
   * @Link http://docs.camunda.org/api-references/rest/#!/execution/get-message-subscription
   *
   * @param String $id
   * @param String $messageName
   */
  public function getMessageEventSubscription($id, $messageName) {
    $query = 'execution/'.$id.'/messageSubscriptions/'.$messageName;
    $this->restRequest('GET', $query, null);
  }

  /**
   * Deliver a message to a specific execution to trigger an existing message event subscription.
   * Inject process variables as the message's payload.
   *
   * @param String $id
   * @param String $messageName
   * @param Array $parameterArray
   */
  public function triggerMessageEventSubscription($id, $messageName, $parameterArray) {
    $query = 'execution/'.$id.'/messageSubscriptions/'.$messageName.'/trigger';
    $this->restRequest('POST', $query, $parameterArray);
  }

  /**
   * Signals a single execution. Can for example be used to explicitly skip user tasks or signal asynchronous
   * continuations.
   * @Link http://docs.camunda.org/api-references/rest/#!/execution/post-signal
   *
   * @param String $id
   * @param Array $parameterArray Request Parameter
   * @return mixed
   */
  public function triggerExecution($id, $parameterArray) {
    $query = 'execution/'.$id.'/signal';
    return $this->restRequest('POST', $query, $parameterArray);
  }


  /*---------------------- JOBS -------------------------------------*/
  /**
   * get single job
   * @link http://docs.camunda.org/api-references/rest/#!/job/get
   *
   * @param String $id id of the job to fetch
   * @return mixed returns the server response
   */
  public function getSingleJob($id) {
    $query = 'job/'.$id;
    return $this->restRequest('GET', $query, null);
  }

  /**
   * get all jobs
   * @link http://docs.camunda.org/api-references/rest/#!/job/get-query
   * @link http://docs.camunda.org/api-references/rest/#!/job/post-query
   *
   * @param Array $parameterArray request body
   * @param bool $isPostRequest switch for GET or POST requests
   * @return mixed server response
   */
  public function getJobs($parameterArray, $isPostRequest = false) {
    $query = 'job';
    if($isPostRequest == false) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * get count of jobs
   * @link http://docs.camunda.org/api-references/rest/#!/job/get-query-count
   * @link http://docs.camunda.org/api-references/rest/#!/job/post-query-count
   *
   * @param Array $parameterArray request body
   * @param bool $isPostRequest switch for GET or POST requests
   * @return mixed server response
   */
  public function getJobCount($parameterArray, $isPostRequest = false) {
    $query = 'job/count';
    if($isPostRequest == false) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * set the amount of retries
   * @link http://docs.camunda.org/api-references/rest/#!/job/put-set-job-retries
   *
   * @param String $id Id of the job
   * @param Array $parameterArray request body
   */
  public function setJobRetries($id, $parameterArray) {
    $query = 'job/'.$id.'/retries';
    $this->restRequest('PUT', $query, $parameterArray);
  }

  /**
   * start job execution
   * @link http://docs.camunda.org/api-references/rest/#!/job/post-execute-job
   *
   * @param String $id Id of the job
   */
  public function executeJob($id) {
    $query = 'job/'.$id.'/execute';
    $this->restRequest('POST', $query, null);
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
    return $this->restRequest('GET', $query, null);
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
    return $this->restRequest('GET', $query, $parameterArray);
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
    return $this->restRequest('GET', $query, $parameterArray);
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
    return $this->restRequest('GET', $query, null);
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
    return $this->restRequest('POST', $query, $processVariables);
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
    return $this->restRequest('GET', $query, $parameterArray);
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
    return $this->restRequest('GET', $query, $parameterArray);
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
    $query = 'process-definition/'.$id.'/startForm';
    return $this->restRequest('GET', $query, null);
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
    return $this->restRequest('GET', $query, null);
  }

  /**
   * get all tasks from the rest api
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-query
   *
   * @param Array $parameterArray url parameter
   * @param bool $isPostRequest triggers a post request instead a get request
   * @return mixed returns the server-response
   */
  public function getTasks($parameterArray = null, $isPostRequest = false) {
    $query = 'task';
    if (!$isPostRequest) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * get count of all requested process definitions
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-query-count
   *
   * @param Array $parameterArray url parameter
   * @param bool $isPostRequest triggers a post request instead a get request
   * @return mixed returns the server response
   */
  public function getTaskCount($parameterArray = null, $isPostRequest = false) {
    $query = 'task/count';
    if (!$isPostRequest) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /**
   * get all tasks from the rest api with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-query
   *
   * @deprecated instead use getTasks function with $isPostRequest-Parameter
   * @param Array $parameterArray url parameter
   * @return mixed returns the server-response
   */
  public function getTasksByPost($parameterArray = null) {
    return $this->getTasks($parameterArray, true);
  }

  /**
   * get count of all requested process definitions with POST-Request
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-query-count
   *
   * @deprecated instead use getTaskCount function with $isPostRequest-Parameter
   * @param Array $parameterArray url parameter
   * @return mixed returns the server response
   */
  public function getTaskCountByPost($parameterArray = null) {
    return $this->getTaskCount($parameterArray, true);
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
    $query = 'task/'.$id.'/form';
    return $this->restRequest('GET', $query, null);
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
    return $this->restRequest('POST', $query, $parameterArray);
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
    return $this->restRequest('POST', $query, null);
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
    return $this->restRequest('POST', $query, $parameterArray);
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
    return $this->restRequest('POST', $query, $parameterArray);
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
    return $this->restRequest('POST', $query, $parameterArray);
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
    return $this->restRequest('POST', $query, $parameterArray);
  }


  /*---------------------- VARIABLE INSTANCE OPERATIONS -------------------------------------*/


  /**
   * get all variable instances
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/get-query
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/post-query
   *
   * @param Array $parameterArray request body
   * @param bool $isPostRequest switch for GET or POST requests
   * @return mixed server response
   */
  public function getVariableInstances($parameterArray = null, $isPostRequest = false) {
    $query = 'variable-instance';
    if($isPostRequest == false) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }

  }

  /**
   * get amount of variable instances
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/get-query-count
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/post-query-count
   *
   * @param Array $parameterArray request body
   * @param bool $isPostRequest switch for GET or POST request
   * @return mixed server response
   */
  public function getVariableInstancesCount($parameterArray = null, $isPostRequest = false) {
    $query = 'variable-instance/count';
    if($isPostRequest == false) {
      return $this->restRequest('GET', $query, $parameterArray);
    } else {
      return $this->restRequest('POST', $query, $parameterArray);
    }
  }

  /*---------------------- IDENTITY OPERATIONS -------------------------------------*/

  /**
   * Gets the groups of a user.
   * This feature is deprecated and will be removed with the next version!
   *
   * @param String $userId user Id
   * @return mixed returns the server-response
   * @deprecated  No longer used by rest API and not recommended
   */
  public function getUserGroups($userId) {
    $parameterArray = array(
      'member' => $userId
    );
    return $this->getGroups($parameterArray);
  }


  /*---------------------- GROUP OPERATIONS -------------------------------------*/

  /**
   * create a new group
   * @link http://docs.camunda.org/api-references/rest/#!/group/post-create
   *
   * @param Array $parameterArray
   */
  public function createSingleGroup($parameterArray) {
    $query = 'group/create';
    $this->restRequest('POST', $query, $parameterArray);
  }

  /**
   * add a member to a group
   * @link http://docs.camunda.org/api-references/rest/#!/group/members/put
   *
   * @param String $groupId
   * @param String $userId
   */
  public function addGroupMember($groupId, $userId) {
    $query = 'group/'.$groupId.'/members/'.$userId;
    $this->restRequest('PUT', $query, null);
  }

  /**
   * removes the group with the given id
   * @link http://docs.camunda.org/api-references/rest/#!/group/delete
   *
   * @param String $id group id
   */
  public function deleteSingleGroup($id) {
    $query = 'group/'.$id;
    $this->restRequest('DELETE', $query);
  }

  /**
   * removes the given user from the group
   * @link http://docs.camunda.org/api-references/rest/#!/group/members/delete
   *
   * @param $groupId
   * @param $userId
   */
  public function removeGroupMember($groupId, $userId){
    $query = 'group/'.$groupId.'/members/'.$userId;
    $this->restRequest('DELETE', $query);
  }

  /**
   * get group by given id
   * @link http://docs.camunda.org/api-references/rest/#!/group/get
   *
   * @param String $id group id
   * @return mixed server response
   */
  public function getSingleGroup($id) {
    $query = 'group/'.$id;
    return $this->restRequest('GET', $query, null);
  }

  /**
   * get all groups by given parameters
   * @link http://docs.camunda.org/api-references/rest/#!/group/get-query
   *
   * @param Array $parameterArray request body
   * @return mixed server response
   */
  public function getGroups($parameterArray = null) {
    $query = 'group';
    return $this->restRequest('GET', $query, $parameterArray);
  }

  /**
   * get amount of groups
   * @link http://docs.camunda.org/api-references/rest/#!/group/get-query-count
   *
   * @param Array $parameterArray request body
   * @return mixed server response
   */
  public function getGroupsCount($parameterArray = null) {
    $query = 'group/count';
    return $this->restRequest('GET', $query, $parameterArray);
  }

  /**
   * update group by given id
   * @link http://docs.camunda.org/api-references/rest/#!/group/put-update
   *
   * @param String $id group id
   * @param Array $parameterArray request body
   */
  public function updateSingleGroup($id, $parameterArray) {
    $query = 'group/'.$id;
    $this->restRequest('PUT', $query, $parameterArray);
  }


  /*---------------------- USER OPERATIONS -------------------------------------*/

  /**
   * create new user
   * @link http://docs.camunda.org/api-references/rest/#!/user/post-create
   *
   * @param Array $parameterArray  request body
   * @return mixed server response
   */
  public function createSingleUser($parameterArray) {
    $query = 'user/create';
    return $this->restRequest('POST', $query, $parameterArray);
  }

  /**
   * remove user
   * @link http://docs.camunda.org/api-references/rest/#!/user/delete
   *
   * @param String $id user Id
   */
  public function deleteSingleUser($id) {
    $query = 'user/'.$id;
    $this->restRequest('DELETE', $query);
  }

  /**
   * get the profile of the given user
   * @link http://docs.camunda.org/api-references/rest/#!/user/get
   *
   * @param $id
   * @return mixed
   */
  public function getUserProfile($id) {
    $query = 'user/'.$id.'/profile';
    return $this->restRequest('GET', $query, null);
  }

  /**
   * get a list of users
   * @link http://docs.camunda.org/api-references/rest/#!/user/get-query
   *
   * @param Array $parameterArray request body
   * @return mixed server response
   */
  public function getUsers($parameterArray = null) {
    $query = 'user';
    return $this->restRequest('GET', $query, $parameterArray);
  }


  /**
   * get count of users
   * @link http://docs.camunda.org/api-references/rest/#!/user/get-query-count
   *
   * @param Array $parameterArray request body
   * @return mixed server response
   */
  public function getUserCount($parameterArray = null) {
    $query = 'user/count';
    return $this->restRequest('GET', $query, $parameterArray);
  }

  /**
   * update the profile of a user
   * @link http://docs.camunda.org/api-references/rest/#!/user/put-update-profile
   *
   * @param String $id user Id
   * @param Array $parameterArray request body
   */
  public function updateUserProfile($id, $parameterArray) {
    $query = 'user/'.$id.'/profile';
    $this->restRequest('PUT', $query, $parameterArray);
  }

  /**
   * update the password of the given user
   * @link http://docs.camunda.org/api-references/rest/#!/user/put-update-credentials
   *
   * @param String $id
   * @param Array $parameterArray
   */
  public function updateUserCredentials($id, $parameterArray) {
    $query = 'user/'.$id.'/credentials';
    $this->restRequest('PUT', $query, $parameterArray);
  }


  /*---------------------- REQUEST OPERATIONS -------------------------------------*/

  /**
   * requests the data from the rest api as GET-REQUEST via curl or with stream api fallback
   *
   * @deprecated
   * @param String $query asked query of the rest api
   * @param Array $parameterArray parameters for filter
   * @return mixed returns the server-response
   */
  private function restGetRequest($query, $parameterArray) {
    $this->restRequest('GET', $query, $parameterArray);
  }

  /**
   * requests the data from the rest api as POST-REQUEST via curl or with stream api fallback
   *
   * @deprecated
   * @param String $query asked query of the rest api
   * @param Array $parameterArray parameters for filter
   * @return mixed returns the server-response
   */
  private function restPostRequest($query, $parameterArray) {
    $this->restRequest('POST', $query, $parameterArray);
  }


  /**
   * requests the data from the rest api as PUT-REQUEST via curl or with stream api fallback
   *
   * @deprecated
   * @param String $query asked query of the rest api
   * @param Array $parameterArray Put parameters
   * @return mixed returns the server-response
   */
  private function restPutRequest($query, $parameterArray) {
    $this->restRequest('PUT', $query, $parameterArray);

  }

  /**
   * requests a deletion of data from the REST API via DELETE
   *
   * @deprecated
   * @param String $query asked query of the rest api
   * @return mixed returns the server-response
   */
  private function restDeleteRequest($query) {
    $this->restRequest('DELETE', $query);
  }

  /**
   * Sends the query with the parameters as body or parameter-string.
   *
   * @param String $method Request method
   * @param String $query Resource path
   * @param Array $parameters parameters for request
   * @return mixed
   */
  private function restRequest($method, $query, $parameters = null) {
    $this->engineUrl = preg_replace('/\/$/', '', $this->engineUrl);

    if(strtoupper($method) != 'GET') {
      if($parameters == null) {
        $parameters = (object) array();
      }
      $data = json_encode($parameters);
    } else {
      $data = '?';
      $tmp = array();
      if($parameters != null) {
        foreach($parameters AS $index => $key) {
          $tmp[] = $index.'='.$key;
        }
      }
      $data .= implode('&', $tmp);
    }

    $query = preg_replace('/^\//', '', $query);

    switch(strtoupper($method)) {
      case 'DELETE':
        if($this->checkCurl()) {
          $ch = curl_init($this->engineUrl.$this->pathSeparator.$query);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($data)
          ));
          $request = curl_exec($ch);
          curl_close($ch);
        } else {
          $streamContext = stream_context_create(array(
              'http' => array(
                'method' => 'PUT',
                'header' => 'Content-Type: application/json'."\r\n"
                .'Content-Length:'.strlen($data)."\r\n",
                'content' => $data
              )
            )
          );

          $request = file_get_contents($this->engineUrl.$this->pathSeparator.$query, null, $streamContext);
        }
        break;
      case 'PUT':
        if($this->checkCurl()) {
          $ch = curl_init($this->engineUrl.$this->pathSeparator.$query);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($data)
          ));

          $request = curl_exec($ch);
          curl_close($ch);
        } else {
          $streamContext = stream_context_create(array(
              'http' => array(
                'method' => 'PUT',
                'header' => 'Content-Type: application/json'."\r\n"
                .'Content-Length:'.strlen($data)."\r\n",
                'content' => $data
              )
            )
          );

          $request = file_get_contents($this->engineUrl.$this->pathSeparator.$query, null, $streamContext);
        }
        break;
      case 'POST':
        if($this->checkCurl()) {
          $ch = curl_init($this->engineUrl.$this->pathSeparator.$query);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($data)
          ));
          $request = curl_exec($ch);
          curl_close($ch);
        } else {
          $streamContext = stream_context_create(array(
              'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/json'."\r\n"
                .'Content-Length:'.strlen($data)."\r\n",
                'content' => $data
              )
            )
          );

          $request = file_get_contents($this->engineUrl.$this->pathSeparator.$query, null, $streamContext);
        }
        break;
      case 'GET':
      default:
        if($this->checkCurl()) {
          $ch = curl_init($this->engineUrl.$this->pathSeparator.$query.$data);
          curl_setopt($ch, CURLOPT_COOKIEJAR, './');
          curl_setopt($ch, CURLOPT_COOKIEFILE, './');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $request = curl_exec($ch);
          curl_close($ch);
        } else {
          $request = file_get_contents($this->engineUrl.$this->pathSeparator.$query.$data);
        }
        break;
    }
    return json_decode($request);
  }

  private function checkCurl() {
    return function_exists('curl_version');
  }
}