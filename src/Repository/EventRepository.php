<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }


    public function findEventsByPlaygroundId($id)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id_playground = :id')
            ->setParameter('id', $id)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findEventsByTime($time)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.time = :time')
            ->setParameter('time', $time)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findEventsByPlaygroundIdAndDate($id, $date)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id_playground = :id')
            ->andWhere('e.date = :date')
            ->setParameter('id', $id)
            ->setParameter('date', $date)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function listValidEvents(){
        return $this->createQueryBuilder('e')
            ->andWhere('e.valid=1')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function listUnseenEvents(): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.valid IS NULL')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }




//    /**
//     * @return Event[] Returns an array of Event objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Event
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
