<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 30.10.13
 * Time: 09:55
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\response;


use org\camunda\php\sdk\helper\CastHelper;

class Authorization extends CastHelper {
  protected $id;
  protected $type;
  protected $permissions;
  protected $userId;
  protected $groupId;
  protected $resourceType;
  protected $resourceId;
  protected $links;
  protected $count;

  protected $permissionName;
  protected $resourceName;
  protected $isAuthorized;

  /**
   * @param mixed $count
   */
  public function setCount($count) {
    $this->count = $count;
  }

  /**
   * @return mixed
   */
  public function getCount() {
    return $this->count;
  }

  /**
   * @param mixed $groupId
   */
  public function setGroupId($groupId) {
    $this->groupId = $groupId;
  }

  /**
   * @return mixed
   */
  public function getGroupId() {
    return $this->groupId;
  }

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $isAuthorized
   */
  public function setIsAuthorized($isAuthorized) {
    $this->isAuthorized = $isAuthorized;
  }

  /**
   * @return mixed
   */
  public function getIsAuthorized() {
    return $this->isAuthorized;
  }

  /**
   * @param mixed $links
   */
  public function setLinks($links) {
    $this->links = $links;
  }

  /**
   * @return mixed
   */
  public function getLinks() {
    return $this->links;
  }

  /**
   * @param mixed $permissionName
   */
  public function setPermissionName($permissionName) {
    $this->permissionName = $permissionName;
  }

  /**
   * @return mixed
   */
  public function getPermissionName() {
    return $this->permissionName;
  }

  /**
   * @param mixed $permissions
   */
  public function setPermissions($permissions) {
    $this->permissions = $permissions;
  }

  /**
   * @return mixed
   */
  public function getPermissions() {
    return $this->permissions;
  }

  /**
   * @param mixed $resourceId
   */
  public function setResourceId($resourceId) {
    $this->resourceId = $resourceId;
  }

  /**
   * @return mixed
   */
  public function getResourceId() {
    return $this->resourceId;
  }

  /**
   * @param mixed $resourceName
   */
  public function setResourceName($resourceName) {
    $this->resourceName = $resourceName;
  }

  /**
   * @return mixed
   */
  public function getResourceName() {
    return $this->resourceName;
  }

  /**
   * @param mixed $resourceType
   */
  public function setResourceType($resourceType) {
    $this->resourceType = $resourceType;
  }

  /**
   * @return mixed
   */
  public function getResourceType() {
    return $this->resourceType;
  }

  /**
   * @param mixed $type
   */
  public function setType($type) {
    $this->type = $type;
  }

  /**
   * @return mixed
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param mixed $userId
   */
  public function setUserId($userId) {
    $this->userId = $userId;
  }

  /**
   * @return mixed
   */
  public function getUserId() {
    return $this->userId;
  }



}