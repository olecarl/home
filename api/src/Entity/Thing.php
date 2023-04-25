<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic type of item.
 *
 * @see https://schema.org/Thing
 */
#[ORM\MappedSuperclass]
abstract class Thing
{
    #[ORM\Id]
    #[ApiProperty(identifier: true, types: ['https://schema.org/identifier'])]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    #[Assert\Ulid]
    private ?Ulid $id = null;

    /**
     * The name of the item.
     *
     * @see https://schema.org/name
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/name'])]
    #[Groups(['read', 'write'])]
    public ?string $name = null;

    public function getId(): ?Ulid
    {
        return $this->id;
    }
}
