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

    #[Column(type: 'string')]
    protected(set) string $abbrev;

    #[Column(type: 'string')]
    protected(set) string $abbrev_explanation;

    #[Column(type: 'string')]
    protected(set) string $address;

    #[Column(type: 'string')]
    protected(set) string $city;

    #[Column(type: 'string')]
    protected(set) string $contact;

    #[Column(type: 'string')]
    protected(set) string $curator;

    #[Column(type: 'string')]
    protected(set) string $description;

    #[Column(type: 'string')]
    protected(set) string $import_id;

    #[Column(type: 'string')]
    protected(set) string $name;

    #[Column(type: 'string')]
    protected(set) string $owner;

    #[Column(type: 'boolean')]
    protected(set) bool $validated;

}
