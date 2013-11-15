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
use org\camunda\php\sdk\entity\response\VariableInstance;

class RequestService {
  private $requestObject;
  private $requestMethod = "GET";
  private $requestUrl;
  private $http_status_code;
  private $restApiUrl;

  public function __construct($restApiUrl) {
    $this->restApiUrl = $restApiUrl;
  }

  /**
   * @param Request $requestObject
   */
  protected function setRequestObject(Request $requestObject = null) {
    $this->requestObject = $requestObject;
  }

  /**
   * @return mixed
   */
  protected function getRequestObject() {
    return $this->requestObject;
  }

  /**
   * @param mixed $requestMethod
   */
  protected function setRequestMethod($requestMethod) {
    $this->requestMethod = $requestMethod;
  }

  /**
   * @return mixed
   */
  protected function getRequestMethod() {
    return $this->requestMethod;
  }

  /**
   * @param $requestUrl
   */
  protected function setRequestUrl($requestUrl) {
    $this->requestUrl = $requestUrl;
  }

  /**
   * @return mixed
   */
  protected function getRequestUrl() {
    return $this->requestUrl;
  }

  /**
   * @param mixed $http_status_code
   */
  public function setHttpStatusCode($http_status_code) {
    $this->http_status_code = $http_status_code;
  }

  /**
   * @return mixed
   */
  public function getHttpStatusCode() {
    return $this->http_status_code;
  }



  /**
   * executes the rest request
   *
   * @throws \Exception
   * @return mixed server response
   */
  protected function execute() {
    $this->restApiUrl = preg_replace('/\/$/', '', $this->restApiUrl);

    $tmp = array();

    if($this->requestMethod != 'GET') {
      if(isset($this->requestObject)) {
        foreach($this->requestObject->iterate() AS $index => $value) {
          if($value != null && !empty($value)) {
            // We need to change the Objects of Profile and Credentials into an Array
            if($value instanceof ProfileRequest ||$value instanceof CredentialsRequest) {
              $objArray = array();
               foreach($value->iterate() AS $i => $d) {
                 if(!empty($d)) {
                   $objArray[$i] = $d;
                 }
               }
               $value = $objArray;
            }

            // Needed for Modifications and Deletions in VariableRequest
            // Changes Array Data into a new Array if these are instances of VariableRequest
            if(is_array($value)) {
              foreach($value AS $valueIndex => $valueData) {
                if($valueData instanceof VariableRequest) {
                  $objArray = array();
                  foreach($valueData->iterate() AS $i => $d) {
                    if(!empty($d)) {
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
      }

      if(empty($tmp)) {
        $tmp = new \stdClass();
      }
      $data = json_encode($tmp);

    } else {
      $data = '?';
      if(isset($this->requestObject)) {
        foreach($this->requestObject->iterate() AS $index => $value) {
          if($value != null && !empty($value)) {
            $tmp[] = $index.'='.$value;
          }
        }
      }

      $data .= implode('&', $tmp);
    }

    switch(strtoupper($this->requestMethod)) {
      case 'OPTIONS':
        if($this->checkCurl()) {
          $ch = curl_init($this->restApiUrl.$this->requestUrl);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $request = curl_exec($ch);
          $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          curl_close($ch);
        } else {
          $streamContext = stream_context_create(array(
              'http' => array(
                'method' => 'OPTIONS'
              )
            )
          );
          $request = file_get_contents($this->restApiUrl.$this->requestUrl, null, $streamContext);
          $this->http_status_code = substr($http_response_header[0], 9, 3);
        }
        break;

      case 'DELETE':
        if($this->checkCurl()) {
          $ch = curl_init($this->restApiUrl.$this->requestUrl);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($data)
          ));
          $request = curl_exec($ch);
          $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          curl_close($ch);
        } else {
          $streamContext = stream_context_create(array(
              'http' => array(
                'method' => 'DELETE',
                'header' => 'Content-Type: application/json'."\r\n"
                .'Content-Length:'.strlen($data)."\r\n",
                'content' => $data
              )
            )
          );
          $request = file_get_contents($this->restApiUrl.$this->requestUrl, null, $streamContext);
          $this->http_status_code = substr($http_response_header[0], 9, 3);
        }
        break;
      case 'PUT':
        if($this->checkCurl()) {
          $ch = curl_init($this->restApiUrl.$this->requestUrl);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
          curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($data)
          ));

          $request = curl_exec($ch);
          $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
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

          $request = file_get_contents($this->restApiUrl.$this->requestUrl, null, $streamContext);
          $this->http_status_code = substr($http_response_header[0], 9, 3);
        }
        break;
      case 'POST':
        if($this->checkCurl()) {
          $ch = curl_init($this->restApiUrl.$this->requestUrl);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($data)
          ));
          $request = curl_exec($ch);
          $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
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

          $request = file_get_contents($this->restApiUrl.$this->requestUrl, null, $streamContext);
          $this->http_status_code = substr($http_response_header[0], 9, 3);
        }
        break;
      case 'GET':
      default:

      if($this->checkCurl()) {
        $ch = curl_init($this->restApiUrl.$this->requestUrl.$data);
        curl_setopt ($ch, CURLOPT_COOKIEJAR, './');
        curl_setopt ($ch, CURLOPT_COOKIEFILE, './');
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

        $request = curl_exec($ch);
        $this->http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
      } else {
        $request = file_get_contents($this->restApiUrl.$this->requestUrl.$data);
        $this->http_status_code = substr($http_response_header[0], 9, 3);
      }
        break;
    }

    if(preg_match('/(^10|^20)[0-9]/', $this->http_status_code)) {
      $this->reset();
      return json_decode($request);
    } else {
      $this->reset();
      if($request != null && $request != "" && !empty($request)) {
        $error = json_decode($request);
      } else {
        $error = new \stdClass();
        $error->type = "Not found!";
        $error->message = "No Message!";
      }
      throw new \Exception("Error! HTTP Status Code: " .$this->http_status_code. " -- ErrorType: ". $error->type . " --
      Error Message: ". $error->message);
    }
  }

  /**
   * simple curl check
   *
   * @return bool
   */
  private function checkCurl() {
    return function_exists('curl_version');
  }

  private function reset() {
    $this->setRequestObject(null);
    $this->setRequestUrl('');
    $this->setRequestMethod('GET');
  }

}