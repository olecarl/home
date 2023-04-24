<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * The mailing address.
 *
 * @see https://schema.org/PostalAddress
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PostalAddress'], openapi: false)]
class PostalAddress extends Thing
{
    /**
     * The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
     *
     * @see https://schema.org/addressCountry
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/addressCountry'])]
    #[Groups(['read', 'write'])]
    public ?string $addressCountry = null;

    /**
     * The locality in which the street address is, and which is in the region. For example, Mountain View.
     *
     * @see https://schema.org/addressLocality
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/addressLocality'])]
    #[Groups(['read', 'write'])]
    public ?string $addressLocality = null;

    /**
     * The region in which the locality is, and which is in the country. For example, California or another appropriate first-level \[Administrative division\](https://en.wikipedia.org/wiki/List\_of\_administrative\_divisions\_by\_country).
     *
     * @see https://schema.org/addressRegion
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/addressRegion'])]
    #[Groups(['read', 'write'])]
    public ?string $addressRegion = null;

    /**
     * The postal code. For example, 94043.
     *
     * @see https://schema.org/postalCode
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/postalCode'])]
    #[Groups(['read', 'write'])]
    public ?string $postalCode = null;

    /**
     * The street address. For example, 1600 Amphitheatre Pkwy.
     *
     * @see https://schema.org/streetAddress
     */
    #[ORM\Column(type: 'text', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/streetAddress'])]
    #[Groups(['read', 'write'])]
    public ?string $streetAddress = null;
}
