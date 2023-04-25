<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entities that have a somewhat fixed, physical extension.
 *
 * @see https://schema.org/Place
 */
#[ORM\MappedSuperclass]
abstract class Place extends Thing
{
    /**
     * Physical address of the item.
     *
     * @see https://schema.org/address
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
    #[ApiProperty(types: ['https://schema.org/address'])]
    #[Groups(['read', 'write'])]
    public PostalAddress $address;

    /**
     * The geo coordinates of the place.
     *
     * @see https://schema.org/geo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\GeoCoordinates')]
    #[ApiProperty(types: ['https://schema.org/geo'])]
    #[Groups(['read', 'write'])]
    public ?GeoCoordinates $geo = null;
}
