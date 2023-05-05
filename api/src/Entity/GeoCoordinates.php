<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * The geographic coordinates of a place or event.
 *
 * @see https://schema.org/GeoCoordinates
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeoCoordinates'], openapi: false)]
class GeoCoordinates extends Thing
{
    use TimestampableEntity;

    /**
     * The latitude of a location. For example ```37.42242``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
     *
     * @see https://schema.org/latitude
     */
    #[ORM\Column(type: 'float', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/latitude'])]
    #[Groups(['read', 'write'])]
    public ?float $latitude = null;

    /**
     * The longitude of a location. For example ```-122.08585``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
     *
     * @see https://schema.org/longitude
     */
    #[ORM\Column(type: 'float', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/longitude'])]
    #[Groups(['read', 'write'])]
    public ?float $longitude = null;

    public function __construct(?float $latitude, ?float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}
