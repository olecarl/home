<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * The geographic coordinates of a place or event.
 *
 * @see https://schema.org/GeoCoordinates
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeoCoordinates'], openapi: false)]
class GeoCoordinates
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * The latitude of a location. For example ```37.42242``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
     *
     * @see https://schema.org/latitude
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/latitude'])]
    #[Groups(['read', 'write'])]
    private ?string $latitude = null;

    /**
     * The longitude of a location. For example ```-122.08585``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
     *
     * @see https://schema.org/longitude
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/longitude'])]
    #[Groups(['read', 'write'])]
    private ?string $longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLatitude(?string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLongitude(?string $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }
}
