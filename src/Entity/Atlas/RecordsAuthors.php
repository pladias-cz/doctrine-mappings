<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'atlas.records_authors')]
class RecordsAuthors
{
    use TId;

    #[ManyToOne(targetEntity: Authors::class)]
    #[JoinColumn(name: 'authors_id', referencedColumnName: 'id')]
    protected(set) Authors $authors;

    #[ManyToOne(targetEntity: Records::class)]
    #[JoinColumn(name: 'records_id', referencedColumnName: 'id')]
    protected(set) Records $records;

    #[Column(type: 'integer')]
    protected(set) int $succession;

}
