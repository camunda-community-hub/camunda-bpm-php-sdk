<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 08:46
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\service;

use org\camunda\php\sdk\exception\CamundaApiException;
use org\camunda\php\sdk\entity\request\AuthorizationRequest;
use org\camunda\php\sdk\entity\response\Authorization;
use org\camunda\php\sdk\entity\response\ResourceOption;

class AuthorizationService extends RequestService
{

    /**
     * Removes an authorization by id
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-delete-authorization
     *
     * @param String $id authorization ID
     * @throws CamundaApiException
     */
    public function deleteAuthorization(string $id)
    {
        $this->setRequestUrl('/authorization/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('DELETE');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Retrieves a single authorization by id.
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-get-single-authorization
     *
     * @param String $id authorization ID
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\Authorization $this requested authorization
     */
    public function getAuthorization(string $id): Authorization
    {
        $authorization = new Authorization();
        $this->setRequestUrl('/authorization/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('GET');

        try {
            return $authorization->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Performs an authorization check for the currently authenticated user.
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-perform-an-authorization-check
     *
     * @param AuthorizationRequest $request
     * @throws CamundaApiException
     * @return Authorization
     */
    public function checkAuthorization(AuthorizationRequest $request): Authorization
    {
        $checkerArray = [
            0 => 'permissionName',
            1 => 'permissionValue',
            2 => 'resourceName',
            3 => 'resourceType',
        ];

        // Checker for required variables
        foreach ($checkerArray as $value) {
            if (isset($request[$value]) && ($request[$value] != null || $request[$value] != '')) {
                continue;
            } else {
                throw new CamundaApiException("Missing required Variables! See documentation for right syntax.");
            }
        }

        $authorization = new Authorization();
        $this->setRequestUrl('/authorization/check');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            return $authorization->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Query for a list of authorizations using a list of parameters. The size of the result set can be retrieved by
     * using the get authorization count method.
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-get-authorizations
     *
     * @param AuthorizationRequest $request
     * @throws CamundaApiException
     * @return Authorization[]
     */
    public function getAuthorizations(AuthorizationRequest $request): array
    {
        $this->setRequestUrl('/authorization');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            $prepare = $this->execute();
            $response = [];
            foreach ($prepare as $index => $data) {
                $authorization = new Authorization();
                $response[$index] = $authorization->cast($data);
            }
            return $response;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Query for authorizations using a list of parameters and retrieves the count.
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-get-authorizations-count
     *
     * @param AuthorizationRequest $request
     * @throws CamundaApiException
     * @return Integer $this count of authorizations
     */
    public function getCount(AuthorizationRequest $request): int
    {
        $this->setRequestUrl('/authorization/count');
        $this->setRequestObject($request);
        $this->setRequestMethod('GET');

        try {
            return $this->execute()->count;
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Allows checking for the set of available operations that the currently authenticated user can perform.
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-authorization-resource-options
     *
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ResourceOption
     */
    public function getResourceOption(): ResourceOption
    {
        $resourceOptions = new ResourceOption();
        $this->setRequestUrl('/authorization');
        $this->setRequestObject(null);
        $this->setRequestMethod('OPTIONS');

        try {
            return $resourceOptions->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }


    /**
     * Allows checking for the set of available operations that the currently authenticated user can perform.
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-authorization-resource-options
     *
     * @param String $id authorization ID
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\ResourceOption
     */
    public function getResourceInstanceOption($id): ResourceOption
    {
        $resourceOptions = new ResourceOption();
        $this->setRequestUrl('/authorization/' . $id);
        $this->setRequestObject(null);
        $this->setRequestMethod('OPTIONS');

        try {
            return $resourceOptions->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Creates a new authorization
     * @Link http://docs.camunda.org/latest/api-references/rest/#authorization-create-a-new-authorization
     *
     * @param AuthorizationRequest $request
     * @throws CamundaApiException
     * @return \org\camunda\php\sdk\entity\response\Authorization
     */
    public function createAuthorization(AuthorizationRequest $request): Authorization
    {
        $authorization = new Authorization();
        $this->setRequestUrl('/authorization/create');
        $this->setRequestObject($request);
        $this->setRequestMethod('POST');

        try {
            return $authorization->cast($this->execute());
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }

    /**
     * Updates a single authorization.
     *
     * @link http://docs.camunda.org/latest/api-references/rest/#authorization-update-a-single-authorization
     *
     * @param                      $id
     * @param AuthorizationRequest $request
     * @throws CamundaApiException
     */
    public function updateAuthorization($id, AuthorizationRequest $request): void
    {
        $this->setRequestUrl('/authorization/' . $id);
        $this->setRequestObject($request);
        $this->setRequestMethod('PUT');

        try {
            $this->execute();
        } catch (CamundaApiException $e) {
            throw $e;
        }
    }
}