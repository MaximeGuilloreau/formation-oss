<?php

namespace AppBundle\Saver;

use AppBundle\Events\StorageEvent;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ObjectSaver
 */
class ObjectSaver
{
    /** @var ObjectManager */
    private $manager;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param ObjectManager            $em
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ObjectManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->manager = $em;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param mixed $object
     */
    public function save($object)
    {
        $isNew = $object->getId() === null;
        $eventName = $isNew ? StorageEvent::PRE_CREATE : StorageEvent::PRE_UPDATE;

        $this->eventDispatcher->dispatch($eventName, new StorageEvent($object));

        $this->manager->persist($object);
        $this->manager->flush();

        $eventName = $isNew ? StorageEvent::POST_CREATE : StorageEvent::POST_UPDATE;

        $this->eventDispatcher->dispatch($eventName, new StorageEvent($object));
    }
}
