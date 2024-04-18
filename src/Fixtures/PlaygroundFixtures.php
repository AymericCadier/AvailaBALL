<?php
namespace App\Fixtures;

use App\Entity\Playground;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaygroundFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $playgrounds = [
            ['id' => 3, 'note' => 4.0, 'type' => 'basket', 'name' => 'Champs de Mars', 'count_user' => 0],
            ['id' => 4, 'note' => 1.0, 'type' => 'basket', 'name' => 'Square Docteur Calmette', 'count_user' => 0],
            ['id' => 5, 'note' => 2.0, 'type' => 'basket', 'name' => 'Paris 14', 'count_user' => 0],
            ['id' => 6, 'note' => 3.0, 'type' => 'basket', 'name' => 'Jardin du Luxembourg', 'count_user' => 0],
            ['id' => 7, 'note' => 4.0, 'type' => 'basket', 'name' => 'Glacière', 'count_user' => 0],
            ['id' => 8, 'note' => 5.0, 'type' => 'basket', 'name' => 'Paris 13', 'count_user' => 0],
            ['id' => 9, 'note' => 0.0, 'type' => 'basket', 'name' => 'Saint-Paul', 'count_user' => 0],
            ['id' => 10, 'note' => 1.0, 'type' => 'basket', 'name' => 'Chatelet', 'count_user' => 0],
            ['id' => 11, 'note' => 2.0, 'type' => 'basket', 'name' => 'Rue de Trévise', 'count_user' => 0],
            ['id' => 12, 'note' => 3.0, 'type' => 'basket', 'name' => 'Duperré', 'count_user' => 0],
            ['id' => 13, 'note' => 4.0, 'type' => 'basket', 'name' => 'Square denvers', 'count_user' => 0],
            ['id' => 14, 'note' => 5.0, 'type' => 'basket', 'name' => 'Jardin Villemin', 'count_user' => 0],
            ['id' => 15, 'note' => 0.0, 'type' => 'basket', 'name' => 'Jemmapes', 'count_user' => 0],
            ['id' => 16, 'note' => 1.0, 'type' => 'basket', 'name' => 'Riquet', 'count_user' => 0],
            ['id' => 17, 'note' => 2.0, 'type' => 'basket', 'name' => 'Bagnolet', 'count_user' => 0],
            ['id' => 18, 'note' => 3.0, 'type' => 'basket', 'name' => 'Rue Charrière', 'count_user' => 0],
            ['id' => 19, 'note' => 4.0, 'type' => 'foot', 'name' => 'ASPT75', 'count_user' => 0],
            ['id' => 20, 'note' => 5.0, 'type' => 'foot', 'name' => 'Foot 130', 'count_user' => 0],
            ['id' => 21, 'note' => 0.0, 'type' => 'foot', 'name' => 'Tour aux parachutes', 'count_user' => 0],
            ['id' => 22, 'note' => 1.0, 'type' => 'foot', 'name' => 'Léo Lagrange', 'count_user' => 0],
            ['id' => 23, 'note' => 2.0, 'type' => 'foot', 'name' => 'Jussieu', 'count_user' => 0],
            ['id' => 24, 'note' => 5.0, 'type' => 'foot', 'name' => 'Saint Paul', 'count_user' => 0],
            ['id' => 25, 'note' => 3.0, 'type' => 'foot', 'name' => 'Neuve Saint-Pierre', 'count_user' => 0],
            ['id' => 26, 'note' => 4.0, 'type' => 'foot', 'name' => 'Stadio Bruscield', 'count_user' => 0],
            ['id' => 27, 'note' => 5.0, 'type' => 'foot', 'name' => 'Lagny', 'count_user' => 0],
            ['id' => 28, 'note' => 0.0, 'type' => 'foot', 'name' => 'Jardiniers', 'count_user' => 0],
            ['id' => 29, 'note' => 1.0, 'type' => 'foot', 'name' => 'Rue des Haies', 'count_user' => 0],
            ['id' => 30, 'note' => 2.0, 'type' => 'foot', 'name' => 'Déjerine (Paris FC)', 'count_user' => 0],
            ['id' => 31, 'note' => 3.0, 'type' => 'foot', 'name' => 'La grange aux belles', 'count_user' => 0],
            ['id' => 32, 'note' => 4.0, 'type' => 'foot', 'name' => 'Square Léon', 'count_user' => 0],
            ['id' => 33, 'note' => 5.0, 'type' => 'foot', 'name' => 'Pailleron', 'count_user' => 0],
            ['id' => 34, 'note' => 0.0, 'type' => 'foot', 'name' => 'Porte des Lilas', 'count_user' => 0],
            ['id' => 35, 'note' => 1.0, 'type' => 'foot', 'name' => 'Parc Martin Luther King', 'count_user' => 0],
            ['id' => 36, 'note' => 2.0, 'type' => 'foot', 'name' => 'Bertrand Dauvin', 'count_user' => 0],
            ['id' => 37, 'note' => 3.0, 'type' => 'foot', 'name' => 'Le Five', 'count_user' => 0],
            ['id' => 38, 'note' => 4.0, 'type' => 'foot', 'name' => 'rai by Courtside', 'count_user' => 0]

        ];

        foreach ($playgrounds as $playgroundData) {
            $playground = new Playground();
            $playground->setId($playgroundData['id']);
            $playground->setNote(($playgroundData['note']));
            $playground->setType($playgroundData['type']);
            $playground->setName($playgroundData['name']);
            $playground->setCountUser($playgroundData['count_user']);

            $manager->persist($playground);
        }

        $manager->flush();
    }
}
