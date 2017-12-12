<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 14:19
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\entity\response\Activity;
use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\entity\response\ProcessInstance;
use org\camunda\php\sdk\entity\response\Variable;

class ProcessInstanceService extends RequestService
{
    /**
     * Retrieves a single instance with given ID
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get
     *
     * @param String $id Process instance ID
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ProcessInstance $this requested process instance
     */
    public function getInstance(string $id): ProcessInstance
    {
        $processInstance = new ProcessInstance();
        $this->setRequestUrl('/process-instance/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $processInstance->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves all process instances within a given context.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query
     *
     * @param ProcessInstanceRequest $request filter parameters
     * @param bool                   $isPostRequest switch for GET/POST request
     * @throws CamundaApiException
     * @return ProcessInstance[]
     */
    public function getInstances(ProcessInstanceRequest $request, bool $isPostRequest = false): array
    {
        $this->setRequestUrl('/process-instance/');
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
                $processInstance = new ProcessInstance();
                $response[$index] = $processInstance->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the amount of process instances within a given context
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-query-count
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-query-count
     *
     * @param ProcessInstanceRequest $request filter parameters
     * @param bool                   $isPostRequest switch for GET/POST request
     * @throws CamundaApiException
     * @return int amount of process instances
     */
    public function getCount(ProcessInstanceRequest $request, bool $isPostRequest = false): int
    {
        $this->setRequestUrl('/process-instance/count/');
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

    /**
     * Retrieves the requested variable within a given process instance context
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-single-variable
     *
     * @param String $id process instance ID
     * @param String $variableId process variable ID
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\Variable $this requested variable
     */
    public function getProcessVariable(string $id, string $variableId): Variable
    {
        $variable = new Variable();
        $this->setRequestUrl('/process-instance/' . $id . '/variables/' . $variableId);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $variable->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Sets a variable of a given process instance
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/put-single-variable
     *
     * @param String          $id process instance ID
     * @param String          $variableId variable ID
     * @param VariableRequest $request variable properties
     * @throws CamundaApiException
     */
    public function putProcessVariable(string $id, string $variableId, VariableRequest $request): void
    {
        $this->setRequestUrl('/process-instance/' . $id . '/variables/' . $variableId);
        $this->setRequestObject($request);
        $this->setRequestMethod('PUT');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Removes a variable from a given process instance
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/delete-single-variable
     *
     * @param String $id process instance ID
     * @param String $variableId variable ID
     * @throws CamundaApiException
     */
    public function deleteProcessVariable(string $id, string $variableId): void
    {
        $this->setRequestUrl('/process-instance/' . $id . '/variables/' . $variableId);
        $this->setRequestObject(null);
        $this->setRequestMethod('DELETE');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves all variables within a given process instance
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-variables
     *
     * @param String $id process instance ID
     * @throws CamundaApiException
     * @return Variable[]
     */
    public function getProcessVariables(string $id): array
    {
        $this->setRequestUrl('/process-instance/' . $id . '/variables');
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $variable = new Variable();
                $response[$index] = $variable->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Updates or removes multiple process variables
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/post-variables
     *
     * @param String          $id process instance ID
     * @param VariableRequest $request modification and/or deletion parameters
     * @throws CamundaApiException
     */
    public function updateOrDeleteProcessVariables(string $id, VariableRequest $request): void
    {
        $this->setRequestUrl('/process-instance/' . $id . '/variables');
        $this->setRequestObject($request);
        $this->setRequestMethod('POST');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Removes a given process instance
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/delete
     *
     * @param String $id process instance ID
     * @throws CamundaApiException
     */
    public function deleteInstance(string $id): void
    {
        $this->setRequestUrl('/process-instance/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('DELETE');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves all activity instances within a given process instance context
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-instance/get-activity-instances
     *
     * @param String                 $id process instance ID
     * @param ProcessInstanceRequest $request filter parameters
     * @throws CamundaApiException
     * @return Activity[]
     */
    public function getActivityInstances(string $id, ProcessInstanceRequest $request): array
    {
        $this->setRequestUrl('/process-instance/' . $id . '/activity-instances');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $activity = new Activity();
                $response[$index] = $activity->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Activate or suspend a given process instance.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#process-instance-activatesuspend-process-instance
     *
     * @param String                 $id process instance ID
     * @param ProcessInstanceRequest $request
     * @throws CamundaApiException
     */
    public function activateOrSuspendInstance(string $id, ProcessInstanceRequest $request): void
    {
        $this->setRequestUrl('/process-instance/' . $id . '/suspended');
        $this->setRequestObject($request);
        $this->setRequestMethod('PUT');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}