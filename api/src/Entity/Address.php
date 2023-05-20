<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Domain\Model\AddressInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Timestampable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 * The mailing address.
 *
 * @see https://schema.org/PostalAddress
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PostalAddress'], openapi: true)]
class Address implements \Stringable, Timestampable, AddressInterface
{
    use TimestampableEntity;

    public const SEPARATOR = ',';

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    public function __toString(): string
    {
        return
            $this->getStreetName() . ' ' . $this->getStreetNumber() . self::SEPARATOR .
            $this->getPostalCode() . $this->getLocality() . self::SEPARATOR .
            $this->getCountry() . self::SEPARATOR;
    }

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $streetName;

    #[ORM\Column(type: 'string', length: 8, nullable: true)]
    private ?string $streetNumber = null;

    #[ORM\Column(type: 'string', length: 5, nullable: false)]
    private string $postalCode;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $locality;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $subLocality = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $country;

    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    private ?string $countryCode = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getLocality(): string
    {
        return $this->locality;
    }

    public function getSubLocality(): ?string
    {
        return $this->subLocality;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getStreetName(): string
    {
        return $this->streetName;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetName(string $streetName): void
    {
        $this->streetName = $streetName;
    }

    public function setStreetNumber(?string $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function setLocality(string $locality): void
    {
        $this->locality = $locality;
    }

    public function setSubLocality(?string $subLocality): void
    {
        $this->subLocality = $subLocality;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }
}
