<?php
namespace App\Fixtures;

use App\Entity\Session;
use App\Repository\PlaygroundRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SessionFixtures extends Fixture
{
    private UserRepository $userRepository;
    private PlaygroundRepository $playgroundRepository;

    public function __construct(UserRepository $userRepository, PlaygroundRepository $playgroundRepository)
    {
        $this->userRepository = $userRepository;
        $this->playgroundRepository = $playgroundRepository;
    }

    public function load(ObjectManager $manager)
    {
        $sessions = [
            ['id' => 20, 'date' => '2024-04-12', 'begin_hour' => '16:13:00', 'end_hour' => '16:13:57', 'note' => 5.0, 'id_user_id' => 30, 'id_playground_id' => 24],
            ['id' => 19, 'date' => '2024-04-12', 'begin_hour' => '15:27:35', 'end_hour' => '15:27:50', 'note' => 4.0, 'id_user_id' => 30, 'id_playground_id' => 1],
            ['id' => 16, 'date' => '2024-04-12', 'begin_hour' => '15:06:02', 'end_hour' => '15:06:14', 'note' => 2.0, 'id_user_id' => 30, 'id_playground_id' => 1],
            ['id' => 17, 'date' => '2024-04-12', 'begin_hour' => '15:19:17', 'end_hour' => '15:19:58', 'note' => 3.0, 'id_user_id' => 30, 'id_playground_id' => 1],
            ['id' => 18, 'date' => '2024-04-12', 'begin_hour' => '15:24:12', 'end_hour' => '15:26:33', 'note' => 4.0, 'id_user_id' => 30, 'id_playground_id' => 1],
            ['id' => 21, 'date' => '2024-04-18', 'begin_hour' => '19:11:07', 'end_hour' => '19:11:21', 'note' => 4.0, 'id_user_id' => 30, 'id_playground_id' => 3]
        ];

        foreach ($sessions as $sessionData) {
            $session = new Session();
            $session->setId($sessionData['id']);
            $session->setDate(\DateTime::createFromFormat('Y-m-d', $sessionData['date']));
            $session->setBeginHour(\DateTime::createFromFormat('H:i:s', $sessionData['begin_hour']));
            $session->setEndHour(\DateTime::createFromFormat('H:i:s', $sessionData['end_hour']));
            $session->setNote($sessionData['note']);

            $user = $this->userRepository->find($sessionData['id_user_id']);
            $playground = $this->playgroundRepository->find($sessionData['id_playground_id']);

            $session->setIdUser($user);
            $session->setIdPlayground($playground);

            $manager->persist($session);
        }

        $manager->flush();
    }
}