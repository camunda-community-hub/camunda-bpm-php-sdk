<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 02.07.13
 * Time: 13:35
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\helper;

class DiagramHelper {

  public function saveAsFile($diagram, $savePath) {
    if(is_dir($savePath)) {
      $fileName = $savePath.'/'.$this->cleanFileName($diagram->id).'.bpmn';
    } else {
      $fileName = './'.$this->cleanFileName($diagram->id).'.bpmn';
    }

    $handle = fopen($fileName, 'c+');
    ftruncate($handle, filesize($fileName));
    fwrite($handle, $diagram->bpmn20Xml);
    fclose($handle);

    return $fileName;
  }

  private function cleanFileName($fileName) {
    return preg_replace('/\:/', '_', $fileName);
  }
}