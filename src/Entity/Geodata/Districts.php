<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Geodata;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TMptt;

#[Entity()]
#[Table(name: 'geodata.districts')]
class Districts
{
    use TId;
    use TMptt;
    #[ManyToOne(targetEntity: DistrictsDepth::class)]
    #[JoinColumn(name: 'rank', referencedColumnName: 'id')]
    protected(set) DistrictsDepth $rank;

    #[Column]
    protected(set) string $abbrev;

    #[Column]
    protected(set) string $color;

    #[Column(name: 'geom_wgs')]
    protected(set) string $geom_wgs;

    #[Column]
    protected(set) string $identificator;

    #[Column]
    protected(set) string $name;


}
