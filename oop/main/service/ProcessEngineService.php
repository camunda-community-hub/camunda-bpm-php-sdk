<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 02.07.13
 * Time: 11:08
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;

class ProcessEngineService extends RequestService
{
    /**
     * Retrieves a list of all available engines
     *
     * @link http://docs.camunda.org/api-references/rest/#!/engine/get-names
     *
     * @throws CamundaApiException
     * @return array
     */
    public function getEngineNames(): array
    {
        $this->setRequestUrl('/engine');
        $this->setRequestMethod("GET");
        $this->setRequestObject(null);

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $response[$index] = $data;
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}