<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.07.13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
use org\camunda\php\sdk\entity\request\ExecutionRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\service\ExecutionService;

include("../../vendor/autoload.php");

class ExecutionServiceTest extends \PHPUnit_Framework_TestCase
{
    protected static $restApi;
    protected static $es;

    public static function setUpBeforeClass()
    {
        self::$restApi = 'http://localhost:8080/engine-rest';
        print("\n\nCLASS: " . __CLASS__ . "\n");
        self::$es = new ExecutionService(self::$restApi);
    }

    public static function tearDownAfterClass()
    {
        self::$restApi = null;
    }

    //--------------------------------  TEST GET SINGLE EXECUTION  ----------------------------------------

    /**
     * @test
     */
    public function getSingleExecution()
    {
        $ei = self::$es->getExecutions(new ExecutionRequest())->execution_1;

        $this->assertEquals(
            $ei->getProcessInstanceId(),
            self::$es->getExecution($ei->getId())->getProcessInstanceId()
        );

    }

    //--------------------------------  TEST GET EXECUTIONS  ----------------------------------------

    /**
     * @test
     */
    public function getExecutions()
    {
        $this->assertNotEmpty(get_object_vars(self::$es->getExecutions(new ExecutionRequest())));

        $er = new ExecutionRequest();
        $er->setActive(true);
        $this->assertNotEmpty(get_object_vars(self::$es->getExecutions($er)));

        $this->assertNotEmpty(get_object_vars(self::$es->getExecutions(new ExecutionRequest(), true)));

        $er = new ExecutionRequest();
        $er->setActive(true);
        $this->assertNotEmpty(get_object_vars(self::$es->getExecutions($er, true)));

    }

    //--------------------------------  TEST GET EXECUTION COUNT  ----------------------------------------

    /**
     * @test
     */
    public function getExecutionCount()
    {
        $eic = self::$es->getCount(new ExecutionRequest());
        $eic2 = count(get_object_vars(self::$es->getExecutions(new ExecutionRequest())));
        $this->assertEquals($eic, $eic2);

        $eic = self::$es->getCount(new ExecutionRequest(), true);
        $eic2 = count(get_object_vars(self::$es->getExecutions(new ExecutionRequest(), true)));
        $this->assertEquals($eic, $eic2);

        $er = new ExecutionRequest();
        $er->setActive(true);
        $eic = self::$es->getCount($er);
        $eic2 = count(get_object_vars(self::$es->getExecutions($er)));

        $this->assertEquals($eic, $eic2);


    }

    //--------------------------------  TEST GET LOCAL EXECUTION VARIABLE  ----------------------------------------

    /**
     * @test
     */
    public function getLocalExecutionVariable()
    {
        $ei = self::$es->getExecutions(new ExecutionRequest())->execution_1;
        $ev = new VariableRequest();
        $ev->setValue("testValue")->setType('String');
        self::$es->putExecutionVariable($ei->getId(), 'testVariable', $ev);
        $this->assertEquals('testValue', self::$es->getExecutionVariable($ei->getId(), 'testVariable')->getValue());

        self::$es->deleteExecutionVariable($ei->getId(), 'testVariable');

    }

    //--------------------------------  TEST PUT LOCAL EXECUTION VARIABLE  ----------------------------------------

    /**
     * @test
     */
    public function putLocalExecutionVariable()
    {
        $ei = self::$es->getExecutions(new ExecutionRequest())->execution_1;

        $ev = new VariableRequest();
        $ev->setValue("testValue")->setType('String');
        self::$es->putExecutionVariable($ei->getId(), 'testVariable', $ev);
        $this->assertEquals('testValue', self::$es->getExecutionVariable($ei->getId(), 'testVariable')->getValue());

        self::$es->deleteExecutionVariable($ei->getId(), 'testVariable');

    }

    //--------------------------------  TEST PUT LOCAL EXECUTION VARIABLE  ----------------------------------------

    /**
     * @test
     */
    public function deleteLocalExecutionVariable()
    {
        $ei = self::$es->getExecutions(new ExecutionRequest())->execution_1;

        $ev = new VariableRequest();
        $ev->setValue("testValue")->setType('String');
        self::$es->putExecutionVariable($ei->getId(), 'testVariable', $ev);
        $this->assertEquals('testValue', self::$es->getExecutionVariable($ei->getId(), 'testVariable')->getValue());

        self::$es->deleteExecutionVariable($ei->getId(), 'testVariable');
        try {
            self::$es->getExecutionVariable($ei->getId(), 'testVariable')->getValue();
        } catch (CamundaApiException $ex) {
            $this->assertStringStartsWith('Error! HTTP Status Code: 404', $ex->getMessage());
        }

    }

    //--------------------------------  TEST GET LOCAL EXECUTION VARIABLES  ----------------------------------------

    /**
     * @test
     */
    public function getLocalExecutionVariables()
    {
        $ei = self::$es->getExecutions(new ExecutionRequest())->execution_1;

        $ev = new VariableRequest();
        $ev->setValue("testValue")->setType('String');
        self::$es->putExecutionVariable($ei->getId(), 'testVariable', $ev);

        $this->assertGreaterThan(0, count(get_object_vars(self::$es->getExecutionVariables($ei->getId()))));
        $this->assertEquals(
            'testValue',
            self::$es->getExecutionVariables($ei->getId())->variable_testVariable->getValue()
        );
        self::$es->deleteExecutionVariable($ei->getId(), 'testVariable');

    }

    //--------------------------------  TEST UPDATE AND DELETE PROCESS VARIABLES  ----------------------------------------

    /**
     * @test
     */
    public function updateAndDeleteExecutionVariables()
    {
        $ei = self::$es->getExecutions(new ExecutionRequest())->execution_1;

        $ev = new VariableRequest();
        $ev->setValue('testValue')->setType('String');
        self::$es->putExecutionVariable($ei->getId(), 'testVariable', $ev);

        $ev = new VariableRequest();
        $ev->setValue('testValue2')->setType('String');
        self::$es->putExecutionVariable($ei->getId(), 'testVariable2', $ev);

        $ev = new VariableRequest();
        $pm = [];
        $pm['testVariable'] = new VariableRequest();
        $pm['testVariable2'] = new VariableRequest();
        $pm['testVariable']->setValue('newTestValue');
        $pm['testVariable2']->setValue('newTestValue2');
        $ev->setModifications($pm);

        self::$es->updateOrDeleteExecutionVariables($ei->getId(), $ev);
        $this->assertEquals('newTestValue', self::$es->getExecutionVariable($ei->getId(), 'testVariable')->getValue());
        $this->assertEquals('newTestValue2',
            self::$es->getExecutionVariable($ei->getId(), 'testVariable2')->getValue());

        $pvc = count(get_object_vars(self::$es->getExecutionVariables($ei->getId())));

        $ev = new VariableRequest();
        $pm = ['testVariable', 'testVariable2'];
        $ev->setDeletions($pm);
        self::$es->updateOrDeleteExecutionVariables($ei->getId(), $ev);

        $this->assertEquals($pvc - 2, count(get_object_vars(self::$es->getExecutionVariables($ei->getId()))));


    }

    //--------------------------------  TEST TRIGGER EXECUTION  ----------------------------------------

    /**
     * TODO: find a way which fulfill the need of this test!
     *
     * @test
     */
    public function triggerExecution()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    //--------------------------------  TEST GET MESSAGE EVENT SUBSCRIPTIONS  ----------------------------------------

    /**
     * TODO: find a way which fulfill the need of this test!
     *
     * @test
     */
    public function getMessageEventSubscriptions()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    //--------------------------------  TEST TRIGGER MESSAGE EVENT SUBSCRIPTIONS  ----------------------------------------

    /**
     * TODO: find a way which fulfill the need of this test!
     *
     * @test
     */
    public function triggerMessageEventSubscription()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
