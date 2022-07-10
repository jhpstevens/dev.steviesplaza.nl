<?php

//echo __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/vendor/autoload.php';


$client = new Google_Client();
$client->setApplicationName('Google Sheets API');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
$client->setAuthConfig('credentials.json');
$client->setAccessType('offline');



// configure the Sheets Service
$service = new Google_Service_Sheets($client);
$spreadsheetId = '1KHB1nyysY16GOI7VU0KKn3XLe7crvjHYdcQZIBj54mk';
$range = 'Jaarplanning';

$response = $service->spreadsheets_values->get($spreadsheetId, $range);

$values = $response->getValues();

if (!empty($values)) {
	echo "Er zitten waarden in!";
	print_r($values);
}


?>