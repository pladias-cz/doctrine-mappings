<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\PublicWeb;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public_web.habitats_syntaxons_nonvascular')]
class HabitatsSyntaxonsNonvascular
{
    use TId;

    #[ManyToOne(targetEntity: Habitats::class, inversedBy: 'syntaxa_relationships_nonvascular')]
    #[JoinColumn(name: 'habitats_id', referencedColumnName: 'id')]
    protected(set) Habitats $habitat;

    #[ManyToOne(targetEntity: HabitatsRelationships::class)]
    #[JoinColumn(name: 'relationship_id', referencedColumnName: 'id')]
    protected(set) HabitatsRelationships $relationship;

    #[Column(type: 'string')]
    protected(set) string $description;

}
