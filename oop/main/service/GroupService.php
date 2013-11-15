<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use Exception;
use org\camunda\php\sdk\entity\request\GroupRequest;
use org\camunda\php\sdk\entity\response\Group;
use org\camunda\php\sdk\entity\response\ResourceOption;

class GroupService extends RequestService {

  /**
   * Create a new group
   * @link http://docs.camunda.org/api-references/rest/#!/group/post-create
   *
   * @param GroupRequest $request request body
   * @throws \Exception
   */
  public function createGroup(GroupRequest $request) {
    $this->setRequestUrl('/group/create');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Add a member to a group.
   * @link http://docs.camunda.org/api-references/rest/#!/group/members/put
   *
   * @param String $id Group ID
   * @param String $userId User ID
   * @throws \Exception
   */
  public function addMember($id, $userId) {
    $this->setRequestUrl('/group/'.$id.'/members/'.$userId);
    $this->setRequestObject(null);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Removes the group with given ID
   * @link http://docs.camunda.org/api-references/rest/#!/group/delete
   *
   * @param String $id Group ID
   * @throws \Exception
   */
  public function deleteGroup($id) {
    $this->setRequestUrl('/group/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Revokes the membership of a group
   * @link http://docs.camunda.org/api-references/rest/#!/group/members/delete
   *
   * @param String $id Group ID
   * @param String $userId Member ID
   * @throws \Exception
   */
  public function removeMember($id, $userId) {
    $this->setRequestUrl('/group/'.$id.'/members/'.$userId);
    $this->setRequestObject(null);
    $this->setRequestMethod('DELETE');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves a group with given id
   * @link http://docs.camunda.org/api-references/rest/#!/group/get
   *
   * @param String $id Group ID
   * @throws \Exception
   * @return Group $this Requested group
   */
  public function getGroup($id) {
    $this->setRequestUrl('/group/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    $group = new Group();
    try {
      return $group->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves a list of all groups within the given context
   * @link http://docs.camunda.org/api-references/rest/#!/group/get-query
   *
   * @param GroupRequest $request Filter parameters
   * @throws \Exception
   * @return object List of groups
   */
  public function getGroups(GroupRequest $request) {
    $this->setRequestUrl('/group/');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      $prepare = $this->execute();
      $response = array();
      foreach($prepare AS $index => $data) {
        $group = new Group();
        $response['group_'.$index] = $group->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the amount of Groups within the given context.
   * @link http://docs.camunda.org/api-references/rest/#!/group/get-query-count
   *
   * @param GroupRequest $request Filter parameters
   * @throws \Exception
   * @return int Amount of groups
   */
  public function getCount(GroupRequest $request) {
    $this->setRequestUrl('/group/count');
    $this->setRequestObject($request);
    $this->setRequestMethod('GET');

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Updates an existing group.
   * @link http://docs.camunda.org/api-references/rest/#!/group/put-update
   *
   * @param String $id  Group Id
   * @param GroupRequest $request update parameters
   * @throws \Exception
   */
  public function updateGroup($id, GroupRequest $request) {
    $this->setRequestUrl('/group/'.$id);
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * allows checking for the set of available operations that the currently authenticated user can perform on the
   * resource
   * @link http://docs.camunda.org/latest/api-references/rest/#group-group-resource-options
   *
   * @throws \Exception
   * @return ResourceOption $this
   */
  public function getResourceOption() {
    $resourceOption = new ResourceOption();
    $this->setRequestUrl('/group');
    $this->setRequestObject(null);
    $this->setRequestMethod('OPTIONS');

    try {
      return $resourceOption->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * allows checking for the set of available operations that the currently authenticated user can perform on the
   * resource
   * @link http://docs.camunda.org/latest/api-references/rest/#group-group-resource-options
   *
   * @param String $id group ID
   * @throws \Exception
   * @return ResourceOption $this
   */
  public function getResourceInstanceOption($id) {
    $resourceOption = new ResourceOption();
    $this->setRequestUrl('/group/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('OPTIONS');

    try {
      return $resourceOption->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }
}