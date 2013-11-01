<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 31.10.13
 * Time: 07:46
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestJobService;
include('../../vendor/autoload.php');

class HistoryServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function getActivityInstances() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }
}
