<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
use org\camunda\php\sdk\entity\request\VariableInstanceRequest;
use org\camunda\php\sdk\service\VariableInstanceService;

include('../../vendor/autoload.php');

class VariableInstanceTest extends \PHPUnit_Framework_TestCase
{
    protected static $restApi;
    protected static $vis;

    public static function setUpBeforeClass()
    {
        self::$restApi = 'http://localhost:8080/engine-rest';
        self::$vis = new VariableInstanceService(self::$restApi);
        print("\n\nCLASS: " . __CLASS__ . "\n");
    }

    public static function tearDownAfterClass()
    {
        self::$restApi = null;
    }

    //--------------------------------  TEST GET VARIABLE-INSTANCES  ----------------------------------------
    public function testGetVariableInstancesWithGet()
    {
        $vi = self::$vis->getInstances(new VariableInstanceRequest());

        foreach ($vi as $data) {
            if ($data->getName() == 'testVariable') {
                $this->assertEquals("testValue", $data->getValue());
            }
        }

        $vi = self::$vis->getInstances(new VariableInstanceRequest(), true);
        foreach ($vi as $data) {
            if ($data->getName() == 'testVariable') {
                $this->assertEquals("testValue", $data->getValue());
            }
        }

        $vir = new VariableInstanceRequest();
        $vir->setVariableName('amount');
        $vi = self::$vis->getInstances($vir, true);

        $this->assertGreaterThan(0, count(get_object_vars($vi)));
    }

    //--------------------------------  TEST GET VARIABLE-INSTANCES COUNT ----------------------------------------
    public function testGetVariableInstancesCountWithGet()
    {
        $vis = new VariableInstanceService(self::$restApi);

        $vic = self::$vis->getCount(new VariableInstanceRequest());
        $this->assertGreaterThan(0, $vic);

        $vic = self::$vis->getCount(new VariableInstanceRequest(), true);
        $this->assertGreaterThan(0, $vic);

        $vir = new VariableInstanceRequest();
        $vir->setVariableName('amount');
        $vic = self::$vis->getCount($vir, true);
        $this->assertGreaterThan(0, $vic);

        $vir = new VariableInstanceRequest();
        $vir->setVariableName('haha');
        $vic = self::$vis->getCount($vir, true);
        $this->assertEquals(0, $vic);
    }
}
