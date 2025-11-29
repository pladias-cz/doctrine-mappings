<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'bayernflora.dictionary')]
class Dictionary
{
    use TId;

    #[Column(type: 'string')]
    protected(set) string $nameCz;

    #[Column(type: 'string')]
    protected(set) string $nameDe;

    #[Column(type: 'string')]
    protected(set) string $nameEn;

    #[Column(type: 'string')]
    protected(set) string $descriptionCz;

    #[Column(type: 'string')]
    protected(set) string $descriptionDe;

    #[Column(type: 'string')]
    protected(set) string $descriptionEn;

    public function getName($locale = Locale::CS): string
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

    public function getDescription($locale = Locale::CS): string
    {

        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->descriptionCz,
            Locale::DE->value => !empty($this->descriptionDe) ? $this->descriptionDe : $this->descriptionCz,
            Locale::EN->value => !empty($this->descriptionEn) ? $this->descriptionEn : $this->descriptionCz,
            default => throw new WrongLocaleException(),
        };

    }

}
