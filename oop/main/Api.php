<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 25.06.13
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk;

use org\camunda\php\sdk\service\TaskService;
use org\camunda\php\sdk\service\ExecutionService;
use org\camunda\php\sdk\service\IdentityService;
use org\camunda\php\sdk\service\MessageService;
use org\camunda\php\sdk\service\ProcessDefinitionService;
use org\camunda\php\sdk\service\ProcessInstanceService;
use org\camunda\php\sdk\helper\DiagramHelper;


class Api {
  // SERVICES
  public $task;
  public $execution;
  public $identity;
  public $message;
  public $processDefinition;
  public $processInstance;
  public $diagram;

  // CONFIG
  private $restApiUrl = 'http://localhost:8080/engine-rest/';

  public function __construct($restApiUrl = null) {
    if($restApiUrl != null) {
      $this->restApiUrl = $restApiUrl;
    }

    $this->task               = new TaskService($this->restApiUrl);
    $this->execution          = new ExecutionService($this->restApiUrl);
    $this->identity           = new IdentityService($this->restApiUrl);
    $this->message            = new MessageService($this->restApiUrl);
    $this->processDefinition  = new ProcessDefinitionService($this->restApiUrl);
    $this->processInstance    = new ProcessInstanceService($this->restApiUrl);
    $this->diagram            = new DiagramHelper($this->restApiUrl);
  }
}