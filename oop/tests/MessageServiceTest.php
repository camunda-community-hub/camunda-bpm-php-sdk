<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.07.13
 * Time: 14:41
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests;

use org\camunda\php\sdk\service\MessageService;

include('../../vendor/autoload.php');

class MessageServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;
  protected static $ms;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
    print("\n\nCLASS: " . __CLASS__ . "\n");
    self::$ms = new MessageService(self::$restApi);
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST DELIVER MESSAGE  ----------------------------------------
  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function deliverMessage() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }
}
