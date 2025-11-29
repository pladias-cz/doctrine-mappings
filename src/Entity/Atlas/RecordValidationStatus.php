<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'atlas.record_validation_status')]
class RecordValidationStatus
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $color;

    #[Column(type: 'string')]
    protected(set) string $description;

    #[Column(type: 'string')]
    protected(set) string $priority;

}