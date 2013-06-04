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
 * Time: 15:53
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\example\overview;


class RestRequest extends \org\camunda\php\sdk\camundaAPI {
  public function saveXmlAsFile($id) {
    $diagram = $this->getBpmnXml($id);
    $filename = '../assets/bpmn/'.$this->cleanFileName($diagram->id).'.bpmn';
    $handle = fopen($filename, 'c+');
    ftruncate($handle, filesize($filename));
    fwrite($handle, $diagram->bpmn20Xml);
    fclose($handle);
  }

  public function cleanFileName($fileName) {
    return preg_replace('/\:/','.', $fileName);
  }
}