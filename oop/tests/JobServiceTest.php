<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.07.13
 * Time: 14:17
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\tests\TestJobService;
use org\camunda\php\sdk\entity\request\JobRequest;
use org\camunda\php\sdk\service\JobService;

include('../../vendor/autoload.php');

class JobServiceTest extends \PHPUnit_Framework_TestCase {
  protected static $restApi;

  public static function setUpBeforeClass() {
    self::$restApi = 'http://localhost:8080/engine-rest';
  }

  public static function tearDownAfterClass() {
    self::$restApi = null;
  }

  //--------------------------------  TEST GET SINGLE JOB  ----------------------------------------
  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function getSingleJob() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  //--------------------------------  TEST GET JOBS  ----------------------------------------
  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function getJobs() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  //--------------------------------  TEST GET JOBS COUNT  ----------------------------------------
  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function getJobCount() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  //--------------------------------  TEST SET JOB RETRIES  ----------------------------------------
  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function setJobRetries() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  //--------------------------------  TEST EXECUTE JOB  ----------------------------------------
  /**
   * TODO: prepare a better test-Environment than my local tomcat server :(
   * @test
   */
  public function executeJob() {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }
}
