<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Domain\Model\CoordinatesInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Timestampable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 * The geographic coordinates of a place or event.
 *
 * @see https://schema.org/GeoCoordinates
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeoCoordinates'], openapi: false)]
class Coordinates implements \Stringable, Timestampable, CoordinatesInterface
{
    use TimestampableEntity;

    public const SEPARATOR = ',';

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    /**
     * The latitude of a location. For example ```37.42242``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
     *
     * @see https://schema.org/latitude
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/latitude'])]
    private ?string $latitude = null;

    /**
     * The longitude of a location. For example ```-122.08585``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
     *
     * @see https://schema.org/longitude
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/longitude'])]
    private ?string $longitude = null;

    public function __toString(): string
    {
        return $this->getLatitude() . self::SEPARATOR . $this->getLongitude();
    }

    public function getId(): ?Uuid
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
