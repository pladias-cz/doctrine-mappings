<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;

#[Entity()]
#[Table(name: 'public.syntaxon_ranks')]
class SyntaxonRanks
{
    use TId;
    use TName;

    public const int ALLIANCE = 4;
    public const int  ASSOCIATION = 5;

    #[Column(type: 'string')]
    protected(set) string $abbrev_eng;

    #[Column(type: 'string')]
    protected(set) string $id_foreign;

}
