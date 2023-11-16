<?php

namespace App\Repository;

use App\Entity\Craft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Craft>
 *
 * @method Craft|null find($id, $lockMode = null, $lockVersion = null)
 * @method Craft|null findOneBy(array $criteria, array $orderBy = null)
 * @method Craft[]    findAll()
 * @method Craft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CraftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Craft::class);
    }

//    /**
//     * @return Craft[] Returns an array of Craft objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Craft
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
