<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Attributes;

use Doctrine\ORM\Mapping\Column;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

trait TText
{

    #[Column]
    protected(set) string $text_cs;

    #[Column]
    protected(set) string $text_en;

    public function getText($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->text_cs,
            Locale::EN->value => !empty($this->text_en) ? $this->text_en : $this->text_cs,
            default => throw new WrongLocaleException(),
        };
    }

}
