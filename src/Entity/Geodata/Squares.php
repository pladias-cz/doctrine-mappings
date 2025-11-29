<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Geodata;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'geodata.squares_full')]
class Squares
{
    use TId;

    #[Column(name: 'geom_wgs', type: 'string')]
    protected(set) string $geom;

    #[Column(type: 'string')]
    protected(set) string $code;

}