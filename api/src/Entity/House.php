<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A house is a building or structure that has the ability to be occupied for habitation by humans or other creatures (source: Wikipedia, the free encyclopedia, see <http://en.wikipedia.org/wiki/House>).
 *
 * @see https://schema.org/House
 */
#[ORM\Entity]
#[ApiResource(
    types: ['https://schema.org/House'],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']])]
class House extends Place
{
}
