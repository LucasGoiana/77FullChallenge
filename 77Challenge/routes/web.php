<?php


$router->get('/ping', function () use ($router) {
    $retorno['mensagem'] = "pong";
    return json_encode($retorno) ;
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('login', 'AuthController@login');
});


$router->group(['prefix' => 'api', 'middleware'=> 'auth'], function () use ($router) {
    $router->post('/simulate', ['uses' => 'SimulateController@run']);
});




