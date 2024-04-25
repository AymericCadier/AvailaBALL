<?php
namespace App\Fixtures;

use App\Entity\Messages;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessagesFixtures extends Fixture
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $messages = [
            ['id' => 1, 'title' => 'Salut', 'content' => 'test', 'created_at' => '2024-04-19 09:53:30', 'is_read' => true, 'sender_id' => 42, 'recipient_id' => 30],
            ['id' => 2, 'title' => 'Ca va', 'content' => 'ca va bien', 'created_at' => '2024-04-19 10:33:59', 'is_read' => false, 'sender_id' => 42, 'recipient_id' => 30],
            ['id' => 3, 'title' => 'Salut', 'content' => 'oui et toi', 'created_at' => '2024-04-19 12:27:18', 'is_read' => true, 'sender_id' => 30, 'recipient_id' => 42]
        ];

        foreach ($messages as $messageData) {
            $sender = $this->userRepository->find($messageData['sender_id']);
            $recipient = $this->userRepository->find($messageData['recipient_id']);

            if ($sender && $recipient) {
                $message = new Messages();
                $message->setId($messageData['id']);
                $message->setTitle($messageData['title']);
                $message->setMessage($messageData['content']);
                $message->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $messageData['created_at']));
                $message->setIsRead($messageData['is_read']);
                $message->setSender($sender);
                $message->setRecipient($recipient);

                $manager->persist($message);
            } else {
                echo "Sender or recipient not found for message ID: " . $messageData['id'] . PHP_EOL;
            }
        }

        $manager->flush();
    }
}
