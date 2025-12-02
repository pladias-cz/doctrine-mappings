<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\AtlasNonVascular;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'atlas_nonvascular.substrate_2')]
class Substrate2
{
    use Tid;

    #[ManyToOne(targetEntity: Substrate1::class, inversedBy: 'substrate2')]
    #[JoinColumn(name: 'substrate_1_id', referencedColumnName: 'id')]
    protected(set) Substrate1 $substrate1;

    #[Column(type: 'string')]
    protected(set) string $keyCz;

    #[Column(type: 'integer')]
    protected(set) int $succession;


}
