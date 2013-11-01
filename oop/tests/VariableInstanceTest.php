<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestVariableInstanceService;
use org\camunda\php\sdk\entity\request\VariableInstanceRequest;
use org\camunda\php\sdk\service\VariableInstanceService;

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
    $vis = new VariableInstanceService(self::$restApi);
    $vi = $vis->getInstances(new VariableInstanceRequest());
    $vic = $vis->getCount(new VariableInstanceRequest());
    $i = 0;

    foreach($vi AS $data) {
      var_dump($data);
      if($data->getName() == 'testVariable') {
        $this->assertEquals("testValue", $data->getValue());
      }
    }

    $vis = new VariableInstanceService(self::$restApi);
    $vi = $vis->getInstances(new VariableInstanceRequest(), true);
    $i = 0;
    foreach($vi AS $data) {
      if($data->getName() == 'testVariable') {
        $this->assertEquals("testValue", $data->getValue());
      }
    }

    $vis = new VariableInstanceService(self::$restApi);
    $vir = new VariableInstanceRequest();
    $vir->setVariableName('amount');
    $vi = $vis->getInstances($vir, true);

    $this->assertGreaterThan(0, count(get_object_vars($vi)));
  }

  //--------------------------------  TEST GET VARIABLE-INSTANCES COUNT ----------------------------------------
  public function testGetVariableInstancesCountWithGet() {
    $vis = new VariableInstanceService(self::$restApi);

    $vic = $vis->getCount(new VariableInstanceRequest());
    $this->assertGreaterThan(0, $vic);

    $vic = $vis->getCount(new VariableInstanceRequest(), true);
    $this->assertGreaterThan(0, $vic);

    $vir = new VariableInstanceRequest();
    $vir->setVariableName('amount');
    $vic = $vis->getCount($vir, true);
    $this->assertGreaterThan(0, $vic);

    $vir = new VariableInstanceRequest();
    $vir->setVariableName('haha');
    $vic = $vis->getCount($vir, true);
    $this->assertEquals(0, $vic);
  }
}
