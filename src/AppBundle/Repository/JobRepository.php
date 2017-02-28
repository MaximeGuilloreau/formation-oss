<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class JobRepository
 */
class JobRepository extends EntityRepository
{
    /**
     * @param array $options
     * @return ArrayCollection
     */
    public function search(array $options = [])
    {
        $qb = $this->createQueryBuilder('j');

        $qb
            ->where('j.title LIKE :search')
            ->orWhere('j.description LIKE :search')
            ->setParameter('search', '%'.$options['search'].'%');

        if (!empty($options['category'])) {
            $qb
                ->andWhere('j.category = :category')
                ->setParameter('category', $options['category']);
        }

        if (!empty($options['company'])) {
            $qb->andWhere('j.company = :company')
                ->setParameter('company', $options['company']);
        }

        return $qb->getQuery()->getResult();
    }
}
