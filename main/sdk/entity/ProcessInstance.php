<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.05.13
 * Time: 18:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity;


class ProcessInstance {
  private $links = array();
  private $id;
  private $definitionId;
  private $businessKey;
  private $ended;
  private $suspended;

  public function setLinks($links) {
    $this->links = $links;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setDefinitionId($definitionId) {
    $this->definitionId = $definitionId;
  }

  public function setBusinessKey($businessKey) {
    $this->businessKey = $businessKey;
  }

  public function setEnded($ended) {
    $this->ended = $ended;
  }

  public function setSuspended($suspended) {
    $this->suspended = $suspended;
  }

  public function getLinks() {
    return $this->links;
  }

  public function getId() {
    return $this->id;
  }

  public function getDefinitionId() {
    return $this->definitionId;
  }

  public function getBusinessKey() {
    return $this->businessKey;
  }

  public function getEnded() {
    return $this->ended;
  }
}