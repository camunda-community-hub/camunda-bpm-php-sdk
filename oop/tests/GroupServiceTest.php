<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 23.07.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
include('../../vendor/autoload.php');

use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\GroupRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\UserRequest;
use org\camunda\php\sdk\service\GroupService;
use org\camunda\php\sdk\service\UserService;

class GroupServiceTest extends \PHPUnit_Framework_TestCase
{
    protected static $restApi;
    protected static $gs;
    protected static $us;

    public static function setUpBeforeClass()
    {
        self::$restApi = 'http://localhost:8080/engine-rest';
        print("\n\nCLASS: " . __CLASS__ . "\n");
        self::$gs = new GroupService(self::$restApi);
        self::$us = new UserService(self::$restApi);
    }

    public static function tearDownAfterClass()
    {
        self::$restApi = null;
    }

    //--------------------------------  TEST CREATE GROUP  ----------------------------------------
    public function testCreateGroup()
    {

        $groupRequest = new GroupRequest();

        $preCount = self::$gs->getCount($groupRequest);

        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $this->assertEquals($preCount + 2, self::$gs->getCount(new GroupRequest()));


        self::$gs->deleteGroup('PHP_UNIT_TEST_1');
        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
    }

    //--------------------------------  TEST ADD GROUP MEMBER  ----------------------------------------
    public function testAddGroupMember()
    {
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
        self::$us->createUser($user);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        self::$gs->addMember('PHP_UNIT_TEST_1', 'shentschel');

        $filteredGroup = new GroupRequest();
        $filteredGroup->setMember('shentschel');
        $this->assertEquals(1, self::$gs->getCount($filteredGroup));

        self::$gs->deleteGroup('PHP_UNIT_TEST_1');
        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
        self::$us->deleteUser('shentschel');

    }

    //--------------------------------  TEST DELETE GROUP  ----------------------------------------
    public function testDeleteGroup()
    {

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $count = self::$gs->getCount(new GroupRequest());

        self::$gs->deleteGroup('PHP_UNIT_TEST_1');
        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
        $this->assertEquals($count - 2, self::$gs->getCount(new GroupRequest()));

    }

    //--------------------------------  TEST REMOVE GROUP MEMBER  ----------------------------------------
    public function testRemoveGroupMember()
    {
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
        self::$us->createUser($user);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        self::$gs->addMember('PHP_UNIT_TEST_1', 'shentschel');

        $filteredGroup = new GroupRequest();
        $filteredGroup->setMember('shentschel');
        $this->assertEquals(1, self::$gs->getCount($filteredGroup));

        self::$gs->removeMember('PHP_UNIT_TEST_1', 'shentschel');
        $this->assertEquals(0, self::$gs->getCount($filteredGroup));

        self::$gs->deleteGroup('PHP_UNIT_TEST_1');
        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
        self::$us->deleteUser('shentschel');


    }

    //--------------------------------  TEST GET GROUP  ----------------------------------------
    public function testGetGroup()
    {

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $this->assertEquals('testgroup', self::$gs->getGroup('PHP_UNIT_TEST_1')->getName());

        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
        self::$gs->deleteGroup('PHP_UNIT_TEST_1');


    }

    //--------------------------------  TEST GET GROUPS  ----------------------------------------
    public function testGetGroups()
    {

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);
        $this->assertEquals('PHP_UNIT_TEST_1', self::$gs->getGroups(new GroupRequest())->group_0->getId());

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);
        $this->assertEquals('PHP_UNIT_TEST_2', self::$gs->getGroups(new GroupRequest())->group_1->getId());

        $filteredGroup = new GroupRequest();
        $filteredGroup->setName('testgroup');

        $this->assertEquals('PHP_UNIT_TEST_1', self::$gs->getGroups($filteredGroup)->group_0->getId());
        $this->assertObjectNotHasAttribute('group_1', self::$gs->getGroups($filteredGroup));

        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
        self::$gs->deleteGroup('PHP_UNIT_TEST_1');

    }

    //--------------------------------  TEST GET GROUP COUNT  ----------------------------------------
    public function testGetGroupCount()
    {

        $groupRequest = new GroupRequest();
        $initialCount = self::$gs->getCount($groupRequest);

        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);
        $this->assertEquals($initialCount + 1, self::$gs->getCount(new GroupRequest()));

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup2')
            ->setId('PHP_UNIT_TEST_2')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);
        $this->assertEquals($initialCount + 2, self::$gs->getCount(new GroupRequest()));

        $filteredGroup = new GroupRequest();
        $filteredGroup->setName('testgroup');

        $this->assertEquals(1, self::$gs->getCount($filteredGroup));

        self::$gs->deleteGroup('PHP_UNIT_TEST_1');
        self::$gs->deleteGroup('PHP_UNIT_TEST_2');
        $this->assertEquals($initialCount, self::$gs->getCount(new GroupRequest()));

    }

    //--------------------------------  TEST UPDATE GROUP  ----------------------------------------
    public function testUpdateGroup()
    {

        $groupRequest = new GroupRequest();
        $groupRequest->setName('testgroup')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->createGroup($groupRequest);

        $this->assertEquals('testgroup', self::$gs->getGroup('PHP_UNIT_TEST_1')->getName());

        $update = new GroupRequest();
        $update->setName('Testgroup2')
            ->setId('PHP_UNIT_TEST_1')
            ->setType('Organizational Unit');
        self::$gs->updateGroup('sales', $update);

        $this->assertEquals('Testgroup2', self::$gs->getGroup('PHP_UNIT_TEST_1')->getName());

        self::$gs->deleteGroup('PHP_UNIT_TEST_1');

    }

    /**
     * @test
     */
    public function getGroupResourceOptions()
    {

        $mainOption = self::$gs->getResourceOption();
        $this->assertObjectHasAttribute('method', $mainOption->getLinks()[0]);

        $instanceOption = self::$gs->getResourceInstanceOption('sales');
        $this->assertObjectHasAttribute('method', $instanceOption->getLinks()[0]);
    }
}
