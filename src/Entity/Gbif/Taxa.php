<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Gbif;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Taxons;
use Pladias\ORM\Repository\Public\TaxonsRepository;

#[Entity(repositoryClass: TaxonsRepository::class)]
#[Table(name: 'gbif.taxa')]
class Taxa
{
    use TId;

    #[Column(name: 'taxon_key', type: 'integer')]
    protected(set) int $taxonKey;

    #[Column(name: 'scientific_name')]
    protected(set) string $scientificName;

    #[Column(name: 'accepted_taxon_key', type: 'integer')]
    protected(set) int $acceptedTaxonKey;

    #[Column(name: 'accepted_scientific_name')]
    protected(set) string $acceptedScientificName;

    #[Column(name: 'taxon_rank')]
    protected(set) string $taxonRank;

    #[Column]
    protected(set) ?string $species;

    #[Column(name: 'species_key', type: 'integer')]
    protected(set) ?int $speciesKey;

    #[ManyToOne(targetEntity: Taxons::class)]
    #[JoinColumn(name: 'pladias_taxon_id', referencedColumnName: 'id')]
    protected(set) ?Taxons $pladiasTaxon;

    public function setPladiasTaxon(?Taxons $pladiasTaxon): self
    {
        $this->pladiasTaxon = $pladiasTaxon;
        return $this;
    }

}
