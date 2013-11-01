<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 14:59
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestProcessInstanceService;
use org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\VariableRequest;
use org\camunda\php\sdk\service\ProcessInstanceService;

include('../../vendor/autoload.php');

class ProcessInstanceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET SINGLE PROCESS INSTANCE  ----------------------------------------
  /**
   * @test
   */
  public function getProcessInstance() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;
    $spi = $pis->getInstance($pi->getId());
    $this->assertEquals($pi->getDefinitionId(), $spi->getDefinitionId());

    
  }

  //--------------------------------  TEST GET PROCESS INSTANCES  ----------------------------------------
  /**
   * @test
   */
  public function getProcessInstances() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;

    $this->assertFalse($pi->getSuspended());
    $pi = $pis->getInstances(new ProcessInstanceRequest(), true)->instance_0;

    $this->assertFalse($pi->getSuspended());


    
  }

  //--------------------------------  TEST GET PROCESS INSTANCE COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getProcessInstanceCount() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getCount(new ProcessInstanceRequest());

    $this->assertGreaterThan(0, $pi);


    
  }

  //--------------------------------  TEST GET SINGLE PROCESS VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function getSingleProcessVariable() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;

    $piv = new VariableRequest();
    $piv->setValue('testValue')->setType('String');
    $pis->putProcessVariable($pi->getId(),'testVariable', $piv);

    $this->assertNotEmpty($pis->getProcessVariables($pi->getId()));
    $this->assertEquals('testValue', $pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());

    $pis->deleteProcessVariable($pi->getId(), 'testVariable');
    
  }

  //--------------------------------  TEST PUT SINGLE PROCESS VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function putSingleProcessVariable() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;

    $piv = new VariableRequest();
    $piv->setValue('testValue')->setType('String');
    $pis->putProcessVariable($pi->getId(),'testVariable', $piv);

    $this->assertNotEmpty($pis->getProcessVariables($pi->getId()));
    $this->assertEquals('testValue', $pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());

    $pis->deleteProcessVariable($pi->getId(), 'testVariable');
    
  }

  //--------------------------------  TEST DELETE SINGLE PROCESS INSTANCE  ----------------------------------------
  /**
   * @test
   */
  public function deleteSingleTestInstance() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;

    $pvc = count(get_object_vars($pis->getProcessVariables($pi->getId())));

    $piv = new VariableRequest();
    $piv->setValue('testValue')->setType('String');
    $pis->putProcessVariable($pi->getId(),'testVariable', $piv);

    $this->assertEquals($pvc + 1, count(get_object_vars($pis->getProcessVariables($pi->getId()))));
    $this->assertEquals('testValue', $pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());

    $pis->deleteProcessVariable($pi->getId(), 'testVariable');
    $this->assertEquals($pvc, count(get_object_vars($pis->getProcessVariables($pi->getId()))));
    
  }

  //--------------------------------  TEST GET PROCESS VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function getProcessVariables() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;
    $pvc = count(get_object_vars($pis->getProcessVariables($pi->getId())));

    $piv = new VariableRequest();
    $piv->setValue('testValue')->setType('String');
    $pis->putProcessVariable($pi->getId(),'testVariable', $piv);

    $this->assertEquals($pvc + 1, count(get_object_vars($pis->getProcessVariables($pi->getId()))));

    $pis->deleteProcessVariable($pi->getId(), 'testVariable');
    $this->assertEquals($pvc, count(get_object_vars($pis->getProcessVariables($pi->getId()))));

    
  }

  //--------------------------------  TEST UPDATE AND DELETE PROCESS VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function updateAndDeleteProcessVariables() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;

    $piv = new VariableRequest();
    $piv->setValue('testValue')->setType('String');
    $pis->putProcessVariable($pi->getId(),'testVariable', $piv);

    $piv = new VariableRequest();
    $piv->setValue('testValue2')->setType('String');
    $pis->putProcessVariable($pi->getId(), 'testVariable2', $piv);

    $piv = new VariableRequest();
    $pm = array();
    $pm['testVariable'] = new VariableRequest();
    $pm['testVariable2'] = new VariableRequest();
    $pm['testVariable']->setValue('newTestValue');
    $pm['testVariable2']->setValue('newTestValue2');
    $piv->setModifications($pm);

    $pis->updateOrDeleteProcessVariables($pi->getId(), $piv);
    $this->assertEquals('newTestValue', $pis->getProcessVariable($pi->getId(), 'testVariable')->getValue());
    $this->assertEquals('newTestValue2', $pis->getProcessVariable($pi->getId(), 'testVariable2')->getValue());

    $pvc = count(get_object_vars($pis->getProcessVariables($pi->getId())));

    $piv = new VariableRequest();
    $pm = array('testVariable', 'testVariable2');
    $piv->setDeletions($pm);
    $pis->updateOrDeleteProcessVariables($pi->getId(), $piv);

    $this->assertEquals($pvc - 2, count(get_object_vars($pis->getProcessVariables($pi->getId()))));

    
  }

  //--------------------------------  TEST GET ACTIVITY INSTANCES  ----------------------------------------
  /**
   * @test
   */
  public function getActivityInstances() {
    $pis = new ProcessInstanceService(self::$restApi);
    $pi = $pis->getInstances(new ProcessInstanceRequest())->instance_0;

    $this->assertNotEmpty(get_object_vars($pis->getActivityInstances($pi->getId(), new ProcessInstanceRequest())));
    
  }
}
