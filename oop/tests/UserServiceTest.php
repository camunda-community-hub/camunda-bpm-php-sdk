<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.07.13
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestUserService;
use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\UserRequest;
use org\camunda\php\sdk\service\UserService;

include('../../vendor/autoload.php');


class UserServiceTest extends \PHPUnit_Framework_TestCase {
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
     $userService = new UserService(self::$restApi);

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
    $count = $userService->getCount(new UserRequest());
    $countFiltered = $userService->getCount($filteredUser);
    $userService->createUser($user);

    $this->assertEquals($count + 1, $userService->getCount(new UserRequest()));
    $this->assertEquals($countFiltered + 1, $userService->getCount($filteredUser));

    $userService->deleteUser('shentschel');

    
  }

  //--------------------------------  TEST DELETE USER  ----------------------------------------
  /**
   * @test
   */
  public function deleteUser() {
     $userService = new UserService(self::$restApi);

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

    $count = $userService->getCount(new UserRequest());
    $countFiltered = $userService->getCount($filteredUser);
    $userService->createUser($user);

    $this->assertEquals($count + 1, $userService->getCount(new UserRequest()));
    $this->assertEquals($countFiltered + 1, $userService->getCount($filteredUser));

    $userService->deleteUser('shentschel');

    $this->assertEquals($count, $userService->getCount(new UserRequest()));
    $this->assertEquals($filteredUser, $userService->getCount($filteredUser));

    
  }

  //--------------------------------  TEST GET USER PROFILE  ----------------------------------------
  /**
   * @test
   */
  public function getUserProfile() {
     $userService = new UserService(self::$restApi);

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

    $userService->createUser($user);

    $this->assertEquals('stefan', $userService->getProfile('shentschel')->getFirstName());

    $userService->deleteUser('shentschel');

    
  }

  //--------------------------------  TEST GET USERS  ----------------------------------------
  /**
   * @test
   */
  public function getUsers() {
     $userService = new UserService(self::$restApi);

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
    $userService->createUser($user);
    $this->assertEquals('shentschel', $userService->getUsers(new UserRequest())->user_0->getId());

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('jonny1')
                ->setFirstName('John')
                ->setLastName('Doe')
                ->setEmail('john.doe@who.com');
    $userCredentials->setPassword('1337-42-23');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    $userService->createUser($user);

    $this->assertEquals('jonny1', $userService->getUsers(new UserRequest())->user_0->getId());
    $this->assertEquals('shentschel', $userService->getUsers(new UserRequest())->user_1->getId());

    $this->assertEquals('shentschel', $userService->getUsers($filteredUser)->user_0->getId());
    $this->assertObjectNotHasAttribute('user_1', $userService->getUsers($filteredUser));

    $userService->deleteUser('shentschel');
    $userService->deleteUser('jonny1');

    
  }

  //--------------------------------  TEST GET USER COUNT  ----------------------------------------
  /**
   * @test
   */
  public function getUserCount() {
     $userService = new UserService(self::$restApi);

    $filteredUser = new UserRequest();
    $filteredUser->setFirstName('stefan');

    $count = $userService->getCount(new UserRequest());
    $countFiltered = $userService->getCount($filteredUser);

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    $userService->createUser($user);
    $this->assertEquals($count + 1, $userService->getCount(new UserRequest()));

    $user = new UserRequest();
    $userProfile = new ProfileRequest();
    $userCredentials = new CredentialsRequest();
    $userProfile->setId('jonny1')
                ->setFirstName('John')
                ->setLastName('Doe')
                ->setEmail('john.doe@who.com');
    $userCredentials->setPassword('1337-42-23');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    $userService->createUser($user);

    $this->assertEquals($count + 2, $userService->getCount(new UserRequest()));
    $this->assertEquals($countFiltered + 1, $userService->getCount($filteredUser));

    $userService->deleteUser('shentschel');
    $userService->deleteUser('jonny1');

    $this->assertEquals($count, $userService->getCount(new UserRequest()));

    
  }

  //--------------------------------  TEST UPDATE USER PROFILE  ----------------------------------------
  /**
   * @test
   */
  public function updateUserProfile() {
     $userService = new UserService(self::$restApi);

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
    $userService->createUser($user);

    $this->assertEquals('stefan', $userService->getProfile('shentschel')->getFirstName());

    $userProfile = new ProfileRequest();
    $userProfile->setId('shentschel')
                ->setFirstName('John')
                ->setLastName('Doe')
                ->setEmail('john.doe@who.com');
    $userService->updateProfile('shentschel', $userProfile);

    $this->assertEquals('John', $userService->getProfile('shentschel')->getFirstName());
    $userService->deleteUser('shentschel');
  }

  //--------------------------------  TEST UPDATE USER CREDENTIALS  ----------------------------------------
  /**
   * TODO: Create with authorisation
   * @test
   */
  /*public function testUpdateUserCredentials() {
     $userService = new UserService(self::$restApi);

    $filteredUser = new UserRequest();
    $filteredUser->setFirstName('stefan');

    $this->assertEquals(0, $userService->getCount(new UserRequest()));
    $user = new UserRequest();
    $userProfile = new Profile();
    $userCredentials = new Credentials();
    $userProfile->setId('shentschel')
                ->setFirstName('stefan')
                ->setLastName('hentschel')
                ->setEmail('stefan.hentschel@camunda.com');
    $userCredentials->setPassword('123456');
    $user->setProfile($userProfile)->setCredentials($userCredentials);
    $userService->createUser($user);

    $this->assertEquals('stefan', $userService->('shentschel')->getFirstName());

    $userCredentials = new UserRequest();
    $userCredentials->setPassword('haha');
    $userService->updateCredentials('shentschel', $userCredentials);

    $this->assertEquals('""', $userService->getProfile('shentschel')->getFirstName());

    $userService->deleteUser('shentschel');

    
  }*/
}
