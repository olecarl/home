<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class GeoCoordinates
{
    public function __construct(
        #[ORM\Column]
        public readonly float $latitude,

        #[ORM\Column]
        public readonly float $longitude
    ) {
    }
}
