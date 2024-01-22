<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MaintenanceSubscriber implements EventSubscriberInterface
{
   

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelController',
        ];
    }

    public function onKernelController(ResponseEvent $event): void
    {
        
     $response = $event->getResponse();
     $content = $response->getContent();
     $content = str_replace('<body>', '<body><div class="alert alert-danger">Maintenance prévue mardi 10 janvier à 17h00</div>', $content);
 
     $response->setContent($content);

 }
 
}
