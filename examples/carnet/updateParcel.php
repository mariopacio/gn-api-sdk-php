<?php

require __DIR__.'/../../vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents(__DIR__.'/../config.json');
$options = json_decode($file, true);

$body = [
	'parcel' => 2,
	'expire_at' => '2018-01-01'
];

$params = [
	'id' => 0
];

try {
    $api = new Gerencianet($options);
    $carnet = $api->updateParcel($params, $body);

    print_r($carnet);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
