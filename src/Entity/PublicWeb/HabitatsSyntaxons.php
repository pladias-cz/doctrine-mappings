<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\PublicWeb;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'public_web.habitats_syntaxons')]
class HabitatsSyntaxons
{
    use TId;

    #[ManyToOne(targetEntity: Syntaxons::class, inversedBy: 'habitat_relationships')]
    #[JoinColumn(name: 'syntaxons_id', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;

    #[ManyToOne(targetEntity: Habitats::class, inversedBy: 'syntaxa_relationships')]
    #[JoinColumn(name: 'habitats_id', referencedColumnName: 'id')]
    protected(set) Habitats $habitat;

    #[ManyToOne(targetEntity: HabitatsRelationships::class)]
    #[JoinColumn(name: 'relationship_id', referencedColumnName: 'id')]
    protected(set) HabitatsRelationships $relationship;

}
