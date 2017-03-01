<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class CategoryManager
 */
class CategoryManager
{
    /** @var CategoryRepository */
    private $categoryRepository;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->categoryRepository = $em->getRepository(Category::class);
    }
}
