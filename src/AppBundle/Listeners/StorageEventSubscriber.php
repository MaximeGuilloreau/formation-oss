<?php

namespace AppBundle\Listeners;

use AppBundle\Events\StorageEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class StorageEventSubscriber
 */
class StorageEventSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            StorageEvent::PRE_CREATE => 'preCreate',
            StorageEvent::PRE_UPDATE => 'preUpdate',
            StorageEvent::POST_CREATE => 'postCreate',
            StorageEvent::POST_UPDATE => 'postUpdate',
        ];
    }

    /**
     * @param StorageEvent $event
     */
    public function preCreate(StorageEvent $event)
    {
        $object = $event->getObject();
    }

    /**
     * @param StorageEvent $event
     */
    public function preUpdate(StorageEvent $event)
    {
    }

    /**
     * @param StorageEvent $event
     */
    public function postCreate(StorageEvent $event)
    {
    }

    /**
     * @param StorageEvent $event
     */
    public function postUpdate(StorageEvent $event)
    {
    }
}
