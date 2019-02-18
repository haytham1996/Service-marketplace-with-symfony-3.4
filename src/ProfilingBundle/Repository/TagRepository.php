<?php

namespace ProfilingBundle\Repository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
public function search (string $q):array{
    return $this->createQueryBuilder('t')
        ->where('t.nom LIKE :search')
        ->setParameter('search',"%"  .  $q  .  "%")
    ->getQuery()
        ->getResult();
}
}
