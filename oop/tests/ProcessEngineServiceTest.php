<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.07.13
 * Time: 08:57
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestProcessEngineService;
use org\camunda\php\sdk\service\ProcessEngineService;

include('../../vendor/autoload.php');

class ProcessEngineServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET ENGINE NAMES  ----------------------------------------
  /**
   * @test
   */
  public function getEngineNames() {
    $pes = new ProcessEngineService(self::$restApi);
    $this->assertEquals('default', $pes->getEngineNames()->engine_0->name);
  }
}
