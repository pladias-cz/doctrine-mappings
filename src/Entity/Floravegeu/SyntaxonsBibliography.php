<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'floravegeu.syntaxons_bibliography')]
class SyntaxonsBibliography
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $cite;

    #[Column(type: 'integer')]
    protected(set) int $succession;

    #[ManyToOne(targetEntity: Syntaxons::class, inversedBy: 'bibliography')]
    #[JoinColumn(name: 'syntaxon_id', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;

}
