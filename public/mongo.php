<pre>

<?php

require 'php/vendor/autoload.php';



$client = new MongoDB\Client("mongodb://localhost:27019");
$collection = $client->wekan->users;

//$result = $collection->find( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
$result = $collection->find()->toArray();

print_r($result);

//foreach ($result as $entry) {
//    echo $entry['_id'], ': ', $entry['name'], "\n";
//}


?>
</pre>
