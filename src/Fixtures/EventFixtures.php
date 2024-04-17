<?php
namespace App\Fixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $event = new Event();
        $event->setName('Événement de test');
        $event->setValid(true);
        $event->setDate(new \DateTime('2023-03-01'));
        $event->setDuration('2 heures');
        $event->setCreatedAt(new \DateTimeImmutable());
        $event->setType('Concert');
        $event->setIdPlayground(null);
        $manager->persist($event);

        $manager->flush();
    }
}
