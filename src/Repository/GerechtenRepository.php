<?php

namespace App\Repository;

use App\Entity\Gerechten;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gerechten|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gerechten|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gerechten[]    findAll()
 * @method Gerechten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GerechtenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gerechten::class);
    }

    // /**
    //  * @return Gerechten[] Returns an array of Gerechten objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gerechten
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
