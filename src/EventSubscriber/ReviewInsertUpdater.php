<?php

namespace App\EventListener;

use App\Entity\Review;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Review::class)]
class ReviewInsertUpdater
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function postPersist(Review $review, PostPersistEventArgs $event): void
    {
        // ... do something to notify the changes
    }
}