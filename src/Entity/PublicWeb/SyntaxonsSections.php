<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\PublicWeb;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'public_web.syntaxons_sections')]
class SyntaxonsSections
{
    use TId;

    #[Column(type: 'integer')]
    protected(set) int $depth;

    #[Column(type: 'integer')]
    protected(set) int $lft;

    #[Column(type: 'string')]
    protected(set) string $name;

    #[Column(type: 'integer')]
    protected(set) int $rgt;

    #[Column(type: 'boolean')]
    protected(set) bool $vascular;

    #[ManyToMany(targetEntity: Syntaxons::class)]
    #[OrderBy(['lft' => 'ASC'])]
    #[JoinTable(
        name: 'public_web.rel_syntaxons_sections',
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
