<?php
	header('Content-type: application/xml');
	require_once('../../procedural/camundaRestClient.php');
	use org\camunda\php\sdk\camundaRestClient;

	// TODO: define your camunda BPM Url, e.g. locahost:8080
	$camundaUrl = '';

 	$rssfeed = '<?xml version="1.0" encoding="utf-8"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>camunda Tasklist</title>';
    $rssfeed .= '<link>' . $camundaUrl . '/camunda/app/tasklist</link>';
    $rssfeed .= '<description>My personal camunda Tasklist</description>';
    $rssfeed .= '<language>en-us</language>';

	$camunda = new camundaRestClient($camundaUrl . '/engine-rest');
	$taskQueryParams;
	// Get assignee whose tasks should be provided (get all tasks if no assignee is defined)
	if (isset($_GET['assignee'])) {
		$assignee = $_GET['assignee'];
		$taskQueryParams = array ( 'assignee' => $assignee);
	}
	
	foreach($camunda->getTasks($taskQueryParams) AS $data) {
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $data->name . '</title>';
        $rssfeed .= '<description>Assignee: ' . $data->assignee . ' | Process: ' . $camunda->getSingleProcessDefinition($data->processDefinitionId)->name . '</description>';
        $rssfeed .= '<link>' . $camundaUrl . '/camunda/app/tasklist/default/#/task/' . $data->id . '</link>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($data->created)) . '</pubDate>';
        $rssfeed .= '</item>';
    }
	
 	$rssfeed .= '</channel>';
    $rssfeed .= '</rss>';

    echo $rssfeed;
?>
