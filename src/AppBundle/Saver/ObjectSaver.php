<?php

namespace AppBundle\Saver;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ObjectSaver
 */
class ObjectSaver
{
    /** @var ObjectManager */
    private $manager;

    /**
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->manager = $em;
    }

    /**
     * @param mixed $object
     */
    public function save($object)
    {
    }
}
