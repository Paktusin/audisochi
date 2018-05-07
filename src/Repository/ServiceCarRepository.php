<?php

namespace App\Repository;

use App\Entity\ServiceCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ServiceCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceCar[]    findAll()
 * @method ServiceCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceCarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ServiceCar::class);
    }

//    /**
//     * @return Service[] Returns an array of Service objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Service
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
