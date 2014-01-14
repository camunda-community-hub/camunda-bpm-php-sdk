<?php
	header('Content-type: application/xml');
    require_once('camunda-bpm-php-sdk/vendor/autoload.php');

    use org\camunda\php\sdk\Api;
    use org\camunda\php\sdk\entity\request\TaskRequest;	

	// TODO: define your camunda BPM Url
	$camundaUrl = '';

 	$rssfeed = '<?xml version="1.0" encoding="utf-8"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>camunda Tasklist</title>';
    $rssfeed .= '<link>' . $camundaUrl . '/camunda/app/tasklist</link>';
    $rssfeed .= '<description>My personal camunda Tasklist</description>';
    $rssfeed .= '<language>en-us</language>';

    $camundaAPI = new Api($camundaUrl . '/engine-rest');
    $taskRequest = new TaskRequest();

	// Get assignee whose tasks should be provided (get all tasks if no assignee is defined)
	if (isset($_GET['assignee'])) {
        $taskRequest->setAssignee ($_GET['assignee']);
	}
	
	foreach($camundaAPI->task->getTasks($taskRequest) AS $data) {
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $data->getName() . '</title>';
        $rssfeed .= '<description>Assignee: ' . $data->getAssignee() . ' | Process: ' . $camundaAPI->processDefinition->getDefinition($data->getProcessDefinitionId())->getName() . '</description>';
        $rssfeed .= '<link>' . $camundaUrl . '/camunda/app/tasklist/default/#/task/' . $data->getId() . '</link>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($data->getCreated())) . '</pubDate>';
        $rssfeed .= '</item>';
    }
 	$rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
    echo $rssfeed;
?>
