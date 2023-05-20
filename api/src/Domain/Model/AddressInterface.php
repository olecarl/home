<?php

declare(strict_types=1);

namespace App\Domain\Model;

interface AddressInterface
{
    public function getCountry(): string;

    public function getLocality(): string;

    public function getSubLocality(): ?string;

    public function getPostalCode(): string;

    public function getStreetName(): string;

    public function getStreetNumber(): ?string;
}
