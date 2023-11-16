<?php

namespace App\Repository;

use App\Entity\GroupFragment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupFragment>
 *
 * @method GroupFragment|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupFragment|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupFragment[]    findAll()
 * @method GroupFragment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupFragmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupFragment::class);
    }

//    /**
//     * @return GroupFragment[] Returns an array of GroupFragment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupFragment
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
