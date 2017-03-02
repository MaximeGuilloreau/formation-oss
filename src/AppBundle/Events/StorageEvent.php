<?php

namespace AppBundle\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class StorageEvent
 */
class StorageEvent extends Event
{
    const PRE_CREATE = 'storage.pre_create';

    const PRE_UPDATE = 'storage.pre_update';

    const POST_CREATE = 'storage.post_create';

    const POST_UPDATE = 'storage.post_update';

    /**
     * @var mixed
     */
    private $object;

    /**
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }
}
