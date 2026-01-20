<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Atlas\Herbariums;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'pladiascz.index_herbariorum')]
class IndexHerbariorum
{
    use TId;

    #[ManyToOne(targetEntity: Herbariums::class)]
    #[JoinColumn(name: 'herbarium_id', referencedColumnName: 'id')]
    protected(set) ?Herbariums $pladiasHerbarium;

    #[Column(type: 'integer', nullable: true)]
    protected(set) ?int $surveyId;

    #[Column]
    protected(set) string $institutionName;

    #[Column(name: 'response_2025')]
    protected(set) string $response_2025;

}
