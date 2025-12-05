<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Attributes;

use Doctrine\ORM\Mapping\Column;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

trait TRemark
{

    #[Column]
    protected(set) ?string $remark_cs;

    #[Column]
    protected(set) ?string $remark_en;

    public function getRemark($locale = Locale::CS): ?string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->remark_cs,
            Locale::EN->value => !empty($this->remark_en) ? $this->remark_en : $this->remark_cs,
            default => throw new WrongLocaleException(),
        };
    }

}
