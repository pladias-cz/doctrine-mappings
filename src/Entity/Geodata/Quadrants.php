<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Geodata;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'geodata.quadrants_full')]
class Quadrants
{
    use TId;

    #[ManyToOne(targetEntity: Squares::class)]
    #[JoinColumn(name: 'square_id', referencedColumnName: 'id')]
    protected(set) Squares $square;

    #[Column]
    protected(set) string $code;

    #[Column(name: 'geom_wgs')]
    protected(set) string $geom;

}