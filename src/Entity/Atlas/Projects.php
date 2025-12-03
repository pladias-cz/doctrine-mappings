<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Atlas;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Institutions;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'atlas.projects')]
class Projects
{
    use TId;

    #[Column]
    protected(set) string $abbrev;
    #[Column]
    protected(set) string $credibility;
    #[Column(name: 'name')]
    protected(set) string $nameCs;
    #[Column]
    protected(set) string $nameEn;

    #[ManyToOne(targetEntity: Institutions::class)]
    #[JoinColumn(name: 'institution_id', referencedColumnName: 'id')]
    protected(set) Institutions $institution;

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
