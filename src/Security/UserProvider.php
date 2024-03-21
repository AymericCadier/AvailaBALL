<?php
namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;



class UserProvider implements UserProviderInterface
{
private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
$this->entityManager = $entityManager;
}

public function loadUserByUsername($username)
{
return $this->entityManager->createQuery('
SELECT u
FROM App\Entity\User u
WHERE u.email = :email AND u.deleted_at IS NULL
')
->setParameter('email', $username)
->getOneOrNullResult();
}

public function refreshUser(UserInterface $user): UserInterface
{
if (!$user instanceof User) {
throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
}

return $this->loadUserByUsername($user->getEmail());
}

public function supportsClass($class): bool
{
return User::class === $class;
}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->entityManager->createQuery('
        SELECT u
        FROM App\Entity\User u
        WHERE u.email = :email AND u.deleted_at IS NULL
    ')
            ->setParameter('email', $identifier)
            ->getOneOrNullResult();

        if (null === $user) {
            throw new UserNotFoundException(sprintf('User with ID "%s" not found.', $identifier));
        }

        return $user;
    }


}
