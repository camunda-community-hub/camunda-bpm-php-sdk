<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 13.06.13
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\entity\request\TaskRequest;
use org\camunda\php\sdk\entity\response\Task;

class TaskService extends RequestService {

  public function getTask($id) {
    $task = new Task();
    $this->setRequestUrl('task/' . $id);
    $this->setRequestMethod('GET');
    $this->setRequestObject(null);

    return $task->cast($this->execute());
  }

  public function getTasks(TaskRequest $request, $isPostRequest = false) {
    $task = new Task();
    $this->setRequestUrl('/task/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    $prepare = $this->execute();
    $response = array();
    $i = 0;
    foreach($prepare AS $data) {
      $response['task_'.$i] = $task->cast($data);
      $i++;
    }
    return (object) $response;
  }

  public function getTaskCount(TaskRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/task/count/');
    $this->setRequestObject($request);
    if($isPostRequest == true) {
      $this->setRequestMethod('POST');
    } else {
      $this->setRequestMethod('GET');
    }

    return $this->execute()->count;
  }

  public function getFormKey($id) {
    $this->setRequestUrl('/task/'.$id.'/form');
    $this->setRequestMethod('GET');
    $this->setRequestObject(null);

    return $this->execute()->key;
  }

  public function claimTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/claim');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    $this->execute();
  }

  public function unclaimTask($id) {
    $this->setRequestUrl('/task/'.$id.'/unclaim');
    $this->setRequestMethod('POST');
    $this->setRequestObject(null);

    $this->execute();
  }

  public function completeTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/complete');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    $this->execute();
  }

  public function resolveTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/resolve');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    $this->execute();
  }

  public function delegateTask($id, TaskRequest $request) {
    $this->setRequestUrl('/task/'.$id.'/delegate');
    $this->setRequestObject($request);
    $this->setRequestMethod('POST');

    $this->execute();
  }
}