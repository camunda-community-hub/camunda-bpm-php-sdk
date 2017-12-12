<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\entity\request\VariableInstanceRequest;
use org\camunda\php\sdk\entity\response\VariableInstance;

class VariableInstanceService extends RequestService
{
    /**
     * Retrieves all variable instances within given context
     *
     * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/get-query
     * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/post-query
     *
     * @param VariableInstanceRequest $request filter parameters
     * @param bool                    $isPostRequest switch for GET/POST request
     * @throws CamundaApiException
     * @return VariableInstance[]
     */
    public function getInstances(VariableInstanceRequest $request, bool $isPostRequest = false): array
    {
        $this->setRequestUrl('/variable-instance');
        $this->setRequestObject($request);
        if ($isPostRequest == true) {
            $this->setRequestMethod('POST');
        } else {
            $this->setRequestMethod('GET');
        }

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $variableInstance = new VariableInstance();
                $response[$index] = $variableInstance->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the amount of variable instances
     *
     * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/get-query-count
     * @link http://docs.camunda.org/api-references/rest/#!/variable-instance/post-query-count
     *
     * @param VariableInstanceRequest $request filter parameters
     * @param bool                    $isPostRequest switch for GET/POST request
     * @throws CamundaApiException
     * @return int Amount of variable instances
     */
    public function getCount(VariableInstanceRequest $request, bool $isPostRequest = false): int
    {
        $this->setRequestUrl('/variable-instance/count');
        $this->setRequestObject($request);
        if ($isPostRequest == true) {
            $this->setRequestMethod('POST');
        } else {
            $this->setRequestMethod('GET');
        }

        try {
            return $this->execute()->count;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}