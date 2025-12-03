<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;

#[Entity()]
#[Table(name: 'pladiascz.countries')]
class Countries
{
    use TId;
    use TName;

    public const int CZ = 1;
    #[Column]
    protected(set) string $code;

}
