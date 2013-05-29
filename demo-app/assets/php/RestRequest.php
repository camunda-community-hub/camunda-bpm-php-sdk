<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 27.05.13
 * Time: 15:53
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\demo\php;


class RestRequest extends \org\camunda\demo\php\library\camundaPHP {
  public function saveXmlAsFile($id) {
    $diagram = $this->getBpmnXml($id);
    $filename = "../assets/bpmn/".$this->cleanFileName($diagram->id).".bpmn";
    $handle = fopen($filename, "c+");
    ftruncate($handle, filesize($filename));
    fwrite($handle, $diagram->bpmn20Xml);
    fclose($handle);
  }

  public function cleanFileName($fileName) {
    return preg_replace('/\:/','.', $fileName);
  }
}