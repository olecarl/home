<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Domain\ValueObject\GeoCoordinates;
use App\Domain\ValueObject\PlaceId;
use App\Domain\ValueObject\PlaceName;
use App\Domain\ValueObject\PostalAddress;
use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
#[ApiResource]
class Place
{
    use TimestampableEntity;

    #[ORM\Embedded]
    #[ApiProperty(identifier: true, types: ['https://schema.org/identifier'])]
    public PlaceId $id;

    #[ORM\Embedded(columnPrefix: false)]
    public ?PlaceName $name = null;

    #[ORM\Embedded(columnPrefix: false)]
    public ?PostalAddress $address = null;

    #[ORM\Embedded(columnPrefix: false)]
    public ?GeoCoordinates $geo = null;

    /**
     * @param PlaceName|null $name
     * @param PostalAddress|null $address
     * @param GeoCoordinates|null $geo
     */
    public function __construct(?PlaceName $name = null, ?PostalAddress $address = null, ?GeoCoordinates $geo = null)
    {
        $this->name = $name;
        $this->address = $address;
        $this->geo = $geo;
    }
}
