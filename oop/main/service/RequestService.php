<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 20:43
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\Request;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\exception\CamundaApiException;

class RequestService
{
    /** @var Request */
    private $requestObject;

    /** @var string */
    private $requestMethod = "GET";

    /** @var string|null */
    private $requestUrl;

    private $http_status_code;

    /** @var string */
    private $restApiUrl;

    /** @var null|string */
    protected $tenantId;

    /** @var bool */
    protected $json = true;

    /** @var array */
    protected $requestData;

    /**
     * RequestService constructor.
     *
     * @param string      $restApiUrl
     * @param null|string $tenantId
     */
    public function __construct(string $restApiUrl, ?string $tenantId = null)
    {
        $this->restApiUrl = $restApiUrl;
        $this->tenantId = $tenantId;
    }

    /**
     * @param Request|null $requestObject
     */
    protected function setRequestObject(Request $requestObject = null)
    {
        $this->requestObject = $requestObject;
    }

    /**
     * @return Request|null
     */
    protected function getRequestObject(): ?Request
    {
        return $this->requestObject;
    }

    /**
     * @param mixed $requestMethod
     */
    protected function setRequestMethod(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * @param array $data
     */
    protected function setRequestData(array $data)
    {
        $this->requestData = $data;
    }

    /**
     * @return string
     */
    protected function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestUrl
     */
    protected function setRequestUrl(string $requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * @return string|null
     */
    protected function getRequestUrl(): ?string
    {
        return $this->requestUrl;
    }

    /**
     * @param string $http_status_code
     */
    public function setHttpStatusCode(string $http_status_code)
    {
        $this->http_status_code = $http_status_code;
    }

    /**
     * @return string|null
     */
    public function getHttpStatusCode(): ?string
    {
        return $this->http_status_code;
    }

    /**
     * executes the rest request
     *
     * @throws CamundaApiException
     * @return mixed server response
     */
    protected function execute()
    {
        $this->restApiUrl = preg_replace('/\/$/', '', $this->restApiUrl);

        $tmp = [];

        if ($this->requestMethod != 'GET') {
            if (isset($this->requestObject)) {
                foreach ($this->requestObject->iterate() as $index => $value) {
                    if ($value != null && !empty($value)) {
                        // We need to change the Objects of Profile and Credentials into an Array
                        if ($value instanceof ProfileRequest || $value instanceof CredentialsRequest) {
                            $objArray = [];
                            foreach ($value->iterate() as $i => $d) {
                                if (!empty($d)) {
                                    $objArray[$i] = $d;
                                }
                            }
                            $value = $objArray;
                        }

                        // Needed for Modifications and Deletions in VariableRequest
                        // Changes Array Data into a new Array if these are instances of VariableRequest
                        if (is_array($value)) {
                            foreach ($value as $valueIndex => $valueData) {
                                if ($valueData instanceof VariableRequest) {
                                    $objArray = [];
                                    foreach ($valueData->iterate() as $i => $d) {
                                        if (!empty($d)) {
                                            $objArray[$i] = $d;
                                        }
                                    }
                                    $valueData = $objArray;
                                }
                                $value[$valueIndex] = $valueData;
                            }
                        }
                        $tmp[$index] = $value;
                    }
                }
            } elseif ($this->requestData) {
                $tmp = $this->requestData;
            }

            if (empty($tmp)) {
                $tmp = new \stdClass();
            }
            $data = $this->json ? json_encode($tmp) : $tmp;

        } else {
            $data = '?';
            if (isset($this->requestObject)) {
                foreach ($this->requestObject->iterate() as $index => $value) {
                    if ($value != null && !empty($value)) {
                        $tmp[] = $index . '=' . $value;
                    }
                }
            }

            $data .= implode('&', $tmp);
        }

        switch (strtoupper($this->requestMethod)) {
            case 'OPTIONS':
                if ($this->checkCurl()) {
                    $ch = curl_init($this->restApiUrl . $this->requestUrl);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $request = curl_exec($ch);
                    $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                } else {
                    $streamContext = stream_context_create([
                            'http' => [
                                'method' => 'OPTIONS',
                            ],
                        ]
                    );
                    $request = file_get_contents($this->restApiUrl . $this->requestUrl, null, $streamContext);
                    $this->http_status_code = substr($http_response_header[0], 9, 3);
                }
                break;

            case 'DELETE':
                if ($this->checkCurl()) {
                    $ch = curl_init($this->restApiUrl . $this->requestUrl);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    if ($this->json) {
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data),
                        ]);
                    }
                    $request = curl_exec($ch);
                    $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                } else {
                    $streamContext = stream_context_create([
                            'http' => [
                                'method' => 'DELETE',
                                'header' => 'Content-Type: application/json' . "\r\n"
                                    . 'Content-Length:' . strlen($data) . "\r\n",
                                'content' => $data,
                            ],
                        ]
                    );
                    $request = file_get_contents($this->restApiUrl . $this->requestUrl, null, $streamContext);
                    $this->http_status_code = substr($http_response_header[0], 9, 3);
                }
                break;
            case 'PUT':
                if ($this->checkCurl()) {
                    $ch = curl_init($this->restApiUrl . $this->requestUrl);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    if ($this->json) {
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data),
                        ]);
                    }

                    $request = curl_exec($ch);
                    $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                } else {
                    $streamContext = stream_context_create([
                            'http' => [
                                'method' => 'PUT',
                                'header' => 'Content-Type: application/json' . "\r\n"
                                    . 'Content-Length:' . strlen($data) . "\r\n",
                                'content' => $data,
                            ],
                        ]
                    );

                    $request = file_get_contents($this->restApiUrl . $this->requestUrl, null, $streamContext);
                    $this->http_status_code = substr($http_response_header[0], 9, 3);
                }
                break;
            case 'POST':
                if ($this->checkCurl()) {
                    $ch = curl_init($this->restApiUrl . $this->requestUrl);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    if ($this->json) {
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data),
                        ]);
                    }
                    $request = curl_exec($ch);
                    $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                } else {
                    $streamContext = stream_context_create([
                            'http' => [
                                'method' => 'POST',
                                'header' => 'Content-Type: application/json' . "\r\n"
                                    . 'Content-Length:' . strlen($data) . "\r\n",
                                'content' => $data,
                            ],
                        ]
                    );

                    $request = file_get_contents($this->restApiUrl . $this->requestUrl, null, $streamContext);
                    $this->http_status_code = substr($http_response_header[0], 9, 3);
                }
                break;
            case 'GET':
            default:

                if ($this->checkCurl()) {
                    $ch = curl_init($this->restApiUrl . $this->requestUrl . $data);
                    curl_setopt($ch, CURLOPT_COOKIEJAR, './');
                    curl_setopt($ch, CURLOPT_COOKIEFILE, './');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $request = curl_exec($ch);
                    $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                } else {
                    $request = file_get_contents($this->restApiUrl . $this->requestUrl . $data);
                    $this->http_status_code = substr($http_response_header[0], 9, 3);
                }
                break;
        }

        if (preg_match('/(^10|^20)[0-9]/', $this->http_status_code)) {
            $this->reset();
            return json_decode($request);
        } else {
            $this->reset();
            if ($request != null && $request != "" && !empty($request)) {
                $error = json_decode($request);
            } else {
                $error = new \stdClass();
                $error->type = "Not found!";
                $error->message = "No Message!";
            }
            throw new CamundaApiException("Error! HTTP Status Code: " . $this->http_status_code . " -- ErrorType: " . $error->type . " --
      Error Message: " . $error->message);
        }
    }

    /**
     * simple curl check
     *
     * @return bool
     */
    private function checkCurl(): bool
    {
        return function_exists('curl_version');
    }

    /**
     * Reset $this
     */
    private function reset(): void
    {
        $this->setRequestObject(null);
        $this->setRequestUrl('');
        $this->setRequestMethod('GET');
    }

}