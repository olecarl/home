<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Entity\Address;

interface LocationInterface
{
    public function getAddress(): ?Address;

    public function getGeo(): ?CoordinatesInterface;
}
