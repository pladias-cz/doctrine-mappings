<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
class Kvetena
{
    use TId;

    #[Column]
    protected(set) string $filename;

    #[Column]
    protected(set) string $citation;

    #[Column(type: 'integer')]
    protected(set) int $taxon_id;

}
