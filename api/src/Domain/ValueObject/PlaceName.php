<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Stringable;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
final class PlaceName implements Stringable
{
    #[ORM\Column(name: 'name', length: 255, nullable: true)]
    public readonly string $value;

    public function __construct(?string $value = null)
    {
        Assert::lengthBetween($value, 1, 255);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
