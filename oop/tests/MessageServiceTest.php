<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.07.13
 * Time: 14:41
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestMessageService;


class MessageServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
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
