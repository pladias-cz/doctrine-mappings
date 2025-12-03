<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TMptt;
use Pladias\ORM\Entity\Attributes\TNameCs;

#[Entity()]
#[Table(name: 'public.syntaxons_sections')]
class SyntaxonsSections
{
    use TId;
    use TNameCs;
    use TMptt;

    #[Column(type: 'boolean')]
    protected(set) bool $vascular;

    #[ManyToMany(targetEntity: Syntaxons::class)]
    #[OrderBy(['lft' => 'ASC'])]
    #[JoinTable(
        name: 'public.rel_syntaxons_sections',
        joinColumns: [
            new JoinColumn(name: 'section_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'syntaxon_id', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $syntaxons;


    public function getHeadingLevel(): int
    {
        if (!$this->vascular && $this->depth > 1) {
            return $this->depth + 1;
        }
        return $this->depth;

    }

}
