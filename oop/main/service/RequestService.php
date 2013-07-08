<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 20:43
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\entity\request\Request;

class RequestService {
  private $requestObject;
  private $requestMethod = "GET";
  private $requestUrl;
  private $restApiUrl;

  public function __construct($restApiUrl) {
    $this->restApiUrl = $restApiUrl;
  }

  public function setRequestObject(Request $requestObject = null) {
    $this->requestObject = $requestObject;
  }

  public function getRequestObject() {
    return $this->requestObject;
  }

  /**
   * @param mixed $requestMethod
   */
  public function setRequestMethod($requestMethod) {
    $this->requestMethod = $requestMethod;
  }

  /**
   * @return mixed
   */
  public function getRequestMethod() {
    return $this->requestMethod;
  }

  /**
   * @param mixed $this->restApiUrl.$this->requestUrl
   */
  public function setRequestUrl($requestUrl) {
    $this->requestUrl = $requestUrl;
  }

  /**
   * @return mixed
   */
  public function getRequestUrl() {
    return $this->requestUrl;
  }

  public function execute() {
    $this->restApiUrl = preg_replace('/\/$/', '', $this->restApiUrl);

    $tmp = array();

    if($this->requestMethod != 'GET') {
      foreach((object) $this->requestObject AS $index => $value) {
        if($value != null && !empty($value)) {
          $tmp[$index] = $value;
        }
      }

      if(empty($tmp)) {
        $tmp = new \stdClass();
      }

      $data = json_encode($tmp);
    } else {
      $data = '?';
      foreach((object) $this->requestObject AS $index => $value) {
        if($value != null && !empty($value)) {
          $tmp[] = $index.'='.$value;
        }
      }

      $data .= implode('&', $tmp);
    }

    switch($this->requestMethod) {
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
        }
        break;
      case 'PUT':
        if($this->checkCurl()) {
          $ch = curl_init($this->restApiUrl.$this->requestUrl);
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

          $request = file_get_contents($this->restApiUrl.$this->requestUrl, null, $streamContext);
        }
        break;
      case 'POST':
        if($this->checkCurl()) {
          $ch = curl_init($this->restApiUrl.$this->requestUrl);
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

          $request = file_get_contents($this->restApiUrl.$this->requestUrl, null, $streamContext);
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
        curl_close($ch);
      } else {
        $request = file_get_contents($this->restApiUrl.$this->requestUrl.$data);
      }
        break;
    }

    // restore default
    $this->setRequestObject(null);
    $this->setRequestUrl('');
    $this->setRequestMethod('GET');

    return json_decode($request);
  }

  private function checkCurl() {
    return function_exists('curl_version');
  }

}