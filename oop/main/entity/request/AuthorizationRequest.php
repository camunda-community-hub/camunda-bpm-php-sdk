<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 09:50
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;

class AuthorizationRequest extends Request
{
    protected $id;
    protected $type;
    protected $permissions;
    protected $userId;
    protected $userIdIn;
    protected $groupId;
    protected $groupIdIn;
    protected $resourceType;
    protected $resourceId;
    protected $sortBy;
    protected $sortOrder;
    protected $firstResult;
    protected $maxResults;

    protected $permissionName;
    protected $permissionValue;
    protected $resourceName;

    /**
     * @param mixed $firstResult
     */
    public function setFirstResult($firstResult)
    {
        $this->firstResult = $firstResult;
    }

    /**
     * @return mixed
     */
    public function getFirstResult()
    {
        return $this->firstResult;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupIdIn
     */
    public function setGroupIdIn($groupIdIn)
    {
        $this->groupIdIn = $groupIdIn;
    }

    /**
     * @return mixed
     */
    public function getGroupIdIn()
    {
        return $this->groupIdIn;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $maxResults
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
    }

    /**
     * @return mixed
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @param mixed $permissionName
     */
    public function setPermissionName($permissionName)
    {
        $this->permissionName = $permissionName;
    }

    /**
     * @return mixed
     */
    public function getPermissionName()
    {
        return $this->permissionName;
    }

    /**
     * @param mixed $permissionValue
     */
    public function setPermissionValue($permissionValue)
    {
        $this->permissionValue = $permissionValue;
    }

    /**
     * @return mixed
     */
    public function getPermissionValue()
    {
        return $this->permissionValue;
    }

    /**
     * @param mixed $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param mixed $resourceId
     */
    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @return mixed
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * @param mixed $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * @return mixed
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * @param mixed $resourceType
     */
    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;
    }

    /**
     * @return mixed
     */
    public function getResourceType()
    {
        return $this->resourceType;
    }

    /**
     * @param mixed $sortBy
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
    }

    /**
     * @return mixed
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * @param mixed $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userIdIn
     */
    public function setUserIdIn($userIdIn)
    {
        $this->userIdIn = $userIdIn;
    }

    /**
     * @return mixed
     */
    public function getUserIdIn()
    {
        return $this->userIdIn;
    }


}