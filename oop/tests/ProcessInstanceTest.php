<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 14:59
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
use org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\service\ProcessInstanceService;

include('../../vendor/autoload.php');

class ProcessInstanceTest extends \PHPUnit_Framework_TestCase
{
    protected static $restApi;
    protected static $pis;

    public static function setUpBeforeClass()
    {
        self::$restApi = 'http://localhost:8080/engine-rest';
        print("\n\nCLASS: " . __CLASS__ . "\n");
        self::$pis = new ProcessInstanceService(self::$restApi);
    }

    public static function tearDownAfterClass()
    {
        self::$restApi = null;
    }

    //--------------------------------  TEST GET SINGLE PROCESS INSTANCE  ----------------------------------------

    /**
     * @test
     */
    public function getProcessInstance()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;
        $spi = self::$pis->getInstance($pi->getId());
        $this->assertEquals($pi->getDefinitionId(), $spi->getDefinitionId());
    }

    //--------------------------------  TEST GET PROCESS INSTANCES  ----------------------------------------

    /**
     * @test
     */
    public function getProcessInstances()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;

        $this->assertFalse($pi->getSuspended());
        $pi = self::$pis->getInstances(new ProcessInstanceRequest(), true)->instance_0;

        $this->assertFalse($pi->getSuspended());
    }

    //--------------------------------  TEST GET PROCESS INSTANCE COUNT  ----------------------------------------

    /**
     * @test
     */
    public function getProcessInstanceCount()
    {
        $pi = self::$pis->getCount(new ProcessInstanceRequest());

        $this->assertGreaterThan(0, $pi);
    }

    //--------------------------------  TEST GET SINGLE PROCESS VARIABLE  ----------------------------------------

    /**
     * @test
     */
    public function getSingleProcessVariable()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;

        $piv = new VariableRequest();
        $piv->setValue('testValue')->setType('String');
        self::$pis->putProcessVariable($pi->getId(), 'testVariable', $piv);

        $this->assertNotEmpty(self::$pis->getProcessVariables($pi->getId()));
        $this->assertEquals('testValue', self::$pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());

        self::$pis->deleteProcessVariable($pi->getId(), 'testVariable');
    }

    //--------------------------------  TEST PUT SINGLE PROCESS VARIABLE  ----------------------------------------

    /**
     * @test
     */
    public function putSingleProcessVariable()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;

        $piv = new VariableRequest();
        $piv->setValue('testValue')->setType('String');
        self::$pis->putProcessVariable($pi->getId(), 'testVariable', $piv);

        $this->assertNotEmpty(self::$pis->getProcessVariables($pi->getId()));
        $this->assertEquals('testValue', self::$pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());

        self::$pis->deleteProcessVariable($pi->getId(), 'testVariable');
    }

    //--------------------------------  TEST DELETE SINGLE PROCESS INSTANCE  ----------------------------------------

    /**
     * @test
     */
    public function deleteSingleProcessInstance()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;

        $pvc = count(get_object_vars(self::$pis->getProcessVariables($pi->getId())));

        $piv = new VariableRequest();
        $piv->setValue('testValue')->setType('String');
        self::$pis->putProcessVariable($pi->getId(), 'testVariable', $piv);

        $this->assertEquals($pvc + 1, count(get_object_vars(self::$pis->getProcessVariables($pi->getId()))));
        $this->assertEquals('testValue', self::$pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());

        self::$pis->deleteProcessVariable($pi->getId(), 'testVariable');
        $this->assertEquals($pvc, count(get_object_vars(self::$pis->getProcessVariables($pi->getId()))));
    }

    //--------------------------------  TEST GET PROCESS VARIABLES  ----------------------------------------

    /**
     * @test
     */
    public function getProcessVariables()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;
        $pvc = count(get_object_vars(self::$pis->getProcessVariables($pi->getId())));

        $piv = new VariableRequest();
        $piv->setValue('testValue')->setType('String');
        self::$pis->putProcessVariable($pi->getId(), 'testVariable', $piv);

        $this->assertEquals($pvc + 1, count(get_object_vars(self::$pis->getProcessVariables($pi->getId()))));

        self::$pis->deleteProcessVariable($pi->getId(), 'testVariable');
        $this->assertEquals($pvc, count(get_object_vars(self::$pis->getProcessVariables($pi->getId()))));
    }

    //--------------------------------  TEST UPDATE AND DELETE PROCESS VARIABLES  ----------------------------------------

    /**
     * @test
     */
    public function updateAndDeleteProcessVariables()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;

        $piv = new VariableRequest();
        $piv->setValue('testValue')->setType('String');
        self::$pis->putProcessVariable($pi->getId(), 'testVariable', $piv);

        $piv = new VariableRequest();
        $piv->setValue('testValue2')->setType('String');
        self::$pis->putProcessVariable($pi->getId(), 'testVariable2', $piv);

        $piv = new VariableRequest();
        $pm = [];
        $pm['testVariable'] = new VariableRequest();
        $pm['testVariable2'] = new VariableRequest();
        $pm['testVariable']->setValue('newTestValue');
        $pm['testVariable2']->setValue('newTestValue2');
        $piv->setModifications($pm);

        self::$pis->updateOrDeleteProcessVariables($pi->getId(), $piv);
        $this->assertEquals('newTestValue', self::$pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());
        $this->assertEquals('newTestValue2', self::$pis->getProcessVariable($pi->getId(), 'testVariable2')->getValue());

        $pvc = count(get_object_vars(self::$pis->getProcessVariables($pi->getId())));

        $piv = new VariableRequest();
        $pm = ['testVariable', 'testVariable2'];
        $piv->setDeletions($pm);
        self::$pis->updateOrDeleteProcessVariables($pi->getId(), $piv);

        $this->assertEquals($pvc - 2, count(get_object_vars(self::$pis->getProcessVariables($pi->getId()))));
    }

    //--------------------------------  TEST GET ACTIVITY INSTANCES  ----------------------------------------

    /**
     * @test
     */
    public function getActivityInstances()
    {
        $pi = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;

        $this->assertNotEmpty(get_object_vars(self::$pis->getActivityInstances($pi->getId(),
            new ProcessInstanceRequest())));
    }

    /**
     * @test
     */
    public function activateOrSuspendInstance()
    {
        $processInstances = self::$pis->getInstances(new ProcessInstanceRequest());

        $suspendedFilter = new ProcessInstanceRequest();
        $suspendedFilter->setSuspended("true");
        $countSuspended = self::$pis->getCount($suspendedFilter);

        $suspenedActivator = new ProcessInstanceRequest();
        $suspenedActivator->setSuspended(true);
        self::$pis->activateOrSuspendInstance($processInstances->instance_0->getId(), $suspenedActivator);
        $this->assertEquals($countSuspended + 1, self::$pis->getCount($suspendedFilter));

        $suspenedActivator->setSuspended(false);
        self::$pis->activateOrSuspendInstance($processInstances->instance_0->getId(), $suspenedActivator);

        $this->assertEquals($countSuspended, self::$pis->getCount($suspendedFilter));
    }

    /**
     * @test
     */
    public function deleteSingleProcessVariable()
    {
        $processInstance = self::$pis->getInstances(new ProcessInstanceRequest())->instance_0;
        $variables = self::$pis->getProcessVariables($processInstance->getId());

        $this->assertEquals(3, count(get_object_vars($variables)));
        self::$pis->deleteProcessVariable($processInstance->getId(), 'value2');

        $this->assertEquals(2, count(get_object_vars(self::$pis->getProcessVariables($processInstance->getId()))));

        $addProcessVariableRequest = new VariableRequest();
        $addProcessVariableRequest->setValue(1000);
        $addProcessVariableRequest->setType("Integer");
        self::$pis->putProcessVariable($processInstance->getId(), 'value2', $addProcessVariableRequest);
    }
}
