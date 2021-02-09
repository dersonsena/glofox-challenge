<?php

/** @var \Slim\App $app */
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->group('/', function (RouteCollectorProxyInterface $group) {
    $group->get('', function(Request $request, Response $response, array $args) {
        $response->getBody()->write(json_encode([
            'status' => 'success',
            'data' => [],
            'meta' => [],
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });
});
