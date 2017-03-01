<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Address;
use AppBundle\Repository\AddressRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class AddressManager
 */
class AddressManager
{
    /** @var AddressRepository */
    private $addressRepository;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->addressRepository = $em->getRepository(Address::class);
    }
}
