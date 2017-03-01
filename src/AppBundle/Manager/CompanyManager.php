<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Company;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class CompanyManager
 */
class CompanyManager
{
    /** @var EntityRepository */
    private $companyRepository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->companyRepository = $entityManager->getRepository(Company::class);
    }
}
