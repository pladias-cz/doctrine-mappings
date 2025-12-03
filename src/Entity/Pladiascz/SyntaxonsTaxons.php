<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'pladiascz.syntaxons_taxons')]
/**
 * @ORM\Entity
 * @ORM\Table(name="public_web.syntaxons_taxons")
 */
class SyntaxonsTaxons
{
    use TId;

    #[Column]
    protected(set) string $taxon;

    #[Column(type: 'boolean')]
    protected(set) bool $bold;

    #[Column(name: 'taxon_group')]
    protected(set) string $group;

    #[Column]
    protected(set) string $section;

    #[ManyToOne(targetEntity: Syntaxons::class)]
    #[JoinColumn(name: 'syntaxon_id', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;

}
