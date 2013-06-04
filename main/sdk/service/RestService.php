<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.05.13
 * Time: 18:34
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use org\camunda\php\sdk\entity\Request;


class RestService {
  private $engineUrl;
  private $cookieFilePath = './';

  /**
   * @param String $engineUrl - URL of the rest api
   */
  public function __construct($engineUrl) {
    $this->engineUrl = $engineUrl;
  }

  /**
   * @param String $engineUrl url to rest api
   */
  public function setEngineUrl($engineUrl) {
    $this->engineUrl = $engineUrl;
  }

  /**
   * @return mixed url to rest api
   */
  public function getEngineUrl() {
    return $this->engineUrl;
  }
  /**
   * authenticate to use REST-API. This feature is actually not implemented
   * in the REST Api so that we don't need to do anything here until the
   * final release of camunda BPM 7.0.0
   *
   * @param $authenticationData array with username, password (, APIkey)
   */
  public function authenticate($authenticationData) {
    // not used
  }

  /**
   * requests the data from the rest api as GET-REQUEST via curl or with stream api fallback
   *
   * @param String $query asked query of the rest api
   * @param mixed $object
   * @return mixed returns the server-response
   */
  public function restGetRequest(Request $request) {
    $parameterString = '';
    $parameters = $request->getParameterList();
    if(!empty($parameters)) {
      $parameterString .= '?';
      foreach($parameters AS $parameterName => $parameterValue) {
        $parameterString .= '&'.$parameterName.'='.$parameterValue;
      }
    }



    if($this->checkCurl()) {
      $ch = curl_init($this->engineUrl.$request->getUrl().$parameterString);
      curl_setopt ($ch, CURLOPT_COOKIEJAR, $this->cookieFilePath);
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->cookieFilePath);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

      $request = curl_exec($ch);
      curl_close($ch);
    } else {
      $request = file_get_contents($this->engineUrl.$request->getUrl().$parameterString);
    }
    return json_decode($request);
  }

  /**
   * requests the data from the rest api as POST-REQUEST via curl or with stream api fallback
   *
   * @param String $query asked query of the rest api
   * @param mixed $object
   * @return mixed returns the server-response
   */
  public function restPostRequest(Request $request) {
    $parameters = $request->getParameterList();
    $requestToJson = '';
    if(!empty($parameters)) {
      $requestToJson .= json_encode($request->getParameterList());
    } else {
      $requestToJson .= '{}';
    }


    if($this->checkCurl()) {
      $ch = curl_init($this->engineUrl.$request->getUrl());
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS, $requestToJson);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: '.strlen($requestToJson)
      ));

      $response = curl_exec($ch);
      curl_close($ch);

    } else {
      $streamContext = stream_context_create(array(
          'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json'."\r\n"
                .'Content-Length:'.strlen($requestToJson)."\r\n",
            'content' => $requestToJson
          )
        )
      );

      $response = file_get_contents($this->engineUrl.$request->getUrl(), null, $streamContext);
    }

    return json_decode($response);

  }

  private function checkCurl() {
    return function_exists('curl_version');
  }
}