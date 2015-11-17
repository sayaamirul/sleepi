<?php
// Sleepi's Routes

//Route with content negotiation and authorization
$app->get('/', 'Sleepi\Controller\TestController:indexAction')
    ->add(new \Sleepi\Middleware\NegotiationAuthMiddleware());

//Route with content negotiation
$app->post('/auth/register', 'Sleepi\Controller\AuthController:registerAction')
    ->add(new \Sleepi\Middleware\NegotiationMiddleware());