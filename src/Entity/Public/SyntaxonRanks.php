<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'public.syntaxon_ranks')]
class SyntaxonRanks
{
    use TId;
    public const int ALLIANCE = 4;
    public const int  ASSOCIATION = 5;

    #[Column]
    protected(set) string $abbrev_eng;

    #[Column]
    protected(set) string $id_foreign;

    #[Column(name:'name_cz')]
    protected(set) string $nameCs;

    #[Column(name:'name_eng')]
    protected(set) string $nameEn;

    public function getName($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->nameCs,
            Locale::EN->value => !empty($this->nameEn) ? $this->nameEn : $this->nameCs,
            default => throw new WrongLocaleException(),
        };
    }

}
