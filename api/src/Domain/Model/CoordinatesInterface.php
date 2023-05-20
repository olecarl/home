<?php

declare(strict_types=1);

namespace App\Domain\Model;

interface CoordinatesInterface
{
    public function getLatitude(): ?string;

    public function getLongitude(): ?string;
}
