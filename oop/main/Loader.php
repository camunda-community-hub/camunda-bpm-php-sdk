<?php
  include_once('entity/request/Request.php');
  include_once('entity/request/Credentials.php');
  include_once('entity/request/ExecutionRequest.php');
  include_once('entity/request/IdentityRequest.php');
  include_once('entity/request/MessageRequest.php');
  include_once('entity/request/MessageSubscriptionRequest.php');
  include_once('entity/request/ProcessDefinitionRequest.php');
  include_once('entity/request/ProcessInstanceRequest.php');
  include_once('entity/request/StatisticRequest.php');
  include_once('entity/request/TaskRequest.php');
  include_once('entity/request/VariableRequest.php');

  include_once('helper/CastHelper.php');
  include_once('helper/DiagramHelper.php');

  include_once('entity/response/Execution.php');
  include_once('entity/response/Identity.php');
  include_once('entity/response/Message.php');
  include_once('entity/response/MessageSubscription.php');
  include_once('entity/response/ProcessDefinition.php');
  include_once('entity/response/ProcessInstance.php');
  include_once('entity/response/Statistic.php');
  include_once('entity/response/Task.php');
  include_once('entity/response/Variable.php');

  
  include_once('service/RequestService.php');
  include_once('service/ExecutionService.php');
  include_once('service/IdentityService.php');
  include_once('service/MessageService.php');
  include_once('service/ProcessDefinitionService.php');
  include_once('service/ProcessEngineService.php');
  include_once('service/ProcessInstanceService.php');
  include_once('service/TaskService.php');
?>