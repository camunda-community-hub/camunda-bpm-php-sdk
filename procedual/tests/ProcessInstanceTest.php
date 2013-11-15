<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 14:59
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestProcessInstance;

use org\camunda\php\sdk\camundaRestClient;

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
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];
    $spi = $restClient->getSingleProcessInstance($pi->id);
    $this->assertEquals($pi->definitionId, $spi->definitionId);

    
  }

  //--------------------------------  TEST GET PROCESS INSTANCES  ----------------------------------------
  /**
   * @test
   */
  public function getProcessInstances() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];

    $this->assertFalse($pi->suspended);
    $pi = $restClient->getProcessInstances(null, true)[0];

    $this->assertFalse($pi->suspended);


    
  }

  //--------------------------------  TEST GET PROCESS INSTANCE COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getProcessInstanceCount() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstanceCount()->count;

    $this->assertGreaterThan(0, $pi);


    
  }

  //--------------------------------  TEST GET SINGLE PROCESS VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function getSingleProcessVariable() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];

    $piv = array(
      'value' => 'testValue',
      'type' => 'String'
    );
    $restClient->putSingleProcessVariable($pi->id,'testVariable', $piv);

    $this->assertNotEmpty($restClient->getProcessVariables($pi->id));
    $this->assertEquals('testValue', $restClient->getSingleProcessVariable($pi->id, 'testVariable')->value);

    $restClient->deleteSingleProcessVariable($pi->id, 'testVariable');

  }

  //--------------------------------  TEST PUT SINGLE PROCESS VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function putSingleProcessVariable() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];

    $piv = array(
      'value' => 'testValue',
      'type' => 'String'
    );
    $restClient->putSingleProcessVariable($pi->id,'testVariable', $piv);

    $this->assertNotEmpty($restClient->getProcessVariables($pi->id));
    $this->assertEquals('testValue', $restClient->getSingleProcessVariable($pi->id, 'testVariable')->value);

    $restClient->deleteSingleProcessVariable($pi->id, 'testVariable');

  }

  //--------------------------------  TEST DELETE SINGLE PROCESS INSTANCE  ----------------------------------------
  /**
   * @test
   */
  public function deleteSingleTestInstance() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];

    $pvc = count(get_object_vars($restClient->getProcessVariables($pi->id)));

    $piv = array(
      'value' => 'testValue',
      'type' => 'String'
    );
    $restClient->putSingleProcessVariable($pi->id,'testVariable', $piv);

    $this->assertEquals($pvc + 1, count(get_object_vars($restClient->getProcessVariables($pi->id))));
    $this->assertEquals('testValue', $restClient->getSingleProcessVariable($pi->id, 'testVariable')->value);

    $restClient->deleteSingleProcessVariable($pi->id, 'testVariable');
    $this->assertEquals($pvc, count(get_object_vars($restClient->getProcessVariables($pi->id))));

  }

  //--------------------------------  TEST GET PROCESS VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function getProcessVariables() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];
    $pvc = count(get_object_vars($restClient->getProcessVariables($pi->id)));

    $piv = array(
      'value' => 'testValue',
      'type' => 'String'
    );
    $restClient->putSingleProcessVariable($pi->id,'testVariable', $piv);

    $this->assertEquals($pvc + 1, count(get_object_vars($restClient->getProcessVariables($pi->id))));

    $restClient->deleteSingleProcessVariable($pi->id, 'testVariable');
    $this->assertEquals($pvc, count(get_object_vars($restClient->getProcessVariables($pi->id))));


  }

  //--------------------------------  TEST UPDATE AND DELETE PROCESS VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function updateAndDeleteProcessVariables() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];

    $piv = array(
      'value' => 'testValue',
      'type' => 'String'
    );
    $restClient->putSingleProcessVariable($pi->id,'testVariable', $piv);

    $piv = array(
      'value' => 'testValue2',
      'type' => 'String'
    );
    $restClient->putSingleProcessVariable($pi->id,'testVariable2', $piv);

    $piv = array();
    $pm = array();
    $pm['testVariable'] = array('value' => 'newTestValue');
    $pm['testVariable2'] = array('value' => 'newTestValue2');
    $piv['modifications'] = $pm;

    $restClient->updateOrRemoveProcessVariables($pi->id, $piv);
    $this->assertEquals('newTestValue', $restClient->getSingleProcessVariable($pi->id, 'testVariable')->value);
    $this->assertEquals('newTestValue2', $restClient->getSingleProcessVariable($pi->id, 'testVariable2')->value);

    $pvc = count(get_object_vars($restClient->getProcessVariables($pi->id)));

    $piv = array();
    $pm = array('testVariable', 'testVariable2');
    $piv['deletions'] = $pm;
    $restClient->updateOrRemoveProcessVariables($pi->id, $piv);

    $this->assertEquals($pvc - 2, count(get_object_vars($restClient->getProcessVariables($pi->id))));

    
  }

  //--------------------------------  TEST GET ACTIVITY INSTANCES  ----------------------------------------
  /**
   * @test
   */
  public function getActivityInstances() {
    $restClient = new camundaRestClient(self::$restApi);
    $pi = $restClient->getProcessInstances()[0];

    $this->assertNotEmpty(get_object_vars($restClient->getActivityInstances($pi->id)));
    
  }
}
