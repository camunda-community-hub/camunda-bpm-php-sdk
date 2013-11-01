<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.07.13
 * Time: 08:57
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestProcessEngine;

use org\camunda\php\sdk\camundaRestClient;

include('../../vendor/autoload.php');

class ProcessEngineTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET ENGINE NAMES  ----------------------------------------
  /**
   * @test
   */
  public function getEngineNames() {
    $restClient = new camundaRestClient(self::$restApi);
    $this->assertEquals('default', $restClient->getEngineNames()[0]->name);
  }
}
