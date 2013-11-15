<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.07.13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestExecution;

include("../../vendor/autoload.php");

use org\camunda\php\sdk\camundaRestClient;

class ExecutionTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

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
    $restClient = new camundaRestClient(self::$restApi);

    $ei = $restClient->getExecutions();
    $exeId = $ei[0]->id;
    $this->assertEquals(false, $restClient->getSingleExecution($exeId)->ended);
    
  }

  // --------------------------------  TEST GET EXECUTIONS  ----------------------------------------
  /**
   * @test
   */
  public function getExecutions() {
    $restClient = new camundaRestClient(self::$restApi);
    $er = array('active' => true);

    $this->assertNotEmpty($restClient->getExecutions());
    $this->assertNotEmpty($restClient->getExecutions($er));
    $this->assertNotEmpty($restClient->getExecutions(null, true));
    $this->assertNotEmpty($restClient->getExecutions($er, true));

  }

  //--------------------------------  TEST GET EXECUTION COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getExecutionCount() {
    $restClient = new camundaRestClient(self::$restApi);
    $er = array('active' => true);

    $count1 = $restClient->getExecutionsCount()->count;
    $count2 = count($restClient->getExecutions());
    $count3 = $restClient->getExecutionsCount(null, true)->count;
    $count4 = count($restClient->getExecutions(null, true));
    $count5 = $restClient->getExecutionsCount($er)->count;
    $count6 = count($restClient->getExecutions($er));

    $this->assertEquals($count1, $count2);
    $this->assertEquals($count3, $count4);
    $this->assertEquals($count5, $count6);
  }

  //--------------------------------  TEST GET LOCAL EXECUTION VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function getLocalExecutionVariable() {
    $restClient = new camundaRestClient(self::$restApi);
    $ei = $restClient->getExecutions()[0];
    $ev = array(
      'value' => 'test',
      'type' => 'String'
    );
    $restClient->putLocalExecutionVariable($ei->id, 'testVariable', $ev);
    $test = $restClient->getLocalExecutionVariable($ei->id, 'testVariable')->value;
    $restClient->deleteLocalExecutionVariable($ei->id, 'testVariable');

    $this->assertEquals('test', $test);

  }

  //--------------------------------  TEST PUT LOCAL EXECUTION VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function putLocalExecutionVariable() {
    $restClient = new camundaRestClient(self::$restApi);
    $ei = $restClient->getExecutions()[0];
    $ev = array(
      'value' => 'test',
      'type' => 'String'
    );
    $restClient->putLocalExecutionVariable($ei->id, 'testVariable', $ev);
    $this->assertEquals('test', $restClient->getLocalExecutionVariable($ei->id, 'testVariable')->value);

    $restClient->deleteLocalExecutionVariable($ei->id, 'testVariable');

  }

  //--------------------------------  TEST DELETE LOCAL EXECUTION VARIABLE  ----------------------------------------
  /**
   * @test
   */
  public function deleteLocalExecutionVariable() {
    $restClient = new camundaRestClient(self::$restApi);
    $ei = $restClient->getExecutions()[0];
    $ev = array(
      'value' => 'test',
      'type' => 'String'
    );
    $restClient->putLocalExecutionVariable($ei->id, 'testVariable', $ev);
    $this->assertEquals('test', $restClient->getLocalExecutionVariable($ei->id, 'testVariable')->value);

    $restClient->deleteLocalExecutionVariable($ei->id, 'testVariable');
    $this->assertObjectNotHasAttribute('value', $restClient->getLocalExecutionVariable($ei->id, 'testVariable'));

  }

  //--------------------------------  TEST GET LOCAL EXECUTION VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function getLocalExecutionVariables() {
    $restClient = new camundaRestClient(self::$restApi);
    $ei = $restClient->getExecutions()[0];
    $ev = array(
      'value' => 'test',
      'type' => 'String'
    );
    $restClient->putLocalExecutionVariable($ei->id, 'testVariable', $ev);

    $this->assertGreaterThan(0, count($restClient->getLocalExecutionVariables($ei->id)));
    $this->assertEquals(
      'test',
      $restClient->getLocalExecutionVariables($ei->id)->testVariable->value
    );
    $restClient->deleteLocalExecutionVariable($ei->id, 'testVariable');

  }

  //--------------------------------  TEST UPDATE AND DELETE PROCESS VARIABLES  ----------------------------------------
  /**
   * @test
   */
  public function updateAndDeleteProcessVariables() {
    $restClient = new camundaRestClient(self::$restApi);
    $ei = $restClient->getExecutions()[0];

    $ev = array('value' => 'testValue', 'type' => 'String');
    $restClient->putLocalExecutionVariable($ei->id,'testVariable', $ev);

    $ev = array('value' => 'testValue2', 'type' => 'String');
    $restClient->putLocalExecutionVariable($ei->id, 'testVariable2', $ev);

    $ev = array();
    $pm = array();
    $pm['testVariable'] = array();
    $pm['testVariable2'] = array();
    $pm['testVariable']['value'] = 'newTestValue';
    $pm['testVariable2']['value'] = 'newTestValue2';
    $ev['modifications'] = $pm;

    $restClient->updateOrRemoveLocalExecutionVariables($ei->id, $ev);
    $this->assertEquals('newTestValue', $restClient->getLocalExecutionVariable($ei->id, 'testVariable')->value);
    $this->assertEquals('newTestValue2', $restClient->getLocalExecutionVariable($ei->id, 'testVariable2')->value);

    $pvc = count(get_object_vars($restClient->getLocalExecutionVariables($ei->id)));

    $pm = array('testVariable', 'testVariable2');
    $ev = array('deletions' => $pm);
    $restClient->updateOrRemoveLocalExecutionVariables($ei->id, $ev);

    $this->assertEquals($pvc - 2, count(get_object_vars($restClient->getLocalExecutionVariables($ei->id))));


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
