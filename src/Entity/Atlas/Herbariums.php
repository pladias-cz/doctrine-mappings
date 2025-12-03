<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'atlas.herbariums')]
class Herbariums
{
    use TId;

    #[Column]
    protected(set) string $abbrev;

    #[Column]
    protected(set) string $abbrev_explanation;

    #[Column]
    protected(set) string $address;

    #[Column]
    protected(set) string $city;

    #[Column]
    protected(set) string $contact;

    #[Column]
    protected(set) string $curator;

    #[Column]
    protected(set) string $description;

    #[Column]
    protected(set) string $import_id;

    #[Column]
    protected(set) string $name;

    #[Column]
    protected(set) string $owner;

    #[Column(type: 'boolean')]
    protected(set) bool $validated;

}
