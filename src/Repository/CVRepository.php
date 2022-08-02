<?php

namespace App\Repository;

use App\Entity\CV;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CVRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CV::class);
    }

    /**
     * @param  string $query
     * @return array
     */
    public function findRelevant(string $query): array
    {
        $qb = $this->createQueryBuilder('cv');
        $result = $qb
            ->addSelect("MATCH_AGAINST (cv.work, cv.experience, :query 'IN NATURAL MODE') as score")
            ->setParameter('query', $query)
            ->orderBy('score', 'desc')
            ->getQuery()
            ->getResult();

        return array_column($result,'0');
    }
}
