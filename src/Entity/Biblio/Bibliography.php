<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Biblio;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'biblio.bibliography')]
class Bibliography
{
    use TId;

    #[Column]
    protected(set) string $authors;

    #[Column]
    protected(set) string $etc;

    #[Column(type: 'boolean')]
    protected(set) bool $excerpted;

    #[Column]
    protected(set) string $journal;

    #[Column]
    protected(set) string $journal_id;

    #[Column(type: 'integer')]
    protected(set) int $original_id;

    #[Column]
    protected(set) string $original_string;

    #[Column]
    protected(set) string $remarks;

    #[Column]
    protected(set) string $title;

    #[Column(type: 'integer')]
    protected(set) int $year;

}
