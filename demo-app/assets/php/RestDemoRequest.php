<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 27.05.13
 * Time: 13:37
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\demo\php;


class RestDemoRequest {
  private $PATH = '../assets/json/';
  private $filename;

  public function __construct($filename) {
    $this->filename = $this->PATH."DemoData".$filename.".json";
  }

  public function getData() {
    return json_decode(file_get_contents($this->filename));
  }
}