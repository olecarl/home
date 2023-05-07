<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Stringable;

#[ORM\Embeddable]
final class PlaceId extends Uid implements Stringable
{
}
