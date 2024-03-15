<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function createUser($lname, $fname ,$username, $password, $email){
        $user = new User();
        $user->setLname($lname);
        $user->setFname($fname);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function deleteUserId($id){
        $user = $this->find($id);
        $this->_em->remove($user);
        $this->_em->flush();
    }

    public function getUserId($id){
        return $this->find($id);
    }

    public function getUser($email,$password){
        $user = $this->findOneBy(['email' => $email, 'password' => $password]);
        return $user;
    }

    public function deleteUser($email,$password){
        $user = $this->findOneBy(['email' => $email, 'password' => $password]);
        $this->_em->remove($user);
        $this->_em->flush();
    }

    public function updateUser($id, $lname, $fname ,$username, $password, $email){
        $user = $this->find($id);
        $user->setLname($lname);
        $user->setFname($fname);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $this->_em->persist($user);
        $this->_em->flush();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
