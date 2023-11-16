<?php

namespace App\Repository;

use App\Entity\HasRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HasRole>
 *
 * @method HasRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method HasRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method HasRole[]    findAll()
 * @method HasRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HasRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HasRole::class);
    }

//    /**
//     * @return HasRole[] Returns an array of HasRole objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HasRole
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
