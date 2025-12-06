<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TNameCs;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'bayernflora.dictionary')]
class Dictionary
{
    use TId;
    use TNameCs;
    use TDescriptionCs;

    #[Column]
    protected(set) string $nameDe;

    #[Column]
    protected(set) string $descriptionDe;


    public function getName($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->nameCs,
            Locale::DE->value => !empty($this->nameDe) ? $this->nameDe : $this->nameCs,
            Locale::EN->value => !empty($this->nameEn) ? $this->nameEn : $this->nameCs,
            default => throw new WrongLocaleException(),
        };
    }

    public function getDescription($locale = Locale::CS): string
    {

        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->descriptionCs,
            Locale::DE->value => !empty($this->descriptionDe) ? $this->descriptionDe : $this->descriptionCs,
            Locale::EN->value => !empty($this->descriptionEn) ? $this->descriptionEn : $this->descriptionCs,
            default => throw new WrongLocaleException(),
        };

    }

}
