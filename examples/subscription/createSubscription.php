<?php

require __DIR__.'/../../vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents(__DIR__.'/../config.json');
$options = json_decode($file, true);

$item_1 = [
	'name' => 'Item 1',
	'amount' => 1,
	'value' => 1000
];

$item_2 = [
	'name' => 'Item 2',
	'amount' => 2,
	'value' => 2000
];

$items = [
	$item_1,
	$item_2
];

$body = [
	'items' => $items
];

$params = [
	'id' => 0
];

try {
    $api = new Gerencianet($options);
    $subscription = $api->createSubscription($params, $body);

    print_r($subscription);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
