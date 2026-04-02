<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Geodata;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity()]
#[Table(name: 'geodata.phytochorions')]
class Phytochorions
{

    #[Column(name: 'rowid', type: Types::INTEGER, unique: true, nullable: false)]
    #[Id, GeneratedValue(strategy: 'IDENTITY')]
    protected(set) ?int $id;

    /**
     * botanical id of the Phytochorion
     */
    #[Column(name: 'phyto_id')]
    protected(set) string $number;

    #[Column]
    protected(set) string $color;

    #[Column]
    protected(set) string $district;

    #[Column(name: 'geom_wgs')]
    protected(set) string $geom_wgs;

    #[Column]
    protected(set) string $name;


}
