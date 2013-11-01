<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.07.13
 * Time: 09:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestTask;
use org\camunda\php\sdk\camundaRestClient;

include('../../vendor/autoload.php');

class TaskTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET SINGLE TASK  ----------------------------------------
  /**
   * @test
   */
  public function getSingleTask() {
    $restService = new camundaRestClient(self::$restApi);
    $tasks = $restService->getTasks();
    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*/', $task->processDefinitionId)) {
        $this->assertEquals('demo', $restService->getSingleTask($task->id)->assignee);
        break;
      }
    };
  }

  //--------------------------  TEST GET TASKS  ----------------------------------------
  /**
   * @test
   */
  public function getTasks() {
    $restService = new camundaRestClient(self::$restApi);
    $this->assertGreaterThan(0,count($restService->getTasks()));
    $this->assertGreaterThan(0,count($restService->getTasks(null, true)));

    $tr = array('assignee' => 'demo');
    $this->assertGreaterThan(0,count($restService->getTasks($tr, true)));
    $this->assertGreaterThan(0,count($restService->getTasks($tr)));

    $tasks = $restService->getTasks();
    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*/', $task->processDefinitionId)) {
        $this->assertEquals('demo', $restService->getSingleTask($task->id)->assignee);
        break;
      }
    };
  }

  //--------------------------------  TEST GET TASK COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getTaskCount() {
    $restService = new camundaRestClient(self::$restApi);
    $this->assertGreaterThan(0, $restService->getTaskCount()->count);
    $this->assertGreaterThan(0, $restService->getTaskCount(null, true)->count);

    $tr = array('assignee' => 'demo');
    $this->assertGreaterThan(0, $restService->getTaskCount($tr)->count);
    $this->assertGreaterThan(0, $restService->getTaskCount($tr, true)->count);
  }

  //--------------------------------  TEST GET FORM KEY  ----------------------------------------
  /**
   * @test
   */
  public function getFormKey() {
    $restService = new camundaRestClient(self::$restApi);
    $tasks = $restService->getTasks();
    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*/', $task->processDefinitionId)) {
        $this->assertEquals('embedded:app:forms/assign-approver.html', $restService->getFormKey($task->id)->key);
        break;
      }
    }
  }

  //--------------------------------  TEST CLAIM TASK  ----------------------------------------
  /**
   * @test
   */
  public function claimTask() {
    $restService = new camundaRestClient(self::$restApi);

    $user = array();
    $profile = array();
    $credentials = array();
    $profile['id'] = 'shentschel';
    $profile['firstName'] = 'Stefan';
    $profile['lastName'] = 'Hentschel';
    $profile['email'] = 'stefan.hentschel@camunda.com';
    $credentials['password'] = '123456';
    $user['profile'] = $profile;
    $user['credentials'] = $credentials;
    $restService->createSingleUser($user);


    $task = $restService->getTasks()[1];
    $tr = array('userId' => 'shentschel');
    $restService->unclaimTask($task->id);
    $restService->claimTask($task->id, $tr);

    $this->assertEquals('shentschel', $restService->getSingleTask($task->id)->assignee);
    $restService->unclaimTask($task->id);
    $restService->getSingleTask($task->id)->assignee;
    $tr = array('userId' => 'demo');
    $restService->claimTask($task->id, $tr);
    $restService->getSingleTask($task->id)->assignee;
    $restService->deleteSingleUser('shentschel');

  }

  //--------------------------------  TEST UNCLAIM TASK  ----------------------------------------
  /**
   * @test
   */
  public function unclaimTask() {
    $restService = new camundaRestClient(self::$restApi);

    $user = array();
    $profile = array();
    $credentials = array();
    $profile['id'] = 'shentschel';
    $profile['firstName'] = 'Stefan';
    $profile['lastName'] = 'Hentschel';
    $profile['email'] = 'stefan.hentschel@camunda.com';
    $credentials['password'] = '123456';
    $user['profile'] = $profile;
    $user['credentials'] = $credentials;
    $restService->createSingleUser($user);


    $task = $restService->getTasks()[1];
    $restService->unclaimTask($task->id);

    $this->assertNull($restService->getSingleTask($task->id)->assignee);
    $tr = array('userId' => 'demo');
    $restService->claimTask($task->id, $tr);
    $restService->deleteSingleUser('shentschel');

  }

  //--------------------------------  TEST COMPLETE TASK  ----------------------------------------
  /**
   * TODO: Needs a good method to deploy processes on the fly with the engine
   * @test
   */
  public function completeTask() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );

  }

  //--------------------------------  TEST RESOLVE TASK  ----------------------------------------
  /**
   * TODO: Needs a good method to deploy processes on the fly with the engine
   * @test
   */
  public function resolveTask() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );

  }

  //--------------------------------  TEST DELEGATE TASK  ----------------------------------------
  /**
   * @test
   */
  public function delegateTask() {
    $restService = new camundaRestClient(self::$restApi);

    $user = array();
    $profile = array();
    $credentials = array();
    $profile['id'] = 'shentschel';
    $profile['firstName'] = 'Stefan';
    $profile['lastName'] = 'Hentschel';
    $profile['email'] = 'stefan.hentschel@camunda.com';
    $credentials['password'] = '123456';
    $user['profile'] = $profile;
    $user['credentials'] = $credentials;
    $restService->createSingleUser($user);

    $tasks = $restService->getTasks();
    $tr = array('userId' => 'shentschel');

    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*/', $task->processDefinitionId)) {
        $restService->delegateTask($task->id, $tr);
        $this->assertEquals('PENDING', $restService->getSingleTask($task->id)->delegationState);
        $restService->unclaimTask($task->id, $tr);
        $tr = array('userId' => 'demo');
        $restService->claimTask($task->id, $tr);
        $restService->deleteSingleUser('shentschel');
        break;
      }
    };
  }
}