<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 23.07.13
 * Time: 13:39
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestGroup;
use org\camunda\php\sdk\camundaRestClient;

include('../../vendor/autoload.php');

class GroupTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST CREATE GROUP  ----------------------------------------
  public function testCreateGroup() {
    $restService = new camundaRestClient(self::$restApi);

    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $this->assertEquals(2, $restService->getGroupsCount()->count);


    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');
    $this->assertEquals(0, $restService->getGroupsCount()->count);
  }

  //--------------------------------  TEST ADD GROUP MEMBER  ----------------------------------------
  public function testAddGroupMember() {
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

    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    unset($groupRequest);
    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $restService->addGroupMember('sales', 'shentschel');

    $filteredGroup = array(
      'member' => 'shentschel'
    );
    $this->assertEquals(1, $restService->getGroupsCount($filteredGroup)->count);

    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');
    $restService->deleteSingleUser('shentschel');
    
  }

  //--------------------------------  TEST DELETE GROUP  ----------------------------------------
  public function testDeleteGroup() {
    $restService = new camundaRestClient(self::$restApi);

    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $this->assertEquals(2, $restService->getGroupsCount()->count);

    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');
    $this->assertEquals(0, $restService->getGroupsCount()->count);

  }

  //--------------------------------  TEST REMOVE GROUP MEMBER  ----------------------------------------
  public function testRemoveGroupMember() {
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

    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $restService->addGroupMember('sales', 'shentschel');

    $filteredGroup = array(
      'member' => 'shentschel'
    );
    $this->assertEquals(1, $restService->getGroupsCount($filteredGroup)->count);

    $restService->removeGroupMember('sales', 'shentschel');
    $this->assertEquals(0, $restService->getGroupsCount($filteredGroup)->count);

    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');
    $restService->deleteSingleUser('shentschel');


  }

  //--------------------------------  TEST GET GROUP  ----------------------------------------
  public function testGetGroup() {
    $restService = new camundaRestClient(self::$restApi);

    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);

    $this->assertEquals('testgroup', $restService->getSingleGroup('sales')->name);

    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');


  }

  //--------------------------------  TEST GET GROUPS  ----------------------------------------
  public function testGetGroups() {
    $restService = new camundaRestClient(self::$restApi);

    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);
    $this->assertEquals('sales', $restService->getGroups()[0]->id);

    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);
    $this->assertEquals('sales2', $restService->getGroups()[1]->id);
    $filteredGroup = array(
      'name' => 'testgroup'
    );
    $this->assertEquals('sales', $restService->getGroups($filteredGroup)[0]->id);
    $this->assertArrayNotHasKey('1', $restService->getGroups($filteredGroup));
    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');
  }

  //--------------------------------  TEST GET GROUP COUNT  ----------------------------------------
  public function testGetGroupCount() {
    $restService = new camundaRestClient(self::$restApi);
    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);
    $this->assertEquals(1, $restService->getGroupsCount()->count);
    $groupRequest = array(
      'name' => 'testgroup2',
      'id' => 'sales2',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);
    $this->assertEquals(2, $restService->getGroupsCount()->count);
    $filteredGroup = array(
      'name' => 'testgroup'
    );
    $this->assertEquals(1, $restService->getGroupsCount($filteredGroup)->count);
    $restService->deleteSingleGroup('sales');
    $restService->deleteSingleGroup('sales2');
    $this->assertEquals(0, $restService->getGroupsCount($filteredGroup)->count);
  }

  //--------------------------------  TEST UPDATE GROUP  ----------------------------------------
  public function testUpdateGroup(){
    $restService = new camundaRestClient(self::$restApi);
    $groupRequest = array(
      'name' => 'testgroup',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->createSingleGroup($groupRequest);
    $this->assertEquals('testgroup', $restService->getSingleGroup('sales')->name);
    $update = array(
      'name' => 'testgroup2',
      'id' => 'sales',
      'type' => 'Organizational Unit'
    );
    $restService->updateSingleGroup('sales', $update);
    $this->assertEquals('testgroup2', $restService->getSingleGroup('sales')->name);
    $restService->deleteSingleGroup('sales');

  }
}
