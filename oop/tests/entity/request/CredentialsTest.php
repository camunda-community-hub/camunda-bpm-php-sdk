<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 24.06.13
 * Time: 16:43
 * To change this template use File | Settings | File Templates.
 */

use org\camunda\php\sdk\entity\request\Credentials;

include('main/entity/entity.request/Credentials.php');

class CredentialsTest extends PHPUnit_Framework_TestCase {
  public function testCredentialsWithParameters() {
    $parameterArray = array(
      'username'  => 'Stefan',
      'password'  => 'cam123',
      'apiKey'    => 'nvblsdjsalalkdsfjals'
    );

    $credentials = new Credentials($parameterArray);
    $this->assertEquals('Stefan', $credentials->getUsername());
    $this->assertEquals('cam123', $credentials->getPassword());
    $this->assertEquals('nvblsdjsalalkdsfjals', $credentials->getApiKey());
    unset($parameterArray);
    unset($credentials);
  }

  public function testCredentials() {
    $credentials = new Credentials();
    $credentials->setUsername('Stefan');
    $credentials->setPassword('cam123');
    $credentials->setApiKey('nvblsdjsalalkdsfjals');

    $this->assertEquals('Stefan', $credentials->getUsername());
    $this->assertEquals('cam123', $credentials->getPassword());
    $this->assertEquals('nvblsdjsalalkdsfjals', $credentials->getApiKey());
    unset($credentials);
  }
}
