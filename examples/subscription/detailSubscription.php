<?php

require __DIR__.'/../../vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents(__DIR__.'/../config.json');
$options = json_decode($file, true);

$params = ['id' => 0];

try {
    $api = new Gerencianet($options);
    $subscription = $api->detailSubscription($params, []);

    print_r($subscription);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);1000
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}