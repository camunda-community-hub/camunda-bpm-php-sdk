<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.06.13
 * Time: 16:43
 * To change this template use File | Settings | File Templates.
 */

use org\camunda\php\sdk\entity\request\Request;
use org\camunda\php\sdk\entity\request\Credentials;

include('main/entity/entity.request/CastHelperper.php');

class RequestTest extends PHPUnit_Framework_TestCase {

  public function testRequestWithParameter() {
    $credentials = new Credentials();
    $credentials->setUsername('Stefan');

    $parameterArray = array(
      'requestUrl' => 'http://localhost:8080/engine-rest/credentials',
      'requestMethod' => 'POST',
      'requestObject' => $credentials
    );

    $request = new Request($parameterArray);
    $this->assertEquals('http://localhost:8080/engine-rest/credentials', $request->getRequestUrl());
    $this->assertEquals('POST', $request->getRequestMethod());
    $this->assertEquals('Stefan', $request->getRequestObject()->getUsername());
    $this->assertEquals('org\camunda\php\sdk\entity\request\Credentials', get_class($request->getRequestObject()));

    unset($credentials);
    unset($parameterArray);
    unset($request);
  }

  public function testRequest() {
    $credentials = new Credentials();
    $credentials->setUsername('Stefan');

    $request = new Request();
    $request->setRequestObject($credentials);
    $request->setRequestUrl('http://localhost:8080/engine-rest/credentials');
    $request->setRequestMethod('POST');

    $this->assertEquals('http://localhost:8080/engine-rest/credentials', $request->getRequestUrl());
    $this->assertEquals('POST', $request->getRequestMethod());
    $this->assertEquals('Stefan', $request->getRequestObject()->getUsername());
    $this->assertEquals('org\camunda\php\sdk\entity\request\Credentials', get_class($request->getRequestObject()));

    unset($credentials);
    unset($request);
  }
}
