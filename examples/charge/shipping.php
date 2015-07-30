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

$items = [
	$item_1
];

$shipping_1 = [
	'name' => 'My Shipping',
	'value' => 2000
];

$shippings = [
	$shipping_1
];

$body = [
	'items' => $items,
	'shippings' => $shippings
];

try {
    $api = new Gerencianet($options);
    $charge = $api->createCharge([], $body);

    print_r($charge);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
