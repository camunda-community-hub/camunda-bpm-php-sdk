<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestProcessDefinitionService;
use org\camunda\php\sdk\entity\request\ProcessDefinitionRequest;
use org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\StatisticRequest;
use org\camunda\php\sdk\service\ProcessDefinitionService;
use org\camunda\php\sdk\service\ProcessInstanceService;

include('../../vendor/autoload.php');

class ProcessDefinitionTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET SINGLE PROCESS DEFINITION  ----------------------------------------
  public function testGetSingleProcessDefinition() {
    $pds = new ProcessDefinitionService(self::$restApi);

    $pdi = $pds->getDefinitions(new ProcessDefinitionRequest())->definition_0->getId();
    $this->assertEquals(false, $pds->getDefinition($pdi)->getSuspended());
    
  }

  //--------------------------------  TEST GET PROCESS DEFINITIONS   ----------------------------------------
  /**
   * TODO: Create a better version of this test if we get a rest-service which can deploy some files :)
   */
  public function testGetProcessDefinitions() {
    $pds = new ProcessDefinitionService(self::$restApi);

    $this->assertEquals(false, $pds->getDefinitions(new ProcessDefinitionRequest())->definition_0->getSuspended());

    
  }

  //--------------------------------  TEST GET PROCESS DEFINITION COUNT  ----------------------------------------
  public function testGetProcessDefinitionCount() {
    $pds = new ProcessDefinitionService(self::$restApi);

    $this->assertGreaterThan(0, $pds->getCount(new ProcessDefinitionRequest()));

    
  }

  //--------------------------------  TEST GET BPMN XML  ----------------------------------------
  public function testGetBpmnXml() {
    $pds = new ProcessDefinitionService(self::$restApi);

    $pdi = $pds->getDefinitions(new ProcessDefinitionRequest())->definition_0->getId();
    $processXml = $pds->getBpmn20Xml($pdi);

    $this->assertEquals($pdi, $processXml->id);
    $this->assertGreaterThan(50, strlen($processXml->bpmn20Xml));

    
  }

  //--------------------------------  TEST START PROCESS INSTANCE  ----------------------------------------
  public function testStartProcessInstance() {
    $pds = new ProcessDefinitionService(self::$restApi);
    $pis = new ProcessInstanceService(self::$restApi);

    $countPreStart = $pis->getCount(new ProcessInstanceRequest());
    foreach($pds->getDefinitions(new ProcessDefinitionRequest()) AS $data) {
      if($data->getKey() == 'invoice') {
        $pds->startInstance($data->getId(), new ProcessDefinitionRequest());
      }
    }
    $this->assertGreaterThan($countPreStart, $pis->getCount(new ProcessInstanceRequest()));

    
  }

  //--------------------------------  TEST GET PROCESS INSTANCE STATISTICS  ----------------------------------------
  public function testGetProcessInstanceStatistics() {
    $pds = new ProcessDefinitionService(self::$restApi);

    $is = $pds->getProcessInstanceStatistic(new StatisticRequest());
    $this->assertEquals(false, $is->statistic_0->getDefinition()->suspended);

    
  }

  //--------------------------------  TEST GET ACTIVITY INSTANCE STATISTICS  ----------------------------------------
  public function testGetActivityInstanceStatistics() {
    $pds = new ProcessDefinitionService(self::$restApi);
    $pdi = $pds->getDefinitions(new ProcessDefinitionRequest())->definition_0->getId();
    $asi = $pds->getActivityInstanceStatistic($pdi, new StatisticRequest())->statistic_0->getId();
    $this->assertEquals('UserTask_1', $asi);
    
  }

  //--------------------------------  TEST GET START FORM KEY  ----------------------------------------
  /**
   * TODO: Write a more accurate test!
   * embedded:app:forms/start-form.html - invoice start form in distro
   */
  public function testGetStartFormKey() {
    $pds = new ProcessDefinitionService(self::$restApi);
    foreach($pds->getDefinitions(new ProcessDefinitionRequest()) AS $data) {
      if($data->getKey() == 'invoice') {
        $this->assertEquals('embedded:app:forms/start-form.html', $pds->getStartFormKey($data->getId())->getKey());
      }
    }
  }
}
