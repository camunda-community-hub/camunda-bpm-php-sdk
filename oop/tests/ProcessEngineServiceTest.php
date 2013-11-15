<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 26.07.13
 * Time: 08:57
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;
use org\camunda\php\sdk\service\ProcessEngineService;

include('../../vendor/autoload.php');

class ProcessEngineServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;
  protected static $pes;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
    print("\n\nCLASS: " . __CLASS__ . "\n");
    self::$pes = new ProcessEngineService(self::$restApi);
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET ENGINE NAMES  ----------------------------------------
  /**
   * @test
   */
  public function getEngineNames() {
    $this->assertEquals('default', self::$pes->getEngineNames()->engine_0->name);
  }
}
