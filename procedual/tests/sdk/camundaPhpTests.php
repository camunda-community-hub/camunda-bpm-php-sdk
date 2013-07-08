<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.05.13
 * Time: 16:36
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\sdk;

class camundaPhpTests {

  public function testRestApi() {
    file_get_contents('http://localhost:8080/engine-rest/task');
  }
}