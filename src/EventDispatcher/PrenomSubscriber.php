<?php

namespace App\EventDispatcher;

;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PrenomSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return[
            'kernel.request' => 'addPrenomToAttributes',
            'kernel.controller' => 'test1',
            'kernel.response' => 'test2'
        ];
    }
    Public function addPrenomToAttributes(RequestEvent $requestEvent)
    {
        $requestEvent->getRequest()->attributes->set('prenom', 'Lior');
    }

    public function test1()
    {

    }

    public function test2()
    {

    }    
}