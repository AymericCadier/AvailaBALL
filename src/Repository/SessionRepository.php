<?php

namespace App\Repository;

use App\Entity\Session;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findSessionsByPlaygroundId($id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id_playground = :id')
            ->setParameter('id', $id)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findSessionsByUserId($id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id_user = :id')
            ->setParameter('id', $id)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findSessionsByDate($date)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.date = :date')
            ->setParameter('date', $date)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findSessionsByActiveUser(int $user)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id_user = :user')
            ->setParameter('user', $user)
            ->andWhere('s.date >= CURRENT_DATE()')
            ->andWhere('s.end_hour IS NULL')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }





//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
