<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use Exception;
use org\camunda\php\sdk\entity\request\VariableInstanceRequest;
use org\camunda\php\sdk\entity\response\VariableInstance;

class VariableInstanceService extends RequestService {

  /**
   * Retrieves all variable instances within given context
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/get-query
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/post-query
   *
   * @param VariableInstanceRequest $request filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return object list of variable instances
   */
  public function getInstances(VariableInstanceRequest $request, $isPostRequest = false){
    $this->setRequestUrl('/variable-instance');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      $prepare = $this->execute();
      $response = array();
      $variableInstance = new VariableInstance();
      foreach ($prepare AS $index => $data) {
        $response['instance_' . $index] = $variableInstance->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the amount of variable instances
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/get-query-count
   * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/post-query-count
   *
   * @param VariableInstanceRequest $request filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return int Amount of variable instances
   */
  public function getCount(VariableInstanceRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/variable-instance/count');
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