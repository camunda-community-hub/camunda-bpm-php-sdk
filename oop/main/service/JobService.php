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
use org\camunda\php\sdk\entity\request\JobRequest;
use org\camunda\php\sdk\entity\response\Job;

class JobService extends RequestService {

  /**
   * Retrieves a job with given id.
   * @link http://docs.camunda.org/api-references/rest/#!/job/get
   *
   * @param String $id Job ID
   * @throws \Exception
   * @return \org\camunda\php\sdk\entity\response\Job $this requested job
   */
  public function getJob($id) {
    $this->setRequestUrl('/job/'.$id);
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    $job = new Job();
    try {
      return $job->cast($this->execute());
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves a list of jobs
   * @link http://docs.camunda.org/api-references/rest/#!/job/get-query
   * @link http://docs.camunda.org/api-references/rest/#!/job/post-query
   *
   * @param JobRequest $request Filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return object List of available jobs
   */
  public function getJobs(JobRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/job');
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
        $job = new Job();
        $response['job_' . $index] = $job->cast($data);
      }
      return (object)$response;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the amount of jobs
   * @link http://docs.camunda.org/api-references/rest/#!/job/get-query-count
   * @link http://docs.camunda.org/api-references/rest/#!/job/post-query-count
   *
   * @param JobRequest $request Filter parameters
   * @param bool $isPostRequest switch for GET/POST request
   * @throws \Exception
   * @return int Amount of jobs
   */
  public function getCount(JobRequest $request, $isPostRequest = false) {
    $this->setRequestUrl('/job/count');
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
   * Sets the retries of the job to a given amount
   * @link http://docs.camunda.org/api-references/rest/#!/job/put-set-job-retries
   *
   * @param String $id job ID
   * @param JobRequest $request amount of retries
   * @throws \Exception
   */
  public function setRetries($id, JobRequest $request) {
    $this->setRequestUrl('/job/'.$id.'/retries');
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * executes the given job
   * @link http://docs.camunda.org/api-references/rest/#!/job/post-execute-job
   *
   * @param String $id job ID
   * @throws \Exception
   */
  public function executeJob($id) {
    $this->setRequestUrl('/job/'.$id.'/execute');
    $this->setRequestObject(null);
    $this->setRequestMethod('POST');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Retrieves the corresponding exception stacktrace to the passed job id.
   * Output will be in plain/text
   * @link http://docs.camunda.org/latest/api-references/rest/#job-get-exception-stacktrace
   *
   * @param String $id job ID
   * @throws \Exception
   * @return String
   */
  public function getExceptionStacktrace($id) {
    $this->setRequestUrl('job/'.$id.'/stacktrace');
    $this->setRequestObject(null);
    $this->setRequestMethod('GET');

    try {
      return $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Updates the due date of a job
   * @link http://docs.camunda.org/latest/api-references/rest/#job-set-job-due-date
   *
   * @param String $id job ID
   * @param JobRequest $request
   * @throws \Exception
   */
  public function setDueDate($id, JobRequest $request) {
    $this->setRequestUrl('/job/'.$id.'/duedate');
    $this->setRequestObject($request);
    $this->setRequestMethod('PUT');

    try {
      $this->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }
}