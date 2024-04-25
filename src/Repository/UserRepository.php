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

    public function createUser($lname, $fname ,$username, $email, $password){
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setLname($lname);
        $user->setFname($fname);
        $user->setNickname($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setCreatedAt($user->getCurrentDate());
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function deleteUserId($id)
    {
        $user = $this->find($id);
        $user->setDeletedAt($user->getCurrentDate());
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function getUserById($id){
        return $this->find($id);
    }

    public function listActiveUsers(){
        return $this->findBy(['deleted_at' => null]);
    }

    public function listOtherUsers($currentUser) {
        $qb = $this->createQueryBuilder('u')
            ->where('u.deleted_at IS NULL')
            ->andWhere('u.id != :currentUserId')
            ->setParameter('currentUserId', $currentUser->getId());

        return $qb->getQuery()->getResult();
    }





    public function getUser($email,$password){
        $user = $this->findOneBy(['email' => $email, 'password' => $password]);
        return $user;
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