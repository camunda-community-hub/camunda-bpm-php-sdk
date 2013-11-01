<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.07.13
 * Time: 09:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestTaskService;
use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\TaskRequest;
use org\camunda\php\sdk\entity\request\UserRequest;
use org\camunda\php\sdk\service\TaskService;
use org\camunda\php\sdk\service\UserService;

include('../../vendor/autoload.php');

class TaskServiceTest extends \PHPUnit_Framework_TestCase {
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
    $ts = new TaskService(self::$restApi);
    $tasks = $ts->getTasks(new TaskRequest());
    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*|^calledProcess:.*/', $task->getProcessDefinitionId())) {
        $this->assertEquals('demo', $ts->getTask($task->getId())->getAssignee());
        break;
      }
    };
  }

  //--------------------------  TEST GET TASKS  ----------------------------------------
  /**
   * @test
   */
  public function getTasks() {
    $ts = new TaskService(self::$restApi);
    $this->assertGreaterThan(0,count(get_object_vars($ts->getTasks(new TaskRequest()))));
    $this->assertGreaterThan(0,count(get_object_vars($ts->getTasks(new TaskRequest(), true))));

    $tr = new TaskRequest();
    $tr->setAssignee('demo');
    $this->assertGreaterThan(0,count(get_object_vars($ts->getTasks($tr, true))));
    $this->assertGreaterThan(0,count(get_object_vars($ts->getTasks($tr))));

    $tasks = $ts->getTasks(new TaskRequest());
    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*|^calledProcess:.*/', $task->getProcessDefinitionId())) {
        $this->assertEquals('demo', $ts->getTask($task->getId())->getAssignee());
        break;
      }
    };
  }

  //--------------------------------  TEST GET TASK COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getTaskCount() {
    $ts = new TaskService(self::$restApi);
    $this->assertGreaterThan(0, $ts->getCount(new TaskRequest()));
    $this->assertGreaterThan(0, $ts->getCount(new TaskRequest(), true));

    $tr = new TaskRequest();
    $tr->setAssignee('demo');
    $this->assertGreaterThan(0, $ts->getCount($tr));
    $this->assertGreaterThan(0, $ts->getCount($tr, true));
  }

  //--------------------------------  TEST GET FORM KEY  ----------------------------------------
  /**
   * @test
   */
  public function getFormKey() {
    $ts = new TaskService(self::$restApi);
    $tasks = $ts->getTasks(new TaskRequest());
    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*|^calledProcess:.*/', $task->getProcessDefinitionId())) {
        $this->assertEquals('embedded:app:forms/assign-approver.html', $ts->getFormKey($task->getId())->getKey());
        break;
      }
    }
  }

  //--------------------------------  TEST CLAIM TASK  ----------------------------------------
  /**
   * @test
   */
  public function claimTask() {
    $ts = new TaskService(self::$restApi);
    $us = new UserService(self::$restApi);

    $ur = new UserRequest();
    $up = new ProfileRequest();
    $uc = new CredentialsRequest();
    $up->setId('shentschel')
        ->setFirstName('Stefan')
        ->setLastName('Hentschel')
        ->setEmail('stefan.hentschel@camunda.com');
    $uc->setPassword('654321');
    $ur->setProfile($up)->setCredentials($uc);
    $us->createUser($ur);

    $task = $ts->getTasks(new TaskRequest())->task_1;
    $tr = new TaskRequest();
    $tr->setUserId('shentschel');
    $ts->unclaimTask($task->getId());
    $ts->claimTask($task->getId(), $tr);

    $this->assertEquals('shentschel', $ts->getTask($task->getId())->getAssignee());
    $ts->unclaimTask($task->getId());
    $ts->getTask($task->getId())->getAssignee();
    $tr->setUserId('demo');
    $ts->claimTask($task->getId(), $tr);
    $ts->getTask($task->getId())->getAssignee();
    $us->deleteUser('shentschel');

  }

  //--------------------------------  TEST UNCLAIM TASK  ----------------------------------------
  /**
   * @test
   */
  public function unclaimTask() {
    $ts = new TaskService(self::$restApi);
    $us = new UserService(self::$restApi);

    $ur = new UserRequest();
    $up = new ProfileRequest();
    $uc = new CredentialsRequest();
    $up->setId('shentschel')
        ->setFirstName('Stefan')
        ->setLastName('Hentschel')
        ->setEmail('stefan.hentschel@camunda.com');
    $uc->setPassword('654321');
    $ur->setProfile($up)->setCredentials($uc);
    $us->createUser($ur);

    $task = $ts->getTasks(new TaskRequest())->task_1;
    $tr = new TaskRequest();
    $tr->setUserId('shentschel');
    $ts->unclaimTask($task->getId());

    $this->assertNull($ts->getTask($task->getId())->getAssignee());
    $tr->setUserId('demo');
    $ts->claimTask($task->getId(), $tr);
    $us->deleteUser('shentschel');

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
    $ts = new TaskService(self::$restApi);
    $us = new UserService(self::$restApi);

    $ur = new UserRequest();
    $up = new ProfileRequest();
    $uc = new CredentialsRequest();
    $up->setId('shentschel')
        ->setFirstName('Stefan')
        ->setLastName('Hentschel')
        ->setEmail('stefan.hentschel@camunda.com');
    $uc->setPassword('654321');
    $ur->setProfile($up)->setCredentials($uc);
    $us->createUser($ur);

    $tasks = $ts->getTasks(new TaskRequest());
    $tr = new TaskRequest();
    $tr->setUserId('shentschel');

    foreach($tasks AS $task) {
      if(!preg_match('/^waitStates\:.*/', $task->getProcessDefinitionId())) {
        $ts->delegateTask($task->getId(), $tr);
        $this->assertEquals('PENDING', $ts->getTask($task->getId())->getDelegationState());
        $ts->unclaimTask($task->getId(), $tr);
        $tr->setUserId('demo');
        $ts->claimTask($task->getId(), $tr);
        break;
      }
    };

    $us->deleteUser('shentschel');
  }

  //--------------------------------  TEST TAKEOVER TASK  ----------------------------------------
  /**
   * @test
   */
  public function takeoverTask() {
    $ts = new TaskService(self::$restApi);
    $us = new UserService(self::$restApi);

    $ur = new UserRequest();
    $up = new ProfileRequest();
    $uc = new CredentialsRequest();
    $up->setId('shentschel')
        ->setFirstName('Stefan')
        ->setLastName('Hentschel')
        ->setEmail('stefan.hentschel@camunda.com');
    $uc->setPassword('654321');
    $ur->setProfile($up)->setCredentials($uc);
    $us->createUser($ur);

    $task = $ts->getTasks(new TaskRequest())->task_1;
    $tr = new TaskRequest();
    $tr->setUserId('shentschel');
    $ts->takeTask($task->getId(), $tr);

    $this->assertEquals('shentschel', $ts->getTask($task->getId())->getAssignee());

    $tr = new TaskRequest();
    $tr->setUserId('demo');
    $ts->takeTask($task->getId(), $tr);

    $us->deleteUser($up->getId());
  }
}