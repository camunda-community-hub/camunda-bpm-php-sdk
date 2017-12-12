<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.06.13
 * Time: 09:13
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\entity\request\ProcessDefinitionRequest;
use org\camunda\php\sdk\entity\request\StatisticRequest;
use org\camunda\php\sdk\entity\response\Form;
use org\camunda\php\sdk\entity\response\ProcessDefinition;
use org\camunda\php\sdk\entity\response\ProcessInstance;
use org\camunda\php\sdk\entity\response\Statistic;

class ProcessDefinitionService extends RequestService
{

    /**
     * Retrieves a single process definition according to the
     * ProcessDefinition interface in the engine.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get
     *
     * @param String $id ID of the requested definition
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ProcessDefinition $this Requested definition
     */
    public function getDefinition(string $id): ProcessDefinition
    {
        $processDefinition = new ProcessDefinition();
        $this->setRequestUrl('/process-definition/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $processDefinition->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves a single process definition according to the
     * ProcessDefinition interface in the engine.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get
     *
     * @param String $key Key of the requested definition
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ProcessDefinition $this Requested definition
     */
    public function getDefinitionByKey(string $key): ProcessDefinition
    {
        $processDefinition = new ProcessDefinition();
        $url = $this->tenantId ? '/process-definition/key/' . $key . '/tenant-id/' . $this->tenantId : '/process-definition/key/' . $key;
        $this->setRequestUrl($url);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $processDefinition->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves a list of process definitions
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-query
     *
     * @param ProcessDefinitionRequest $request filter parameters
     * @throws CamundaApiException
     * @return ProcessDefinition[]
     */
    public function getDefinitions(ProcessDefinitionRequest $request): array
    {
        if ($this->tenantId) {
            $request->setTenantIdIn([$this->tenantId]);
        }
        $this->setRequestUrl('/process-definition/');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $processDefinition = new ProcessDefinition();
                $response[$index] = $processDefinition->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Request the number of process definitions that fulfill the query criteria.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-query-count
     *
     * @param ProcessDefinitionRequest $request filtered parameters
     * @throws CamundaApiException
     * @return int Amount of jobs
     */
    public function getCount(ProcessDefinitionRequest $request): int
    {
        $this->setRequestUrl('/process-definition/count');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            return $this->execute()->count;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the BPMN 2.0 XML of this process definition.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-xml
     *
     * @param String $id process definition ID
     * @throws CamundaApiException
     * @return string
     */
    public function getBpmn20Xml(string $id): string
    {
        $this->setRequestUrl('/process-definition/' . $id . '/xml');
        $this->setRequestMethod('GET');
        $this->setRequestObject(null);

        try {
            return $this->execute()->bpmn20Xml;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the BPMN 2.0 XML of this process definition.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-xml
     *
     * @param String $key process definition KEY
     * @throws CamundaApiException
     * @return mixed
     */
    public function getBpmn20XmlByKey(string $key): string
    {
        $url = $this->tenantId ? '/process-definition/key/' . $key . '/tenant-id/' . $this->tenantId . '/xml' : '/process-definition/key/' . $key . '/xml';
        $this->setRequestUrl($url);
        $this->setRequestMethod('GET');
        $this->setRequestObject(null);

        try {
            return $this->execute()->bpmn20Xml;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Instantiates a given process definition.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/post-start-process-instance
     *
     * @param String                   $id process definition ID
     * @param ProcessDefinitionRequest $request variables
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ProcessInstance $this started process instance
     */
    public function startInstance(string $id, ProcessDefinitionRequest $request): ProcessInstance
    {
        $processInstance = new ProcessInstance();
        $this->setRequestUrl('/process-definition/' . $id . '/start');
        $this->setRequestObject($request);
        $this->setRequestMethod('POST');

        try {
            return $processInstance->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Instantiates a given process definition.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/post-start-process-instance
     *
     * @param String                   $key process definition key
     * @param ProcessDefinitionRequest $request variables
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ProcessInstance $this started process instance
     */
    public function startInstanceByKey(string $key, ProcessDefinitionRequest $request): ProcessInstance
    {
        $processInstance = new ProcessInstance();
        $url = $this->tenantId ? '/process-definition/key/' . $key . '/tenant-id/' . $this->tenantId . '/start' : '/process-definition/key/' . $key . '/start';
        $this->setRequestUrl($url);
        $this->setRequestObject($request);
        $this->setRequestMethod('POST');

        try {
            return $processInstance->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }


    /**
     * Retrieves process instances statistics
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-statistics
     *
     * @param StatisticRequest $request
     * @throws CamundaApiException
     * @return Statistic[]
     */
    public function getProcessInstanceStatistic(StatisticRequest $request): array
    {
        $this->setRequestUrl('/process-definition/statistics');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $statistic = new Statistic();
                $response[$index] = $statistic->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Get a list of activity instances statistics of the given process definition id
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-activity-statistics
     *
     * @param String           $id process definition id
     * @param StatisticRequest $request parameters
     * @throws CamundaApiException
     * @return Statistic[]
     */
    public function getActivityInstanceStatistic(string $id, StatisticRequest $request): array
    {
        $this->setRequestUrl('/process-definition/' . $id . '/statistics');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $statistic = new Statistic();
                $response[$index] = $statistic->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * get form key of the start event
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-start-form-key
     * (Prepared for 7.1.0 - context Path will come ;) )
     *
     * @param String $id process definition ID
     * @throws CamundaApiException
     * @return Form start form key
     */
    public function getStartFormKey(string $id): Form
    {
        $form = new Form();
        $this->setRequestUrl('/process-definition/' . $id . '/startForm');
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $form->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * get form key of the start event
     *
     * @link http://docs.camunda.org/api-references/rest/#!/process-definition/get-start-form-key
     * (Prepared for 7.1.0 - context Path will come ;) )
     *
     * @param String $key process definition Key
     * @throws CamundaApiException
     * @return Form start form key
     */
    public function getStartFormKeyByKey(string $key): Form
    {
        $form = new Form();
        $url = $this->tenantId ? '/process-definition/key/' . $key . '/tenant-id/' . $this->tenantId . '/startForm/' : '/process-definition/key/' . $key . '/startForm';
        $this->setRequestUrl($url);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $form->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}