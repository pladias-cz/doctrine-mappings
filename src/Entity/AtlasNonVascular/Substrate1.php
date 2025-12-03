<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\AtlasNonVascular;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'atlas_nonvascular.substrate_1')]
class Substrate1
{
    use Tid;

    #[OneToMany(targetEntity: Substrate2::class, mappedBy: 'substrate1')]
    protected(set) Collection $substrate2;

    #[Column]
    protected(set) string $keyCz;

    #[Column(type: 'integer')]
    protected(set) int $succession;


}
