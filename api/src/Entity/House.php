<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Timestampable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A house is a building or structure that has the ability to be occupied for habitation by humans or other creatures (source: Wikipedia, the free encyclopedia, see <http://en.wikipedia.org/wiki/House>).
 *
 * @see https://schema.org/House
 */
#[ORM\Entity]
// #[ORM\HasLifecycleCallbacks]
#[ApiResource(
    types: ['https://schema.org/House'],
    operations: [
        new Get(),
        new GetCollection(openapi: false),
        new Post(),
    ],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']]
)]
class House extends Place implements Timestampable
{
    use TimestampableEntity;

    #[ORM\Column(type: 'text', nullable: false)]
    #[ApiProperty(types: ['https://schema.org/name'])]
    #[Groups(['read', 'write'])]
    #[Assert\NotBlank]
    public ?string $name = null;

    /**
    public function setGeocodeAddress(): void
    {
        if (!empty($this->address) && is_a($this->address, PostalAddress::class)) {
            $this->geo = new GeoCoordinates(50.415330, 6.557540);
        }
    } **/
}
