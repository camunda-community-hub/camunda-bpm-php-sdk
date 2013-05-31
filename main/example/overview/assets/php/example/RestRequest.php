<?php
/**
 * Copyright 2013 camunda services GmbH
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 *limitations under the License.
 *
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 27.05.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\example\overview;


class RestRequest {
  private $PATH = '../assets/json/';
  private $filename;

  /**
   * not used in example data because we load static json files ;D
   *
   * @param String $restString REST API url
   */
  public function __construct($restString) {
  }

  public function getProcessInstances() {
    $this->loadExampleFile('ProcessInstances');
    return json_decode(file_get_contents($this->filename));
  }

  public function getProcessInstanceCount() {
    $this->loadExampleFile('ProcessInstanceCount');
    return json_decode(file_get_contents($this->filename));
  }

  public function getProcessDefinitions() {
    $this->loadExampleFile('ProcessDefinitions');
    return json_decode(file_get_contents($this->filename));
  }

  public function getProcessDefinitionCount() {
    $this->loadExampleFile('ProcessDefinitionCount');
    return json_decode(file_get_contents($this->filename));
  }

  public function getTasks() {
    $this->loadExampleFile('Tasks');
    return json_decode(file_get_contents($this->filename));
  }

  public function getTaskCount() {
    $this->loadExampleFile('TaskCount');
    return json_decode(file_get_contents($this->filename));
  }

  public function getSingleProcessDefinition($id) {
    $this->loadExampleFile('SingleProcessDefinition');
    return json_decode(file_get_contents($this->filename));
  }

  public function getBpmnXml($id) {
    $this->loadExampleFile('ProcessXml');
    return json_decode(file_get_contents($this->filename));
  }

  /**
   * In this Example we will not start a new process instance because I'm to lazy to build the logic
   * for data insertion into the example data files. If you want to fully prove this example - use our
   * prepackaged distribution and check with the default settings (don't forget to change the config for
   * isDemo to 'false'!
   *
   * @param String $id Process Definition ID
   */
  public function startProcessInstance($id) {
  }

  public function saveXmlAsFile($id) {
    $diagram = $this->getBpmnXml($id);
    $filename = '../assets/bpmn/example/'.$this->cleanFileName($diagram->id).'.bpmn';
    $handle = fopen($filename, 'c+');
    ftruncate($handle, filesize($filename));
    fwrite($handle, $diagram->bpmn20Xml);
    fclose($handle);
  }

  public function cleanFileName($fileName) {
    return preg_replace('/\:/','.', $fileName);
  }

  private function loadExampleFile($exampleFile) {
    $this->filename = $this->PATH.'ExampleData_'.$exampleFile.'.json';
  }

}