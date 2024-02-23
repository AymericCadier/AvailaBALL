<?php

namespace App\Repository;

use App\Entity\Playground;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Playground>
 *
 * @method Playground|null find($id, $lockMode = null, $lockVersion = null)
 * @method Playground|null findOneBy(array $criteria, array $orderBy = null)
 * @method Playground[]    findAll()
 * @method Playground[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaygroundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playground::class);
    }

    public function findPlaygroundsById($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function rankPlaygroundsByRating()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.note', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Playground[] Returns an array of Playground objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Playground
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
