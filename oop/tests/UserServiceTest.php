<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\UserRequest;
use org\camunda\php\sdk\service\UserService;

include('../../vendor/autoload.php');


class UserServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;
  protected static $us;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
    print("\n\nCLASS: " . __CLASS__ . "\n");
    self::$us = new UserService(self::$restApi);
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST CREATE USER  ----------------------------------------
  /**
   * @test
   */
  public function createUser() {
    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();

    $filteredUser = new UserRequest();
    $filteredUser->setId('shentschel');

    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    $count = self::$us->getCount(new UserRequest());
    $countFiltered = self::$us->getCount($filteredUser);
    self::$us->createUser($user);

    $this->assertEquals($count + 1, self::$us->getCount(new UserRequest()));
    $this->assertEquals($countFiltered + 1, self::$us->getCount($filteredUser));

    self::$us->deleteUser('shentschel');
    $this->assertEquals($count, self::$us->getCount(new UserRequest()));

    
  }

  //--------------------------------  TEST DELETE USER  ----------------------------------------
  /**
   * @test
   */
  public function deleteUser() {
    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();

    $filteredUser = new UserRequest();
    $filteredUser->setId('shentschel');

    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);

    $count = self::$us->getCount(new UserRequest());
    $countFiltered = self::$us->getCount($filteredUser);
    self::$us->createUser($user);

    $this->assertEquals($count + 1, self::$us->getCount(new UserRequest()));
    $this->assertEquals($countFiltered + 1, self::$us->getCount($filteredUser));

    self::$us->deleteUser('shentschel');

    $this->assertEquals($count, self::$us->getCount(new UserRequest()));
    $this->assertEquals($countFiltered, self::$us->getCount($filteredUser));

    
  }

  //--------------------------------  TEST GET USER PROFILE  ----------------------------------------
  /**
   * @test
   */
  public function getUserProfile() {
    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();

    $filteredUser = new UserRequest();
    $filteredUser->setId('shentschel');

    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);

    self::$us->createUser($user);

    $this->assertEquals('stefan', self::$us->getProfile('shentschel')->getFirstName());

    self::$us->deleteUser('shentschel');

    
  }

  //--------------------------------  TEST GET USERS  ----------------------------------------
  /**
   * @test
   */
  public function getUsers() {
    $filteredUser = new UserRequest();
    $filteredUser->setFirstName('stefan');

    $userId = self::$us->getCount(new UserRequest());

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    self::$us->createUser($user);
    $this->assertEquals('shentschel', self::$us->getUsers(new UserRequest())->{'user_'.$userId}->getId());

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('php_unit_tester_1')
                ->setFirstName('PHP')
                ->setLastName('UNIT')
                ->setEmail('PHP_UNIT_SQUAD@CAMUNDA.COM');
    $userCredentials->setPassword('1337-42-23');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    self::$us->createUser($user);

    $this->assertEquals('shentschel', self::$us->getUsers(new UserRequest())->{'user_'.($userId+1)}->getId());
    $this->assertEquals('php_unit_tester_1', self::$us->getUsers(new UserRequest())->{'user_'.$userId}->getId());

    $this->assertEquals('shentschel', self::$us->getUsers($filteredUser)->user_0->getId());
    $this->assertObjectNotHasAttribute('user_1', self::$us->getUsers($filteredUser));

    self::$us->deleteUser('shentschel');
    self::$us->deleteUser('php_unit_tester_1');

    
  }

  //--------------------------------  TEST GET USER COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getUserCount() {
    $filteredUser = new UserRequest();
    $filteredUser->setFirstName('stefan');

    $count = self::$us->getCount(new UserRequest());
    $countFiltered = self::$us->getCount($filteredUser);

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    self::$us->createUser($user);
    $this->assertEquals($count + 1, self::$us->getCount(new UserRequest()));

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('jonny1')
                ->setFirstName('John')
                ->setLastName('Doe')
                ->setEmail('john.doe@who.com');
    $userCredentials->setPassword('1337-42-23');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    self::$us->createUser($user);

    $this->assertEquals($count + 2, self::$us->getCount(new UserRequest()));
    $this->assertEquals($countFiltered + 1, self::$us->getCount($filteredUser));

    self::$us->deleteUser('shentschel');
    self::$us->deleteUser('jonny1');

    $this->assertEquals($count, self::$us->getCount(new UserRequest()));

    
  }

  //--------------------------------  TEST UPDATE USER PROFILE  ----------------------------------------
  /**
   * @test
   */
  public function updateUserProfile() {
    $filteredUser = new UserRequest();
    $filteredUser->setFirstName('stefan');

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    self::$us->createUser($user);

    $this->assertEquals('stefan', self::$us->getProfile('shentschel')->getFirstName());

    $userProfile = new ProfileRequest();
    $userProfile->setId('shentschel')
                ->setFirstName('John')
                ->setLastName('Doe')
                ->setEmail('john.doe@who.com');
    self::$us->updateProfile('shentschel', $userProfile);

    $this->assertEquals('John', self::$us->getProfile('shentschel')->getFirstName());
    self::$us->deleteUser('shentschel');
  }

  //--------------------------------  TEST UPDATE USER CREDENTIALS  ----------------------------------------
  /**
   * TODO: Create with authorisation
   * @test
   */
  public function testUpdateUserCredentials() {
    /*
    $filteredUser = new UserRequest();
    $filteredUser->setFirstName('stefan');

    $this->assertEquals(0, self::$us->getCount(new UserRequest()));
    $user = new UserRequest();
    $userProfile = new Profile();
    $userCredentials = new Credentials();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    self::$us->createUser($user);

    $this->assertEquals('stefan', self::$us->('shentschel')->getFirstName());

    $userCredentials = new UserRequest();
    $userCredentials->setPassword('haha');
    self::$us->updateCredentials('shentschel', $userCredentials);

    $this->assertEquals('""', self::$us->getProfile('shentschel')->getFirstName());

    self::$us->deleteUser('shentschel');
  */
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  /**
   * @test
   */
  public function getUserResourceOptions() {
    $mainOption = self::$us->getResourceOption();
    $this->assertObjectHasAttribute('method', $mainOption->getLinks()[0]);

    $instanceOption = self::$us->getResourceInstanceOption('demo');
    $this->assertObjectHasAttribute('method', $instanceOption->getLinks()[0]);
  }
}
