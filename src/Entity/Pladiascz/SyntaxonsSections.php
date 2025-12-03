<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'pladiascz.syntaxons_sections')]
class SyntaxonsSections
{
    use TId;
    use TName;

    #[Column(type: 'integer')]
    protected(set) int $depth;

    #[Column(type: 'integer')]
    protected(set) int $lft;

    #[Column(type: 'integer')]
    protected(set) int $rgt;

    #[ManyToMany(targetEntity: Syntaxons::class)]
    #[OrderBy(['lft' => 'asc'])]
    #[JoinTable(
        name: 'atlas.rel_syntaxons_sections',
        joinColumns: [
            new JoinColumn(name: 'section_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'syntaxon_id', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $syntaxons;


}
