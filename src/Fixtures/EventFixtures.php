<?php
namespace App\Fixtures;

use App\Entity\Event;
use App\Repository\PlaygroundRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    private PlaygroundRepository $playgroundRepository;


    public function __construct(UserRepository $userRepository, PlaygroundRepository $playgroundRepository)
    {
        $this->playgroundRepository = $playgroundRepository;
    }
    public function load(ObjectManager $manager)
    {
        $events = [
            ['id' => 13, 'valid' => 1, 'name' => 'Tournoi 3x3 ', 'date' => '2024-05-30', 'duration' => '5h', 'type' => 'tournoi', 'created_at' => '2024-04-17 13:13:21', 'id_playground_id' => 2],
            ['id' => 6, 'valid' => 0, 'name' => 'Showcase A$AP Rocky', 'date' => '2025-11-10', 'duration' => '3h', 'type' => 'showcase,concert', 'created_at' => '2024-04-08 09:32:21', 'id_playground_id' => 7],
            ['id' => 7, 'valid' => 1, 'name' => 'Match Paris FC', 'date' => '2024-07-15', 'duration' => '1h30', 'type' => 'match professionnel', 'created_at' => '2024-04-12 12:33:52', 'id_playground_id' => 15],
        ];

        foreach ($events as $eventData) {
            $playground = $this->playgroundRepository->getPlaygroundById($eventData['id_playground_id']);
            $event = new Event();
            $event->setId($eventData['id']);
            $event->setValid($eventData['valid']);
            $event->setName($eventData['name']);
            $event->setDate( new \DateTime($eventData['date']));
            $event->setDuration($eventData['duration']);
            $event->setType($eventData['type']);
            $event->setCreatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', $eventData['created_at']));
            $event->setIdPlayground($playground);

            $manager->persist($event);
        }

        $manager->flush();
    }
}

