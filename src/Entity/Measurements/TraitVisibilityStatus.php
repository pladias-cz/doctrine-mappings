<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'measurements.trait_visibility_status')]
class TraitVisibilityStatus
{
    use TId;

    public const int VISIBLE_PUBLIC = 4;

    #[Column(name: 'name_cz', type: 'string')]
    protected(set) string $nameCs;

    #[Column(type: 'integer')]
    protected(set) int $succession;

}
