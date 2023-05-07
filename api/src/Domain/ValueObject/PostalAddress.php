<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class PostalAddress
{
    public function __construct(
        #[ORM\Column(length: 255)]
        public readonly ?string $streetAddress = null,

        #[ORM\Column(length: 16)]
        public readonly ?string $postalCode = null,

        #[ORM\Column(length: 255)]
        public readonly ?string $addressLocality = null,

        #[ORM\Column(length: 2)]
        public readonly ?string $addressCountry = null,
    ) {
    }
}
