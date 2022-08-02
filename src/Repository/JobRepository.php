<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class JobRepository extends ServiceEntityRepository
{
    protected const LANGUAGE = 'php';

    protected const LOCATION = 'Bucuresti';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function getFiltered(array $filters): array
    {
        $qb = $this->createQueryBuilder('j');
        if (array_key_exists('term', $filters)) {
            $term = $filters['term'];
            if ($term) {
                if (str_contains($term, self::LANGUAGE)) {
                    $qb
                        ->andWhere($qb->expr()->like('j.title', ':filter_skill'))
                        ->setParameter('filter_skill', '%' . self::LANGUAGE . '%');
                }
                if (str_contains($term, self::LOCATION)) {
                    $qb
                        ->andWhere($qb->expr()->like('j.location', ':filter_location'))
                        ->setParameter('filter_location', '%' . self::LOCATION . '%');
                }
            }
        }

        return $qb->getQuery()->getArrayResult();
    }
}
