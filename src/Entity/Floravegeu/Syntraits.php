<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.syntraits')]
class Syntraits
{
    use TId;

    #[Column]
    protected(set) string $name;

    #[Column]
    protected(set) string $description;

}
