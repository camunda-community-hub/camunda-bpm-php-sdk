<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 23.07.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestGroupService;
include('../../vendor/autoload.php');

use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\GroupRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\UserRequest;
use org\camunda\php\sdk\service\GroupService;
use org\camunda\php\sdk\service\UserService;

class GroupServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST CREATE GROUP  ----------------------------------------
  public function testCreateGroup() {
    $groupService = new GroupService(self::$restApi);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
        ->setId('sales2')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $this->assertEquals(2, $groupService->getCount(new GroupRequest()));


    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');
  }

  //--------------------------------  TEST ADD GROUP MEMBER  ----------------------------------------
  public function testAddGroupMember() {
    $groupService = new GroupService(self::$restApi);
    $userService = new UserService(self::$restApi);

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();

    $userProfile->setId('shentschel')
                ->setFirstName('Stefan')
                ->setLastName('Hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');

    $user->setProfile($userProfile)
         ->setCredentials($userCredentials);
    $userService->createUser($user);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
        ->setId('sales2')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupService->addMember('sales', 'shentschel');

    $filteredGroup = new GroupRequest();
    $filteredGroup->setMember('shentschel');
    $this->assertEquals(1, $groupService->getCount($filteredGroup));

    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');
    $userService->deleteUser('shentschel');
    
  }

  //--------------------------------  TEST DELETE GROUP  ----------------------------------------
  public function testDeleteGroup() {
    $groupService = new GroupService(self::$restApi);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
                  ->setId('sales')
                  ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
                 ->setId('sales2')
                 ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $this->assertEquals(2, $groupService->getCount(new GroupRequest()));

    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');
    $this->assertEquals(0, $groupService->getCount(new GroupRequest()));
    
  }

  //--------------------------------  TEST REMOVE GROUP MEMBER  ----------------------------------------
  public function testRemoveGroupMember() {
    $groupService = new GroupService(self::$restApi);
    $userService = new UserService(self::$restApi);

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();

    $userProfile->setId('shentschel')
        ->setFirstName('Stefan')
        ->setLastName('Hentschel')
        ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)
        ->setCredentials($userCredentials);
    $userService->createUser($user);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
        ->setId('sales2')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupService->addMember('sales', 'shentschel');

    $filteredGroup = new GroupRequest();
    $filteredGroup->setMember('shentschel');
    $this->assertEquals(1, $groupService->getCount($filteredGroup));

    $groupService->removeMember('sales', 'shentschel');
    $this->assertEquals(0, $groupService->getCount($filteredGroup));

    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');
    $userService->deleteUser('shentschel');

    
  }

  //--------------------------------  TEST GET GROUP  ----------------------------------------
  public function testGetGroup() {
    $groupService = new GroupService(self::$restApi);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
        ->setId('sales2')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $this->assertEquals('testgroup', $groupService->getGroup('sales')->getName());

    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');

    
  }

  //--------------------------------  TEST GET GROUPS  ----------------------------------------
  public function testGetGroups() {
    $groupService = new GroupService(self::$restApi);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);
    $this->assertEquals('sales', $groupService->getGroups(new GroupRequest())->group_0->getId());

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
        ->setId('sales2')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);
    $this->assertEquals('sales2', $groupService->getGroups(new GroupRequest())->group_1->getId());

    $filteredGroup = new GroupRequest();
    $filteredGroup->setName('testgroup');

    $this->assertEquals('sales', $groupService->getGroups($filteredGroup)->group_0->getId());
    $this->assertObjectNotHasAttribute('group_1', $groupService->getGroups($filteredGroup));

    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');
    
  }

  //--------------------------------  TEST GET GROUP COUNT  ----------------------------------------
  public function testGetGroupCount() {
    $groupService = new GroupService(self::$restApi);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);
    $this->assertEquals(1, $groupService->getCount(new GroupRequest()));

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup2')
        ->setId('sales2')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);
    $this->assertEquals(2, $groupService->getCount(new GroupRequest()));

    $filteredGroup = new GroupRequest();
    $filteredGroup->setName('testgroup');

    $this->assertEquals(1, $groupService->getCount($filteredGroup));

    $groupService->deleteGroup('sales');
    $groupService->deleteGroup('sales2');
    $this->assertEquals(0, $groupService->getCount($filteredGroup));
    
  }

  //--------------------------------  TEST UPDATE GROUP  ----------------------------------------
  public function testUpdateGroup(){
    $groupService = new GroupService(self::$restApi);

    $groupRequest = new GroupRequest();
    $groupRequest->setName('testgroup')
        ->setId('sales')
        ->setType('Organizational Unit');
    $groupService->createGroup($groupRequest);

    $this->assertEquals('testgroup', $groupService->getGroup('sales')->getName());

    $update = new GroupRequest();
    $update->setName('Testgroup2')
           ->setId('sales')
           ->setType('Organizational Unit');
    $groupService->updateGroup('sales', $update);

    $this->assertEquals('Testgroup2', $groupService->getGroup('sales')->getName());

    $groupService->deleteGroup('sales');
    
  }
}
