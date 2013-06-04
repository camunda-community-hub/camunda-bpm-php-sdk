<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 04.06.13
 * Time: 09:16
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity;


class Request {
  private $url;
  private $parameterList = array();

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setParameterList($parameterList) {
    $this->parameterList[] = $parameterList;
  }

  public function getParameterList() {
    return $this->parameterList;
  }

  public function addParameter($parameterName,$parameterValue) {
    $this->parameterList[$parameterName] = $parameterValue;
  }

  public function removeParameter($parameterName) {
    array_splice($this->parameterList, $parameterName, 1);
  }

  public function getParameter($parameterName) {
    return $this->parameterList[$parameterName];
  }
}