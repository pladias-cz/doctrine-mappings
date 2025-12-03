<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Dalibcz;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Taxons;

#[Entity()]
#[Table(name: 'dalibcz.taxon_info')]
class TaxonInfo
{
    use TId;
    use TDescriptionCs;

    #[ManyToOne(targetEntity: Taxons::class)]
    #[JoinColumn(name: 'taxon', referencedColumnName: 'id')]
    protected Taxons $taxon;


    public function setDescriptionCs(string $descriptionCs): TaxonInfo
    {
        $this->descriptionCs = $descriptionCs;
        return $this;
    }

    public function setDescriptionEn(string $descriptionEn): TaxonInfo
    {
        $this->descriptionEn = $descriptionEn;
        return $this;
    }

    public function setTaxon(Taxons $taxon): TaxonInfo
    {
        $this->taxon = $taxon;
        return $this;
    }

}
