<?php
// Routes

$app->get('/', 'Sleepi\Controller\TestController:indexAction')
    ->add(new \Sleepi\Middleware\NegotiationMiddleware());
