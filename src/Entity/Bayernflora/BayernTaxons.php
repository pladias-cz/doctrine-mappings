<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'bayernflora.taxons')]
class BayernTaxons
{
    use TId;

    #[Column(type: 'string')]
    protected(set) ?string $nameLat;
    #[Column(type: 'integer')]
    protected(set) int $foreignId;
    #[Column(name: 'name_lat_full', type: 'string')]
    protected(set) string $nameLatFull;
    #[OneToMany(targetEntity: TaxonsConvertor::class, mappedBy: 'bayernfloraTaxon')]
    protected(set) Collection $convertor;

    public function setForeignId(int $foreignId): BayernTaxons
    {
        $this->foreignId = $foreignId;
        return $this;
    }

    public function setNameLat(string $nameLat): BayernTaxons
    {
        $this->nameLat = $nameLat;
        return $this;
    }

    public function setNameLatFull(string $nameLatFull): BayernTaxons
    {
        $this->nameLatFull = $nameLatFull;
        return $this;
    }


}