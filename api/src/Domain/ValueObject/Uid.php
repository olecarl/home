<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Embeddable]
abstract class Uid
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    public Ulid $value;

    /**
     * @param Ulid|null $value
     */
    public function __construct(?Ulid $value = null)
    {
        $this->value = $value ?? new Ulid();
    }

    public function __toString(): string
    {
        return $this->value->toBase32();
    }

}
