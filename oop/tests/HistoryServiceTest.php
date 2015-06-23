<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.10.13
 * Time: 07:46
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
use org\camunda\php\sdk\entity\request\HistoricActivityInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricProcessInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricVariableInstanceRequest;
use org\camunda\php\sdk\entity\request\HistoricActivityStatisticRequest;
use org\camunda\php\sdk\service\HistoryService;

include('../../vendor/autoload.php');

class HistoryServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;
  protected static $hs;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
    print("\n\nCLASS: " . __CLASS__ . "\n");
    self::$hs = new HistoryService(self::$restApi);
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  /**
   * @test
   */
  public function getActivityInstances() {
    $activityInstances = self::$hs->getActivityInstances(new HistoricActivityInstanceRequest());
    $this->assertEmpty($activityInstances->historicActivityInstance_0->getAssignee());
  }

  /**
   * @test
   */
  public function getActivityInstancesCount() {
    $activityInstancesCount = self::$hs->getActivityInstancesCount(new HistoricActivityInstanceRequest());
    $this->assertNotEquals(0, $activityInstancesCount);
    $this->assertNotNull($activityInstancesCount);
    $this->assertNotEmpty($activityInstancesCount);
  }

  /**
   * @test
   */
  public function getProcessInstances() {
    $processInstances = self::$hs->getProcessInstances(new HistoricProcessInstanceRequest());
    $this->assertEmpty($processInstances->historicProcessInstance_0->getStartUserId());
  }

  /**
   * @test
   */
  public function getProcessInstancesCount() {
    $processInstancesCount = self::$hs->getProcessInstancesCount(new HistoricProcessInstanceRequest());
    $this->assertNotEquals(0, $processInstancesCount);
    $this->assertNotNull($processInstancesCount);
    $this->assertNotEmpty($processInstancesCount);
  }

  /**
   * @test
   */
  public function getVariableInstances() {
    $variableInstance = self::$hs->getVariableInstances(new HistoricVariableInstanceRequest());
    $this->assertNotEmpty($variableInstance->historicVariableInstance_0->getType());
    $this->assertEquals('String', $variableInstance->historicVariableInstance_0->getType());
  }

  /**
   * @test
   */
  public function getVariableInstancesCount() {
    $variableInstanceCount = self::$hs->getVariableInstances(new HistoricVariableInstanceRequest());
    $this->assertNotEquals(0, $variableInstanceCount);
    $this->assertNotNull($variableInstanceCount);
    $this->assertNotEmpty($variableInstanceCount);
  }

  /**
   * @test
   */
  public function testGetHistoricActivityStatistics() {
    $pdi = self::$pds->getDefinitions(new ProcessDefinitionRequest())->definition_0->getId();
    $has = self::$hs->getHistoricActivityStatistic($pdi, new HistoricActivityStatisticRequest())->statistic_0->getId();
    $this->assertNotEmpty('UserTask_1', $has);
  }
}
