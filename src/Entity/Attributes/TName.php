<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Attributes;

use Doctrine\ORM\Mapping\Column;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

trait TName
{

    #[Column(name:'name_cz')]
    protected(set) string $nameCs;

    #[Column(name:'name_en')]
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
