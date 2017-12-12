<?php

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;

class DeploymentService extends RequestService
{
    protected $json = false;

    /**
     * Deploy new BPMN definition
     *
     * @param string $name
     * @param string $bpmnFilePath
     * @throws CamundaApiException
     * @return mixed server response
     */
    public function deploy($name, $bpmnFilePath)
    {
        // TODO: add work with binary content
        $this->setRequestUrl('/deployment/create');
        $this->setRequestData([
            'deployment-name' => $name,
            'enable-duplicate-filtering' => true,
            'deployment-source' => 'API',
            'file' => curl_file_create($bpmnFilePath),
            'tenant-id' => $this->tenantId,
        ]);
        $this->setRequestMethod('POST');

        // TODO: add Entity Response
        return $this->execute();
    }
}
