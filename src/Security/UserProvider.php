<?php

declare(strict_types=1);

namespace App\Security;

use Sdk\Client\SingleCommandClient;
use Sdk\Dto\Command;
use Sdk\Oauth\Factory;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * UserProvider constructor.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function loadUserByUsername($username)
    {
        $this->factory->getAccessToken();

        $command = new Command('general.getPlayer', [], ['player.id', 'player.name']);
        $client = new SingleCommandClient($this->factory);
        $data = $client->executeCommand($command);
        $player = $data['context']['player'];

        return new User($player['name']);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException();
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
