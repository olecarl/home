<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Domain\Model\CoordinatesInterface;
use App\Domain\Model\LocationInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entities that have a somewhat fixed, physical extension.
 *
 * @see https://schema.org/Place
 */
#[ORM\MappedSuperclass]
abstract class Place implements LocationInterface
{
    /**
     * Name of the item.
     *
     * @see https://schema.org/name
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    /**
     * Physical address of the item.
     *
     * @see https://schema.org/address
     */
    #[ORM\OneToOne(targetEntity: Address::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/address'])]
    private ?Address $address = null;

    /**
     * The geo coordinates of the place.
     *
     * @see https://schema.org/geo
     */
    #[ORM\OneToOne(targetEntity: Coordinates::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/geo'])]
    private ?CoordinatesInterface $geo = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAddress(?Address $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setGeo(?CoordinatesInterface $geo): void
    {
        $this->geo = $geo;
    }

    public function getGeo(): ?CoordinatesInterface
    {
        return $this->geo;
    }
}
