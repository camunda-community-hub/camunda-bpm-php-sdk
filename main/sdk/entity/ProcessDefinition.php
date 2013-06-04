<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.05.13
 * Time: 18:25
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity;

class ProcessDefinition extends Request {
  private $id;
  private $key;
  private $category;
  private $description;
  private $name;
  private $version;
  private $resource;
  private $deploymentId;
  private $diagram;
  private $suspend;

  public function setCategory($category) {
    $this->category = $category;
  }

  public function getCategory() {
    return $this->category;
  }

  public function setDeploymentId($deploymentId) {
    $this->deploymentId = $deploymentId;
  }

  public function getDeploymentId() {
    return $this->deploymentId;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDiagram($diagram) {
    $this->diagram = $diagram;
  }

  public function getDiagram() {
    return $this->diagram;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setKey($key) {
    $this->key = $key;
  }

  public function getKey() {
    return $this->key;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setResource($resource) {
    $this->resource = $resource;
  }

  public function getResource() {
    return $this->resource;
  }

  public function setSuspend($suspend) {
    $this->suspend = $suspend;
  }

  public function getSuspend() {
    return $this->suspend;
  }

  public function setVersion($version) {
    $this->version = $version;
  }

  public function getVersion() {
    return $this->version;
  }
}