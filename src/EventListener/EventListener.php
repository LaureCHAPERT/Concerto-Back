<?php

namespace App\EventListener;

use App\Entity\Event;
use App\Service\MySlugger;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EventListener
{
    private $mySlugger;

    public function __construct(MySlugger $mySlugger)
    {
        $this->mySlugger = $mySlugger;
    }
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function updateSlug(Event $event, LifecycleEventArgs $eventArgs): void
    {
        // On slugifie le titre
        $event->setSlug($this->mySlugger->slugify($event->getName()));
    }
}
