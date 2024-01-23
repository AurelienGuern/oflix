<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    // le constructeur permet d'injecter des variables d'environnement
    public function __construct(
        private bool $isMaintenance,
        private string $maintenanceDate
    )
    {}
    public function onKernelResponse(ResponseEvent $event): void
    {
        // on n'affiche le message de maintenance que si une maintenance est prévue
        // Return Early Pattern
        if (!$this->isMaintenance) {
            return;
        }

        // Dans la réponse de l'event, le Content contient le html envoyé
        // C'est lui que l'on va manipuler
        $html = $event->getResponse()->getContent();

        // En utilisant str_replace(), remplacez la balise <body> par 
        // <body><div class="alert alert-danger">Maintenance prévue mardi 10 janvier à 17h00</div> dans cette chaine de caractère.

        // $newHtml = str_replace('<body>','<body><div class="alert alert-danger">Maintenance prévue ' . $this->maintenanceDate . '</div>',$html);

        $newHtml = str_replace('<body>','<body><div class="alert alert-danger">Maintenance prévue ' . $this->maintenanceDate . '</div>',$html);

        // Affectez le nouveau contenu à l'objet Response via la méthode appropriée.
        $event->getResponse()->setContent($newHtml);

    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
