<?php
namespace App\Fixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $events = [
            ['id' => 13, 'valid' => 1, 'name' => 'abon', 'date' => '0000-12-30', 'duration' => 'bb', 'type' => 'bb', 'created_at' => '2024-04-17 13:13:21', 'id_playground_id' => 2],
            ['id' => 12, 'valid' => 1, 'name' => 'aaa', 'date' => '0000-12-30', 'duration' => 'a', 'type' => 'a', 'created_at' => '2024-04-17 13:12:55', 'id_playground_id' => 2],
            ['id' => 5, 'valid' => 1, 'name' => 'aaaaaaa', 'date' => '0000-12-30', 'duration' => 'aaaaaa', 'type' => 'aaaaaa', 'created_at' => '2024-04-08 09:31:15', 'id_playground_id' => 1],
            ['id' => 6, 'valid' => 0, 'name' => 'f', 'date' => '2222-02-22', 'duration' => '22', 'type' => '222', 'created_at' => '2024-04-08 09:32:21', 'id_playground_id' => 2],
            ['id' => 7, 'valid' => 1, 'name' => 'doc', 'date' => '2003-10-10', 'duration' => '2 jours', 'type' => 'tournoi 1 v 1', 'created_at' => '2024-04-12 12:33:52', 'id_playground_id' => 4],
        ];

        foreach ($events as $eventData) {
            $event = new Event();
            $event->setId($eventData['id']);
            $event->setValid($eventData['valid']);
            $event->setName($eventData['name']);
            $event->setDate( new \DateTime($eventData['date']));
            $event->setDuration($eventData['duration']);
            $event->setType($eventData['type']);
            $event->setCreatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', $eventData['created_at']));
            $event->setIdPlayground(null);

            $manager->persist($event);
        }

        $manager->flush();
    }
}

