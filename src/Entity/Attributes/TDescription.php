<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Attributes;

use Doctrine\ORM\Mapping\Column;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

trait TDescription
{

    #[Column(name:'description_cz')]
    protected(set) string $descriptionCs;

    #[Column(name:'description_en')]
    protected(set) string $descriptionEn;

    public function getDescription($locale = "cs"): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->descriptionCs,
            Locale::EN->value => !empty($this->descriptionEn) ? $this->descriptionEn : $this->descriptionCs,
            default => throw new WrongLocaleException(),
        };
    }

}
