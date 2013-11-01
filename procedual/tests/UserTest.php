<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestUser;

use org\camunda\php\sdk\camundaRestClient;

include('../../vendor/autoload.php');


class UserTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST CREATE USER  ----------------------------------------
  /**
   * @test
   */
  public function createUser() {
    $restService = new camundaRestClient(self::$restApi);
    $precount = $restService->getUserCount()->count;

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

    $this->assertEquals($precount + 1, $restService->getUserCount()->count);

    $restService->deleteSingleUser('shentschel');
  }

  //--------------------------------  TEST DELETE USER  ----------------------------------------
  /**
   * @test
   */
  public function deleteUser() {
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
    $precount = $restService->getUserCount()->count;

    $restService->deleteSingleUser('shentschel');

    $this->assertEquals($precount - 1, $restService->getUserCount()->count);
  }

  //--------------------------------  TEST GET USER PROFILE  ----------------------------------------
  /**
   * @test
   */
  public function getUserProfile() {
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

    $this->assertEquals('Stefan', $restService->getUserProfile('shentschel')->firstName);

    $restService->deleteSingleUser('shentschel');


  }

  //--------------------------------  TEST GET USERS  ----------------------------------------
  /**
   * @test
   */
  public function getUsers() {
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

    $this->assertEquals('shentschel', $restService->getUsers()[0]->id);

    unset($user);
    unset($profile);
    unset($credentials);
    $user = array();
    $profile = array();
    $credentials = array();
    $profile['id'] = 'jonny1';
    $profile['firstName'] = 'John';
    $profile['lastName'] = 'Doe';
    $profile['email'] = 'john.doe@camundaTest.com';
    $credentials['password'] = '42-23-1337';
    $user['profile'] = $profile;
    $user['credentials'] = $credentials;
    $restService->createSingleUser($user);

    $this->assertEquals('jonny1', $restService->getUsers()[0]->id);
    $this->assertEquals('shentschel', $restService->getUsers()[1]->id);

    $filteredUser = array('firstName' => 'Stefan');

    $this->assertEquals('shentschel', $restService->getUsers($filteredUser)[0]->id);
    $this->assertArrayNotHasKey('1', $restService->getUsers($filteredUser));

    $restService->deleteSingleUser('shentschel');
    $restService->deleteSingleUser('jonny1');


  }

  //--------------------------------  TEST GET USER COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getUserCount() {
    $restService = new camundaRestClient(self::$restApi);

    $filteredUser = array('firstName' => 'Stefan');

    $precount = $restService->getUserCount()->count;
    $filteredPrecount = $restService->getUserCount($filteredUser)->count;

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
    $this->assertEquals($precount + 1, $restService->getUserCount()->count);

    unset($user);
    unset($profile);
    unset($credentials);
    $user = array();
    $profile = array();
    $credentials = array();
    $profile['id'] = 'jonny1';
    $profile['firstName'] = 'John';
    $profile['lastName'] = 'Doe';
    $profile['email'] = 'john.doe@camundaTest.com';
    $credentials['password'] = '42-23-1337';
    $user['profile'] = $profile;
    $user['credentials'] = $credentials;
    $restService->createSingleUser($user);

    $this->assertEquals($precount + 2, $restService->getUserCount()->count);
    $this->assertEquals($filteredPrecount + 1, $restService->getUserCount($filteredUser)->count);

    $restService->deleteSingleUser('shentschel');
    $restService->deleteSingleUser('jonny1');

    $this->assertEquals($precount, $restService->getUserCount()->count);


  }

  //--------------------------------  TEST UPDATE USER PROFILE  ----------------------------------------
  /**
   * @test
   */
  public function updateUserProfile() {
    $restService = new camundaRestClient(self::$restApi);

    $user = array();
    $profile['id'] = 'shentschel';
    $profile['firstName'] = 'Stefan';
    $profile['lastName'] = 'Hentschel';
    $profile['email'] = 'stefan.hentschel@camunda.com';
    $credentials['password'] = '123456';
    $user['profile'] = $profile;
    $user['credentials'] = $credentials;
    $restService->createSingleUser($user);

    $this->assertEquals('Stefan', $restService->getUserProfile('shentschel')->firstName);

    unset($profile);
    $profile = array();
    $profile['id'] = 'shentschel';
    $profile['firstName'] = 'John';
    $profile['lastName'] = 'Doe';
    $profile['email'] = 'john.doe@who.com';
    $restService->updateUserProfile('shentschel', $profile);

    $this->assertEquals('John', $restService->getUserProfile('shentschel')->firstName);

    $restService->deleteSingleUser('shentschel');


  }

  //--------------------------------  TEST UPDATE USER CREDENTIALS  ----------------------------------------
  /**
   * TODO: Create with authorisation
   * @test
   */
  /*public function testUpdateUserCredentials() {
     $restService = new camundaRestClient(self::$restApi);

    $filteredUser = array('firstName' => 'Stefan');

    $this->assertEquals(0, $restService->getUserCount()->count);
    $user = ;
    $userProfile = new Profile();
    $userCredentials = new Credentials();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    $restService->createUser($user);

    $this->assertEquals('stefan', $restService->('shentschel')->getFirstName());

    $userCredentials = ;
    $userCredentials->setPassword('haha');
    $restService->updateCredentials('shentschel', $userCredentials);

    $this->assertEquals('""', $restService->getUserProfile('shentschel')->getFirstName());

    $restService->deleteSingleUser('shentschel');

    
  }*/
}
