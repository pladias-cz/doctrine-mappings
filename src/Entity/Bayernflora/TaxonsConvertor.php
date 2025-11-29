<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Taxons;

#[Entity()]
#[Table(name: 'bayernflora.taxons_convertor')]
class TaxonsConvertor
{
    use TId;

    #[ManyToOne(targetEntity: FSGTaxons::class, inversedBy: 'taxonConvertor')]
    #[JoinColumn(name: 'fsg_taxon_id', referencedColumnName: 'id', nullable: false)]
    protected(set) FSGTaxons $fsgTaxon;

    #[ManyToOne(targetEntity: Taxons::class, inversedBy: 'taxonConvertor')]
    #[JoinColumn(name: 'pladias_taxon', referencedColumnName: 'id', nullable: false)]
    protected(set) Taxons $pladiasTaxon;

    #[ManyToOne(targetEntity: BayernTaxons::class, inversedBy: 'convertor')]
    #[JoinColumn(name: 'bayernflora_taxon', referencedColumnName: 'id')]
    protected(set) BayernTaxons $bayernfloraTaxon;

    public function setFsgTaxon(FSGTaxons $fsgTaxon): TaxonsConvertor
    {
        $this->fsgTaxon = $fsgTaxon;
        return $this;
    }

    public function setPladiasTaxon(Taxons $pladiasTaxon): TaxonsConvertor
    {
        $this->pladiasTaxon = $pladiasTaxon;
        return $this;
    }

    public function setBayernfloraTaxon(BayernTaxons $bayernfloraTaxon): TaxonsConvertor
    {
        $this->bayernfloraTaxon = $bayernfloraTaxon;
        return $this;
    }
}
