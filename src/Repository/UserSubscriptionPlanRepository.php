<?php

namespace App\Repository;

use App\Entity\UserSubscriptionPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserSubscriptionPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSubscriptionPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSubscriptionPlan[]    findAll()
 * @method UserSubscriptionPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @author Karol Gancarczyk
 */
class UserSubscriptionPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSubscriptionPlan::class);
    }

    // /**
    //  * @return UserSubscriptionPlan[] Returns an array of UserSubscriptionPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserSubscriptionPlan
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
