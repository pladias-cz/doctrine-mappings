<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\AtlasNonVascular;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Atlas\Records;

#[Entity()]
#[Table(name: 'atlas_nonvascular.records_extension')]
class RecordsExtension
{

    #[Column(name: 'substrate', type: 'string')]
    protected(set) string $substrateText;
    #[Column(name: 'chemical', type: 'string')]
    protected(set) string $chemicalText;
    #[OneToOne(targetEntity: Records::class, inversedBy: 'nonVascularExtension')]
    #[JoinColumn(name: 'record_id', referencedColumnName: 'id')]
    #[Id, GeneratedValue(strategy: 'IDENTITY')]
    protected(set) Records $recordId;


}
