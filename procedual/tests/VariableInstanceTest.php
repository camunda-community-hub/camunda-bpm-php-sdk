<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestVariableInstance;

use org\camunda\php\sdk\camundaRestClient;

include('../../vendor/autoload.php');

class VariableInstanceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET VARIABLE-INSTANCES  ----------------------------------------
  public function testGetVariableInstancesWithGet() {
    $restService = new camundaRestClient(self::$restApi);
    $vi = $restService->getVariableInstances();
    $i = 0;
    foreach($vi AS $data) {
      if($data->name == 'serializableVar') {
        $i++;
      }
    }
    $this->assertGreaterThan(0, $i);

    $restService = new camundaRestClient(self::$restApi);
    $vi = $restService->getVariableInstances(null, true);
    $i = 0;
    foreach($vi AS $data) {
      if($data->name == 'serializableVar') {
        $i++;
      }
    }
    $this->assertGreaterThan(0, $i);

    $restService = new camundaRestClient(self::$restApi);
    $vir = array('variableName' => 'amount');
    $vi = $restService->getVariableInstances($vir, true);

    $this->assertGreaterThan(0, count($vi));
  }

  //--------------------------------  TEST GET VARIABLE-INSTANCES COUNT ----------------------------------------
  public function testGetVariableInstancesCountWithGet() {
    $restService = new camundaRestClient(self::$restApi);

    $vic = $restService->getVariableInstancesCount()->count;
    $this->assertGreaterThan(0, $vic);

    $vic = $restService->getVariableInstancesCount(null, true)->count;
    $this->assertGreaterThan(0, $vic);

    $vir = array('variableName' => 'amount');
    $vic = $restService->getVariableInstancesCount($vir, true)->count;
    $this->assertGreaterThan(0, $vic);

    $vir = array('variableName' => 'haha');
    $vic = $restService->getVariableInstancesCount($vir, true)->count;
    $this->assertEquals(0, $vic);
  }
}
