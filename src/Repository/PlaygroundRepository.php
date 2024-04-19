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

    public function findPlaygroundsByType($type)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.type = :type')
            ->setParameter('type', $type)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function updateAverageNote(Playground $playground): void
    {
        $avgNote = $this->createQueryBuilder('p')
            ->select('AVG(s.note) as avg_note')
            ->join('p.sessions', 's')
            ->where('p.id = :id')
            ->setParameter('id', $playground->getId())
            ->getQuery()
            ->getSingleScalarResult();

        $playground->setNote($avgNote);
        $this->getEntityManager()->flush();
    }

    public function listPlaygrounds(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
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
