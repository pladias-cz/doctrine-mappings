<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'public.publications')]
class Publications
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $abbrev;

    #[Column(type: 'string')]
    protected(set) string $title;

    #[Column(type: 'string')]
    protected(set) string $authors;

    #[Column(type: 'string')]
    protected(set) string $publisher;

    #[Column(type: 'integer')]
    protected(set) int $year;

    #[Column(type: 'integer')]
    protected(set) int $autocomplete;

    #[Column(type: 'boolean')]
    protected(set) bool $textCz;

    #[Column(type: 'string')]
    protected(set) string $textEn;

    #[Column(type: 'integer')]
    protected(set) int $succession;


    public function getText($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->textCz,
            Locale::EN->value => !empty($this->textEn) ? $this->textEn : $this->textCz,
            default => throw new WrongLocaleException(),
        };
    }

}
