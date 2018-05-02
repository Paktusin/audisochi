<?php

namespace App\Repository;

use App\Entity\TicketPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketPart|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketPart|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketPart[]    findAll()
 * @method TicketPart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketPartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketPart::class);
    }

//    /**
//     * @return TicketPart[] Returns an array of TicketPart objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TicketPart
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
