<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'atlas.record_originality_status')]
class RecordOriginalityStatus
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $icon;

    #[Column(type: 'string')]
    protected(set) string $name_cz;

    #[Column(type: 'string')]
    protected(set) string $priority;

}
