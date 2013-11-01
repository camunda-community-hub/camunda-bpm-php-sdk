<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use Exception;
use org\camunda\php\sdk\entity\request\CredentialsRequest;
use org\camunda\php\sdk\entity\request\ProfileRequest;
use org\camunda\php\sdk\entity\request\UserRequest;
use org\camunda\php\sdk\entity\response\ResourceOption;
use org\camunda\php\sdk\entity\response\User;

class UserService extends RequestService {

  /**
   * Create a new user
   * @link http://docs.camunda.org/api-references/rest/#!/user/post-create
   *
   * @param UserRequest $request user properties
   * @throws \Exception
   */
  public function createUser(UserRequest $request) {
    $this->setRequestUrl('/user/create');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Removes a User
   * @link http://docs.camunda.org/api-references/rest/#!/user/delete
   *
   * @param String $id user ID
   * @throws \Exception
   */
  public function deleteUser($id) {
    $this->setRequestUrl('/user/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the profile of a given user
   * @link http://docs.camunda.org/api-references/rest/#!/user/get
   *
   * @param String $id user ID
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\User $this requested profile
   */
  public function getProfile($id) {
    $this->setRequestUrl('/user/'.$id.'/profile');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    $user = new User();
    try {
      return $user->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves a list of users within a given context
   * @link http://docs.camunda.org/api-references/rest/#!/user/get-query
   *
   * @param UserRequest $request filter parameters
   * @throws \Exception
   * @return object list of requested users
   */
  public function getUsers(UserRequest $request) {
    $this->setRequestUrl('/user/');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $user = new User();
        $response['user_' . $index] = $user->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the amount of users within a given context
   * @link http://docs.camunda.org/api-references/rest/#!/user/get-query-count
   *
   * @param UserRequest $request filter parameters
   * @throws \Exception
   * @return int Amount of users
   */
  public function getCount(UserRequest $request) {
    $this->setRequestUrl('/user/count');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Updates the profile of a given user
   * @link http://docs.camunda.org/api-references/rest/#!/user/put-update-profile
   *
   * @param String $id user ID
   * @param ProfileRequest $request user properties
   * @throws \Exception
   */
  public function updateProfile($id, ProfileRequest $request){
    $this->setRequestUrl('/user/'.$id.'/profile');
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * update credentials of a single user
   * @link http://docs.camunda.org/api-references/rest/#!/user/put-update-credentials
   *
   * @param String $id user ID
   * @param CredentialsRequest $request credential properties
   * @throws \Exception
   */
  public function updateCredentials($id, CredentialsRequest $request) {
    $this->setRequestUrl('/user/'.$id.'/credentials');
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * allows checking for the set of available operations that the currently authenticated user can perform on the user
   * resource
   * @link http://docs.camunda.org/latest/api-references/rest/#user-user-resource-options
   *
   * @throws \Exception
   * @return ResourceOption $this
   */
  public function getResourceOption() {
    $resourceOption = new ResourceOption();
    $this->setRequestUrl('/user');
    $this->setRequestObject(null);
    $this->setRequestMethod('OPTIONS');

    try {
      return $resourceOption->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * allows checking for the set of available operations that the currently authenticated user can perform on the user
   * resource
   * @link http://docs.camunda.org/latest/api-references/rest/#user-user-resource-options
   *
   * @param String $id user ID
   * @throws \Exception
   * @return ResourceOption $this
   */
  public function getResourceInstanceOption($id) {
    $requestOption = new ResourceOption();
    $this->setRequestUrl('/user/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('OPTIONS');

    try {
      return $requestOption->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }
}