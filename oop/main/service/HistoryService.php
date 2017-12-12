<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 13:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\entity\request\HistoricActivityInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricVariableInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricActivityStatisticRequest;
use org\camunda\php\sdk\entity\response\HistoricActivityInstance;
use org\camunda\php\sdk\entity\response\HistoricProcessInstance;
use org\camunda\php\sdk\entity\response\HistoricVariableInstance;
use org\camunda\php\sdk\entity\response\HistoricActivityStatistic;


class HistoryService extends RequestService
{
    /**
     * Query for historic activity instances that fulfill the given parameters.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-activity-instances-historic
     *
     * @param HistoricActivityInstanceRequest $request
     * @throws CamundaApiException
     * @return HistoricActivityInstance[]
     */
    public function getActivityInstances(HistoricActivityInstanceRequest $request): array
    {
        $this->setRequestUrl('/history/activity-instance');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $historicActivityInstance = new HistoricActivityInstance();
                $response[$index] = $historicActivityInstance->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Query for the number of historic activity instances that fulfill the given parameters.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-activity-instances-count
     *
     * @param HistoricActivityInstanceRequest $request
     * @throws CamundaApiException
     * @return Integer count
     */
    public function getActivityInstancesCount(HistoricActivityInstanceRequest $request): int
    {
        $this->setRequestUrl('/history/activity-instance/count');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            return $this->execute()->count;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Query for historic process instances that fulfill the given parameters.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances-post
     *
     * @param HistoricProcessInstanceRequest $request
     * @param bool                           $isPostRequest
     * @throws CamundaApiException
     * @return HistoricProcessInstance[]
     */
    public function getProcessInstances(HistoricProcessInstanceRequest $request, bool $isPostRequest = false): array
    {
        $this->setRequestUrl('/history/process-instance');
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
                $historicProcessInstance = new HistoricProcessInstance();
                $response[$index] = $historicProcessInstance->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Query for the number of historic process instances that fulfill the given parameters.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances-count
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-process-instances-count-post
     *
     * @param HistoricProcessInstanceRequest $request
     * @param bool                           $isPostRequest
     * @throws CamundaApiException
     * @return mixed
     */
    public function getProcessInstancesCount(HistoricProcessInstanceRequest $request, bool $isPostRequest = false): int
    {
        $this->setRequestUrl('/history/process-instance/count');
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
     * Query for historic variable instances that fulfill the given parameters.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances-post
     *
     * @param HistoricVariableInstanceRequest $request
     * @param bool                            $isPostRequest
     * @throws CamundaApiException
     * @return HistoricVariableInstance[]
     */
    public function getVariableInstances(HistoricVariableInstanceRequest $request, bool $isPostRequest = false): array
    {
        $this->setRequestUrl('/history/variable-instance');
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
                $historicVariableInstance = new HistoricVariableInstance();
                $response[$index] = $historicVariableInstance->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Query for the number of historic variable instances that fulfill the given parameters.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances-count
     * @link http://docs.camunda.org/latest/api-references/rest/#history-get-variable-instances-count-post
     *
     * @param HistoricVariableInstanceRequest $request
     * @param bool                            $isPostRequest
     * @throws CamundaApiException
     * @return int
     */
    public function getVariableInstancesCount(
        HistoricVariableInstanceRequest $request,
        bool $isPostRequest = false
    ): int {
        $this->setRequestUrl('/history/variable-instance/count');
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
     * Get a list of historic activity instances statistics of the given process definition id
     *
     * @link http://docs.camunda.org/api-references/rest/#history-get-historic-activity-statistics
     *
     * @param String                           $id process definition id
     * @param HistoricActivityStatisticRequest $request parameters
     * @throws CamundaApiException
     * @return HistoricActivityStatistic[]
     */
    public function getHistoricActivityStatistic($id, HistoricActivityStatisticRequest $request): array
    {
        $this->setRequestUrl('/history/process-definition/' . $id . '/statistics');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $statistic = new HistoricActivityStatistic();
                $response[$index] = $statistic->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}