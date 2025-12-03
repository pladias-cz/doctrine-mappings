<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;

#[Entity()]
#[Table(name: 'measurements.units')]
class Units
{
    use TId;
    use TName;
    use TDescriptionCs;

    #[Column]
    protected(set) ?string $abbrev;


}
