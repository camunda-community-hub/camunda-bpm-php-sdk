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

  /**
   * saves the bpmn diagram as file.
   *
   * @param $diagram
   * @param $savePath
   * @return string
   */
  public function saveAsFile($diagram, $savePath) {
    if(is_dir($savePath)) {
      $filePath = $savePath.'/'.$this->cleanFileName($diagram->id).'.bpmn';
    } else {
      $filePath = './'.$this->cleanFileName($diagram->id).'.bpmn';
    }

    $handle = fopen($filePath, 'c+');
    ftruncate($handle, filesize($filePath));
    fwrite($handle, $diagram->bpmn20Xml);
    fclose($handle);

    return $filePath;
  }

  /**
   * replaces the colon from the Definition ID with an underscore so that
   * windows can use this as filename
   *
   * @param $fileName
   * @return mixed
   */
  private function cleanFileName($fileName) {
    return preg_replace('/\:/', '_', $fileName);
  }
}