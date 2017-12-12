<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\entity\request\JobRequest;
use org\camunda\php\sdk\entity\response\Job;

class JobService extends RequestService
{

    /**
     * Retrieves a job with given id.
     *
     * @link http://docs.camunda.org/api-references/rest/#!/job/get
     *
     * @param String $id Job ID
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\Job $this requested job
     */
    public function getJob(string $id): Job
    {
        $this->setRequestUrl('/job/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        $job = new Job();
        try {
            return $job->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves a list of jobs
     *
     * @link http://docs.camunda.org/api-references/rest/#!/job/get-query
     * @link http://docs.camunda.org/api-references/rest/#!/job/post-query
     *
     * @param JobRequest $request Filter parameters
     * @param bool       $isPostRequest switch for GET/POST request
     * @throws CamundaApiException
     * @return Job[]
     */
    public function getJobs(JobRequest $request, bool $isPostRequest = false): array
    {
        $this->setRequestUrl('/job');
        $this->setRequestObject($request);
        if ($isPostRequest == true) {
            $this->setRequestMethod('POST');
        } else {
            $this->setRequestMethod('GET');
        }

        try {
            $prepare = $this->execute();
            $response = [];

            foreach ($prepare as $index => $data) {
                $job = new Job();
                $response[$index] = $job->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the amount of jobs
     *
     * @link http://docs.camunda.org/api-references/rest/#!/job/get-query-count
     * @link http://docs.camunda.org/api-references/rest/#!/job/post-query-count
     *
     * @param JobRequest $request Filter parameters
     * @param bool       $isPostRequest switch for GET/POST request
     * @throws CamundaApiException
     * @return int Amount of jobs
     */
    public function getCount(JobRequest $request, bool $isPostRequest = false): int
    {
        $this->setRequestUrl('/job/count');
        $this->setRequestObject($request);
        if ($isPostRequest == true) {
            $this->setRequestMethod('POST');
        } else {
            $this->setRequestMethod('GET');
        }

        try {
            return $this->execute()->count;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Sets the retries of the job to a given amount
     *
     * @link http://docs.camunda.org/api-references/rest/#!/job/put-set-job-retries
     *
     * @param String     $id job ID
     * @param JobRequest $request amount of retries
     * @throws CamundaApiException
     */
    public function setRetries(string $id, JobRequest $request): void
    {
        $this->setRequestUrl('/job/' . $id . '/retries');
        $this->setRequestObject($request);
        $this->setRequestMethod('PUT');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * executes the given job
     *
     * @link http://docs.camunda.org/api-references/rest/#!/job/post-execute-job
     *
     * @param String $id job ID
     * @throws CamundaApiException
     */
    public function executeJob(string $id): void
    {
        $this->setRequestUrl('/job/' . $id . '/execute');
        $this->setRequestObject(null);
        $this->setRequestMethod('POST');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves the corresponding exception stacktrace to the passed job id.
     * Output will be in plain/text
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#job-get-exception-stacktrace
     *
     * @param String $id job ID
     * @throws CamundaApiException
     * @return String
     */
    public function getExceptionStacktrace(string $id): string
    {
        $this->setRequestUrl('job/' . $id . '/stacktrace');
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Updates the due date of a job
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#job-set-job-due-date
     *
     * @param String     $id job ID
     * @param JobRequest $request
     * @throws CamundaApiException
     */
    public function setDueDate(string $id, JobRequest $request): void
    {
        $this->setRequestUrl('/job/' . $id . '/duedate');
        $this->setRequestObject($request);
        $this->setRequestMethod('PUT');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}