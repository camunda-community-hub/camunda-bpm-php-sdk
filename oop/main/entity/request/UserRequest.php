<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 22.07.13
 * Time: 11:36
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class UserRequest extends Request {
  protected $id;
  protected $firstName;
  protected $firstNameLike;
  protected $lastName;
  protected $lastNameLike;
  protected $email;
  protected $emailLike;
  protected $memberOfGroup;
  protected $sortBy;
  protected $sortOrder;
  protected $firstResult;
  protected $maxResults;
  protected $password;
  protected $profile;
  protected $credentials;

  /**
   * @param mixed $email
   * @return $this
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param mixed $emailLike
   * @return $this
   */
  public function setEmailLike($emailLike) {
    $this->emailLike = $emailLike;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getEmailLike() {
    return $this->emailLike;
  }

  /**
   * @param mixed $firstName
   * @return $this
   */
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * @param mixed $firstNameLike
   * @return $this
   */
  public function setFirstNameLike($firstNameLike) {
    $this->firstNameLike = $firstNameLike;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFirstNameLike() {
    return $this->firstNameLike;
  }

  /**
   * @param mixed $firstResult
   * @return $this
   */
  public function setFirstResult($firstResult) {
    $this->firstResult = $firstResult;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFirstResult() {
    return $this->firstResult;
  }

  /**
   * @param mixed $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $lastName
   * @return $this
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * @param mixed $lastNameLike
   * @return $this
   */
  public function setLastNameLike($lastNameLike) {
    $this->lastNameLike = $lastNameLike;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getLastNameLike() {
    return $this->lastNameLike;
  }

  /**
   * @param mixed $maxResults
   * @return $this
   */
  public function setMaxResults($maxResults) {
    $this->maxResults = $maxResults;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMaxResults() {
    return $this->maxResults;
  }

  /**
   * @param mixed $memberOfGroup
   * @return $this
   */
  public function setMemberOfGroup($memberOfGroup) {
    $this->memberOfGroup = $memberOfGroup;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMemberOfGroup() {
    return $this->memberOfGroup;
  }

  /**
   * @param mixed $password
   * @return $this
   */
  public function setPassword($password) {
    $this->password = $password;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param mixed $sortBy
   * @return $this
   */
  public function setSortBy($sortBy) {
    $this->sortBy = $sortBy;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSortBy() {
    return $this->sortBy;
  }

  /**
   * @param mixed $sortOrder
   * @return $this
   */
  public function setSortOrder($sortOrder) {
    $this->sortOrder = $sortOrder;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSortOrder() {
    return $this->sortOrder;
  }

  /**
   * @param \org\camunda\php\sdk\entity\request\CredentialsRequest $credentials
   * @return $this
   */
  public function setCredentials(CredentialsRequest $credentials) {
    $this->credentials = $credentials;
    return $this;
  }

  /**
   * @return \org\camunda\php\sdk\entity\request\CredentialsRequest
   */
  public function getCredentials() {
    return $this->credentials;
  }

  /**
   * @param \org\camunda\php\sdk\entity\request\ProfileRequest $profile
   * @return $this
   */
  public function setProfile(ProfileRequest $profile) {
    $this->profile = $profile;
    return $this;
  }

  /**
   * @return \org\camunda\php\sdk\entity\request\ProfileRequest
   */
  public function getProfile() {
    return $this->profile;
  }
}