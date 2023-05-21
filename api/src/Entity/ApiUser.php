<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ApiUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ApiUserRepository::class)]
class ApiUser implements UserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    public ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return array<int, string>
     */
    public function getRoles(): array
    {
        $this->roles[] = ['ROLE_USER'];
        return $this->roles;
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }
}
