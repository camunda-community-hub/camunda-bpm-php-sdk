<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestProcessDefinition;

use org\camunda\php\sdk\camundaRestClient;

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
    $restClient = new camundaRestClient(self::$restApi);

    $pdi = $restClient->getProcessDefinitions()[0]->id;
    $this->assertEquals(false, $restClient->getSingleProcessDefinition($pdi)->suspended);
    
  }

  //--------------------------------  TEST GET PROCESS DEFINITIONS   ----------------------------------------
  /**
   * TODO: Create a better version of this test if we get a rest-service which can deploy some files :)
   */
  public function testGetProcessDefinitions() {
    $restClient = new camundaRestClient(self::$restApi);

    $this->assertEquals(false, $restClient->getProcessDefinitions()[0]->suspended);

    
  }

  //--------------------------------  TEST GET PROCESS DEFINITION COUNT  ----------------------------------------
  public function testGetProcessDefinitionCount() {
    $restClient = new camundaRestClient(self::$restApi);

    $this->assertGreaterThan(0, $restClient->getProcessDefinitionCount()->count);

    
  }

  //--------------------------------  TEST GET BPMN XML  ----------------------------------------
  public function testGetBpmnXml() {
    $restClient = new camundaRestClient(self::$restApi);

    $pdi = $restClient->getProcessDefinitions()[0]->id;
    $processXml = $restClient->getBpmnXml($pdi);

    $this->assertEquals($pdi, $processXml->id);
    $this->assertGreaterThan(50, strlen($processXml->bpmn20Xml));

    
  }

  //--------------------------------  TEST START PROCESS INSTANCE  ----------------------------------------
  public function testStartProcessInstance() {
    $restClient = new camundaRestClient(self::$restApi);

    $countPreStart = $restClient->getProcessInstanceCount()->count;
    foreach($restClient->getProcessDefinitions() AS $data) {
      if($data->key == 'invoice') {
        $restClient->startProcessInstance($data->id);
      }
    }
    $this->assertGreaterThan($countPreStart, $restClient->getProcessInstanceCount()->count);

    
  }

  //--------------------------------  TEST GET PROCESS INSTANCE STATISTICS  ----------------------------------------
  public function testGetProcessInstanceStatistics() {
    $restClient = new camundaRestClient(self::$restApi);

    $is = $restClient->getProcessInstanceStatistics();
    $this->assertEquals(false, $is[0]->definition->suspended);

    
  }

  //--------------------------------  TEST GET ACTIVITY INSTANCE STATISTICS  ----------------------------------------
  public function testGetActivityInstanceStatistics() {
    $restClient = new camundaRestClient(self::$restApi);
    $pdi = $restClient->getProcessDefinitions()[0]->id;
    $asi = $restClient->getActivityInstanceStatistics($pdi)[0]->id;
    $this->assertEquals('UserTask_1', $asi);
    
  }

  //--------------------------------  TEST GET START FORM KEY  ----------------------------------------
  /**
   * TODO: Write a more accurate test!
   * embedded:app:forms/start-form.html - invoice start form in distro
   */
  public function testGetStartFormKey() {
    $restClient = new camundaRestClient(self::$restApi);
    foreach($restClient->getProcessDefinitions() AS $data) {
      if($data->key == 'invoice') {
        $this->assertEquals('embedded:app:forms/start-form.html', $restClient->getStartFormKey($data->id)->key);
      }
    }
  }
}
