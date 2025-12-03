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
#[Table(name: 'floravegeu.syntaxons_diagnostic_nonvascular')]
class SyntaxonsDiagnosticNonvascular
{
    use TId;

    public const array TaxaGroups = ["Bryophytes", "Algae", "Cyanobacteria", "Lichens", "Fungi"];

    #[Column]
    protected(set) string $taxagroup;

    #[Column]
    protected(set) string $taxon;

    #[ManyToOne(targetEntity: Syntaxons::class, inversedBy: 'diagnosticNonvascular')]
    #[JoinColumn(name: 'syntaxon', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;


}
