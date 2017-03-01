<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Job;
use AppBundle\Repository\JobRepository;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

/**
 * Class JobManager
 */
class JobManager
{
    /** @var JobRepository */
    private $jobRepository;

    /** @var LoggerInterface */
    private $logger;

    /**
     * @param EntityManager   $em
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->jobRepository = $em->getRepository(Job::class);
        $this->logger = $logger;
    }

    /**
     * @return \AppBundle\Repository\JobRepository[]|array
     */
    public function findAll()
    {
        $jobs = $this->jobRepository->findAll();
        $this->logger->debug('JobManager: Job return', [
            'count' => count($jobs),
        ]);

        return $jobs;
    }

    /**
     * @param int $id
     * @return Job
     */
    public function find(int $id)
    {
        return $this->jobRepository->find($id);
    }

    /**
     * @param array $options
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function search(array $options = [])
    {
        return $this->jobRepository->search($options);
    }
}
