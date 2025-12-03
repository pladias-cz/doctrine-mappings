<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Geodata;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'geodata.districts_depth')]
class DistrictsDepth
{
    use TId;

    #[Column]
    protected(set) string $description;

    #[Column]
    protected(set) string $name;


}
