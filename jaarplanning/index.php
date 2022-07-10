<?php

//echo __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/vendor/autoload.php';

function getClient() {
	$client = new Google_Client();
	$client->setApplicationName('Google Sheets API');
	$client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
	$client->setAuthConfig('credentials.json');
	$client->setAccessType('offline');
	return $client;
}

function getSheetData() {
	$client = getClient();
	
	// configure the Sheets Service
	$service = new Google_Service_Sheets($client);
	$spreadsheetId = '1KHB1nyysY16GOI7VU0KKn3XLe7crvjHYdcQZIBj54mk';
	$range = 'Jaarplanning';

	$response = $service->spreadsheets_values->get($spreadsheetId, $range);

	$values = $response->getValues();

	if (!empty($values)) {
		echo "Er zitten waarden in!";

		return($values);
	}
	
}

function getSpreadSheetTabData($values) {

    $data = array();
    // $values = array();

    $col_week_number = 0;
    $col_week_description = 1;
    $col_date = 2;
    $col_day = 3;
    $col_whole_day = 4;
    $col_time_from = 5;
    $col_time_to = 6;
    $col_description = 7;
    $col_note = 8;
    $col_web = 11;

    if (!empty($values)) {
        $week_nr = false;
        $week_info_to_push = '';

        // fiil data array
        // foreach($values as $row => $cell){
        $teller = 0;
        foreach($values as $row => $regel){
            // eerste rij geeft de kolomkoppen
            if ($teller == 0) {
                echo "<h2>Kolomkoppen</h2>";
                echo "<p>" .  $teller . "</p>";
                $teller = $teller + 1;
                continue;
            }


            echo "<h2>Inhoud van array van een regel: $teller</h2><br/>";

            echo "<pre>";
            print_r($regel);
            echo "<pre/>";
            $aantalKolommenInRij = count($regel);

            // echo"Aantal kolommen in rij-".  $teller . ":" . $aantalKolommenInRij . "<br/>";
            
            // $xdebugBreak = xdebug_break();
            if($aantalKolommenInRij >= 1) {
                Echo "Rij heeft data. </br>";
                if( $regel[$col_week_number]) {
                    Echo "Weeknumer:" . $regel[$col_week_number] . "<br/>";
                }
            }
            
            

            foreach($regel as $index => $item){
                echo "<hr>" . "Kolom: $index" ."<hr>";
                echo "<pre>";
                print_r($item);
                echo "<pre/>";
                    
            }
            $teller = $teller + 1;
        }
      
    }
    
}


$waarden = getSheetData();

echo "De waarden die ik terug krijg van Google Sheets m.b.t. <br/>";
echo '<a href=https://docs.google.com/spreadsheets/d/1KHB1nyysY16GOI7VU0KKn3XLe7crvjHYdcQZIBj54mk/edit#gid=0 target=_blanc>Jaarplanner met ID: 1KHB1nyysY16GOI7VU0KKn3XLe7crvjHYdcQZIBj54mk</a>';
echo '<br/>';
echo "Het aantal rijen =" . count($waarden);
echo '<br/><br/>';

getSpreadSheetTabData($waarden);


?>