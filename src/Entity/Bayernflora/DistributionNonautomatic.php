<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Atlas\RecordValidationStatus;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Geodata\Quadrants;

#[Entity()]
#[Table(name: 'bayernflora.distribution_nonautomatic')]
class DistributionNonautomatic
{
    use TId;

    #[ManyToOne(targetEntity: FSGTaxons::class, inversedBy: 'convertor')]
    #[JoinColumn(name: 'taxon_fsg', referencedColumnName: 'id')]
    protected(set) FSGTaxons $fsgTaxon;

    #[ManyToOne(targetEntity: Quadrants::class, inversedBy: 'convertor')]
    #[JoinColumn(name: 'quadrant', referencedColumnName: 'id')]
    protected(set) Quadrants $quadrant;

    #[ManyToOne(targetEntity: RecordValidationStatus::class, inversedBy: 'convertor')]
    #[JoinColumn(name: 'validation_status', referencedColumnName: 'id')]
    protected(set) ?RecordValidationStatus $status = null;

    #[Column(type: 'string')]
    protected(set) string $remark;

    public function setFsgTaxon(FSGTaxons $fsgTaxon): DistributionNonautomatic
    {
        $this->fsgTaxon = $fsgTaxon;
        return $this;
    }

    public function setQuadrant(Quadrants $quadrant): DistributionNonautomatic
    {
        $this->quadrant = $quadrant;
        return $this;
    }

    public function setStatus(RecordValidationStatus $status): DistributionNonautomatic
    {
        $this->status = $status;
        return $this;
    }

    public function setRemark(string $remark): DistributionNonautomatic
    {
        $this->remark = $remark;
        return $this;
    }


}