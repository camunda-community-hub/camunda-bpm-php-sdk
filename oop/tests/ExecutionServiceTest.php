<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.07.13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestExecutionService;
use org\camunda\php\sdk\entity\request\ExecutionRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\service\ExecutionService;

include("../../vendor/autoload.php");

class ExecutionServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;
  protected $i = 0;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET SINGLE EXECUTION  ----------------------------------------
  /**
   * @test
   */
  public function getSingleExecution() {
    $pes = new ExecutionService(self::$restApi);
    $ei = $pes->getExecutions(new ExecutionRequest())->execution_1;

    $this->assertEquals(
      $ei->getProcessInstanceId(),
      $pes->getExecution($ei->getId())->getProcessInstanceId()
    );
    
  }

  //--------------------------------  TEST GET EXECUTIONS  ----------------------------------------
  /**
   * @test
   */
  public function getExecutions() {
    $pes = new ExecutionService(self::$restApi);
    $this->assertNotEmpty(get_object_vars($pes->getExecutions(new ExecutionRequest())));

    $er = new ExecutionRequest();
    $er->setActive(true);
    $this->assertNotEmpty(get_object_vars($pes->getExecutions($er)));

    $pes = new ExecutionService(self::$restApi);
    $this->assertNotEmpty(get_object_vars($pes->getExecutions(new ExecutionRequest(), true)));

    $er = new ExecutionRequest();
    $er->setActive(true);
    $this->assertNotEmpty(get_object_vars($pes->getExecutions($er, true)));
    
  }

  //--------------------------------  TEST GET EXECUTION COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getExecutionCount() {
    $pes = new ExecutionService(self::$restApi);
    $eic = $pes->getCount(new ExecutionRequest());
    $eic2 = count(get_object_vars($pes->getExecutions(new ExecutionRequest())));
    $this->assertEquals($eic, $eic2);

    $eic = $pes->getCount(new ExecutionRequest(), true);
    $eic2 = count(get_object_vars($pes->getExecutions(new ExecutionRequest(), true)));
    $this->assertEquals($eic, $eic2);

    $er = new ExecutionRequest();
    $er->setActive(true);
    $eic = $pes->getCount($er);
    $eic2 = count(get_object_vars($pes->getExecutions($er)));

    $this->assertEquals($eic, $eic2);

    
  }

  //--------------------------------  TEST GET LOCAL EXECUTION VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function getLocalExecutionVariable() {
    $pes = new ExecutionService(self::$restApi);
    $ei = $pes->getExecutions(new ExecutionRequest())->execution_1;
    $ev = new VariableRequest();
    $ev->setValue("test")->setType('String');
    $pes->putExecutionVariable($ei->getId(), 'testVariable', $ev);
    $this->assertEquals('test', $pes->getExecutionVariable($ei->getId(), 'testVariable')->getValue());

    $pes->deleteExecutionVariable($ei->getId(), 'testVariable');
    
  }

  //--------------------------------  TEST PUT LOCAL EXECUTION VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function putLocalExecutionVariable() {
    $pes = new ExecutionService(self::$restApi);
    $ei = $pes->getExecutions(new ExecutionRequest())->execution_1;

    $ev = new VariableRequest();
    $ev->setValue("test")->setType('String');
    $pes->putExecutionVariable($ei->getId(), 'testVariable', $ev);
    $this->assertEquals('test', $pes->getExecutionVariable($ei->getId(), 'testVariable')->getValue());

    $pes->deleteExecutionVariable($ei->getId(), 'testVariable');
    
  }

  //--------------------------------  TEST PUT LOCAL EXECUTION VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function deleteLocalExecutionVariable() {
    $pes = new ExecutionService(self::$restApi);
    $ei = $pes->getExecutions(new ExecutionRequest())->execution_1;

    $ev = new VariableRequest();
    $ev->setValue("test")->setType('String');
    $pes->putExecutionVariable($ei->getId(), 'testVariable', $ev);
    $this->assertEquals('test', $pes->getExecutionVariable($ei->getId(), 'testVariable')->getValue());

    $pes->deleteExecutionVariable($ei->getId(), 'testVariable');
    $this->assertNull($pes->getExecutionVariable($ei->getId(), 'testVariable')->getValue());
    
  }

  //--------------------------------  TEST GET LOCAL EXECUTION VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function getLocalExecutionVariables() {
    $pes = new ExecutionService(self::$restApi);
    $ei = $pes->getExecutions(new ExecutionRequest())->execution_1;

    $ev = new VariableRequest();
    $ev->setValue("test")->setType('String');
    $pes->putExecutionVariable($ei->getId(), 'testVariable', $ev);

    $this->assertGreaterThan(0, count(get_object_vars($pes->getExecutionVariables($ei->getId()))));
    $this->assertEquals(
      'test',
      $pes->getExecutionVariables($ei->getId())->variable_testVariable->getValue()
    );
    $pes->deleteExecutionVariable($ei->getId(), 'testVariable');
    
  }

  //--------------------------------  TEST UPDATE AND DELETE PROCESS VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function updateAndDeleteProcessVariables() {
    $pes = new ExecutionService(self::$restApi);
    $ei = $pes->getExecutions(new ExecutionRequest())->execution_1;

    $ev = new VariableRequest();
    $ev->setValue('testValue')->setType('String');
    $pes->putExecutionVariable($ei->getId(),'testVariable', $ev);

    $ev = new VariableRequest();
    $ev->setValue('testValue2')->setType('String');
    $pes->putExecutionVariable($ei->getId(), 'testVariable2', $ev);

    $ev = new VariableRequest();
    $pm = array();
    $pm['testVariable'] = new VariableRequest();
    $pm['testVariable2'] = new VariableRequest();
    $pm['testVariable']->setValue('newTestValue');
    $pm['testVariable2']->setValue('newTestValue2');
    $ev->setModifications($pm);

    $pes->updateOrDeleteExecutionVariables($ei->getId(), $ev);
    $this->assertEquals('newTestValue', $pes->getExecutionVariable($ei->getId(), 'testVariable')->getValue());
    $this->assertEquals('newTestValue2', $pes->getExecutionVariable($ei->getId(), 'testVariable2')->getValue());

    $pvc = count(get_object_vars($pes->getExecutionVariables($ei->getId())));

    $ev = new VariableRequest();
    $pm = array('testVariable', 'testVariable2');
    $ev->setDeletions($pm);
    $pes->updateOrDeleteExecutionVariables($ei->getId(), $ev);

    $this->assertEquals($pvc - 2, count(get_object_vars($pes->getExecutionVariables($ei->getId()))));

    
  }

  //--------------------------------  TEST TRIGGER EXECUTION  ----------------------------------------
  /**
   * TODO: find a way which fulfill the need of this test!
   * @test
   */
  public function triggerExecution() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  //--------------------------------  TEST GET MESSAGE EVENT SUBSCRIPTIONS  ----------------------------------------
  /**
   * TODO: find a way which fulfill the need of this test!
   * @test
   */
  public function getMessageEventSubscriptions() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  //--------------------------------  TEST TRIGGER MESSAGE EVENT SUBSCRIPTIONS  ----------------------------------------
  /**
   * TODO: find a way which fulfill the need of this test!
   * @test
   */
  public function triggerMessageEventSubscription() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }
}
