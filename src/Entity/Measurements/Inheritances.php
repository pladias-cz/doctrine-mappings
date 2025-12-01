<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'measurements.inheritances')]
/**
 * @ORM\Entity
 * @ORM\Table(name="measurements.inheritances")
 */
class Inheritances
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $description;
    #[Column(type: 'string')]
    protected(set) string $key;

    #[Column(type: 'string')]
    protected(set) string $name;

}
