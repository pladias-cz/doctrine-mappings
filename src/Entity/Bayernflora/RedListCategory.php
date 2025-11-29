<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'bayernflora.redlist_categories')]
class RedListCategory
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $abbreviation;

    #[Column(type: 'string')]
    protected(set) string $nameCz;

    #[Column(type: 'string')]
    protected(set) string $nameDe;

    #[Column(type: 'string')]
    protected(set) string $nameEn;


    public function getName($locale = Locale::CS)
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->nameCz,
            Locale::DE->value => !empty($this->nameDe) ? $this->nameDe : $this->nameCz,
            Locale::EN->value => !empty($this->nameEn) ? $this->nameEn : $this->nameCz,
            default => throw new WrongLocaleException(),
        };

    }

}
