<?php
namespace App\Fixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AUserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $users = [
            ['id' => 42, 'roles' => ['ROLE_USER'], 'lname' => 'qq', 'fname' => 'qq', 'nickname' => 'qq', 'email' => 'q@q.q', 'password' => '$2y$13$FccTAPNUbp55347zFWILYeEGT9yzRHvhSrJchErryGkUMQHjo0DYq', 'created_at' => '2024-03-20 14:11:12', 'deleted_at' => null],
            ['id' => 29, 'roles' => ['ROLE_USER', 'ROLE_ADMIN'], 'lname' => 'a', 'fname' => 'aa', 'nickname' => 'a', 'email' => 'a@a.a', 'password' => '$2y$13$pt19bXV5.SnYV21nq7bpyeFQBha0MP3G7jEuMBbKv3V4GowIdybQ.', 'created_at' => '2024-03-25 14:38:33', 'deleted_at' => '2024-04-03 10:31:04'],
            ['id' => 30, 'roles' => ['ROLE_USER', 'ROLE_ADMIN'], 'lname' => 'b', 'fname' => 'b', 'nickname' => 'b', 'email' => 'b@b.b', 'password' => '$2y$13$r9s4tnR0mcCjg1dad4uq6e.tLkbFZnLeKNCP9VQzBh6o5CKGE.Pba', 'created_at' => '2024-04-07 17:30:33', 'deleted_at' => null],
            ['id' => 31, 'roles' => ['ROLE_USER'], 'lname' => 'aymx', 'fname' => 'aymx', 'nickname' => 'aymx', 'email' => 'aymx@aymx.com', 'password' => '$2y$13$cufl/HkA6owOsgHdB.t60uUQ0WTH2uTglgNTHX.eCKTV9HiIdrx1i', 'created_at' => '2024-04-08 09:49:27', 'deleted_at' => null]
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setId($userData['id']);
            $user->setRoles($userData['roles']);
            $user->setLname($userData['lname']);
            $user->setFname($userData['fname']);
            $user->setNickname($userData['nickname']);
            $user->setEmail($userData['email']);
            $user->setPassword($userData['password']);
            $user->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $userData['created_at']));
            $user->setDeletedAt($userData['deleted_at'] ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $userData['deleted_at']) : null);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
