<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 13.06.13
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;
use Exception;
use org\camunda\php\sdk\entity\request\IdentityLinksRequest;
use org\camunda\php\sdk\entity\request\TaskRequest;
use org\camunda\php\sdk\entity\response\Form;
use org\camunda\php\sdk\entity\response\IdentityLink;
use org\camunda\php\sdk\entity\response\Task;

class TaskService extends RequestService {

  /**
   * Retrieves the task with the given ID
   *
   * @param String $id task id
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\Task $this requested task
   */
  public function getTask($id) {
    $task = new Task();
    $this->setRequestUrl('/task/' . $id);
    $this->setRequestMethod('GET');
    $this->setRequestObject(null);

    try {
      return $task->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves a list of tasks within given context
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-query
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-query
   *
   * @param TaskRequest $request filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return object list of all Tasks
   */
  public function getTasks(TaskRequest $request, $isPostRequest = false) {

    $this->setRequestUrl('/task/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      $prepare = $this->execute();
      $response = array();
      foreach ($prepare AS $index => $data) {
        $task = new Task();
        $response['task_' . $index] = $task->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the amount of tasks within given context
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-query-count
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-query-count
   *
   * @param TaskRequest $request filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return int Amount of tasks
   */
  public function getCount(TaskRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/task/count/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    try {
      return $this->execute()->count;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the form key of the given task
   * @link http://docs.camunda.org/api-references/rest/#!/task/get-form-key
   *
   * @param String $id task ID
   * @throws \Exception
   * @return Form start form object
   */
  public function getFormKey($id) {
    $form = new Form();
    $this->setRequestUrl('/task/'.$id.'/form');
    $this->setRequestMethod('GET');
    $this->setRequestObject(null);

    try {
      return $form->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Claims a task for a specific user
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-claim
   *
   * @param String $id task id
   * @param \org\camunda\php\sdk\entity\request\TaskRequest $request
   * @throws \Exception
   */
  public function claimTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/claim');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Unclaims a task
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-unclaim
   *
   * @param String $id task id
   * @throws \Exception
   */
  public function unclaimTask($id) {
    $this->setRequestUrl('/task/'.$id.'/unclaim');
    $this->setRequestMethod('POST');
    $this->setRequestObject(null);

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Completes a Task and updates process variables
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-complete
   *
   * @param String $id task ID
   * @param TaskRequest $request variable properties
   * @throws \Exception
   */
  public function completeTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/complete');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Resolves a task and update execution variables
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-resolve
   *
   * @param String $id task ID
   * @param TaskRequest $request variable properties
   * @throws \Exception
   */
  public function resolveTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/resolve');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Delegates a task to another user
   * @link http://docs.camunda.org/api-references/rest/#!/task/post-delegate
   *
   * @param String $id task ID
   * @param TaskRequest $request user properties
   * @throws \Exception
   */
  public function delegateTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/delegate');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Change the assignee of a task to a specific user.
   * @link http://docs.camunda.org/latest/api-references/rest/#task-set-assignee
   *
   * @param String $id Task ID
   * @param TaskRequest $request
   * @throws \Exception
   */
  public function setAssignee($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id. '/assignee');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

//  /**
//   *  Gets the identity links for a task, which are the users and groups that are in some relation to it
//   * (including assignee and owner).
//   * @link http://docs.camunda.org/latest/api-references/rest/#task-get-identity-links
//   *
//   * @param String $id task ID
//   * @param IdentityLinksRequest $request
//   * @throws \Exception
//   * @return IdentityLink $this
//   */
//  public function getIdentityLinks($id, IdentityLinksRequest $request) {
//    $identityLink = new IdentityLink();
//    $this->setRequestUrl('/task/'.$id.'/identity-links');
//    $this->setRequestObject($request);
//    $this->setRequestMethod('GET');
//
//    try {
//      return $identityLink->cast($this->execute());
//    } catch (Exception $e) {
//      throw $e;
//    }
//  }
//
//  /**
//   * Adds an identity link to a task. Can be used to link any user or group to a task and specify and relation.
//   * @link http://docs.camunda.org/latest/api-references/rest/#task-add-identity-link
//   *
//   * @param String $id task ID
//   * @param IdentityLinksRequest $request
//   * @throws \Exception
//   */
//  public function addIdentityLink($id, IdentityLinksRequest $request) {
//    $this->setRequestUrl('/task/'.$id.'/identity-links');
//    $this->setRequestObject($request);
//    $this->setRequestMethod('POST');
//
//    try {
//      $this->execute();
//    } catch (Exception $e) {
//      throw $e;
//    }
//  }
//
//  /**
//   * Removes an identity link from a task.
//   * @link http://docs.camunda.org/latest/api-references/rest/#task-delete-identity-link
//   *
//   * @param String $id task ID
//   * @param IdentityLinksRequest $request
//   * @throws \Exception
//   */
//  public function deleteIdentityLink($id, IdentityLinksRequest $request) {
//    $this->setRequestUrl('/task/'.$id.'/identity-links/delete');
//    $this->setRequestObject($request);
//    $this->setRequestMethod('POST');
//
//    try {
//      $this->execute();
//    } catch (Exception $e) {
//      throw $e;
//    }
//  }

  /**
   * Do a fast takeover of the task. So you don't need first to unclaim
   * a task before you can claim it
   *
   * @param String $id task ID
   * @param TaskRequest $request user properties
   * @throws \Exception
   * @deprecated Use setAssignee() instead
   */
  public function takeTask($id, TaskRequest $request) {
    try {
      $this->unclaimTask($id);
      $this->claimTask($id, $request);
    } catch (Exception $e) {
      throw $e;
    }
  }
}