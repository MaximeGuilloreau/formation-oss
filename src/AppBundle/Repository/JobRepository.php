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

    /**
     * @return array
     */
    public function findAll()
    {
        // Add Join for avoid collection lazy loading
        $qb = $this->createQueryBuilder('j')
                ->addSelect('cat')
                ->addSelect('comp')
                ->join('j.category', 'cat')
                ->join('j.company', 'comp');

        return $qb->getQuery()->getResult();
    }
}
