<?php

$c = $app->getContainer();

$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $c['response']
            ->withStatus(500)
             ->withHeader('Content-Type', 'application/json')
             ->write(json_encode([
                'status_code' => 500,
                'status_message' => 'Something wrong!',
            ]));
    };
};

$c['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $c['response']
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode([
                'status_code' => 405,
                'status_message' => 'Method must be one of: ' . implode(', ', $methods)
            ]));
    };
};

$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode([
                'status_code' => 404,
                'status_message' => 'Not Found',
            ]));
    };
};
