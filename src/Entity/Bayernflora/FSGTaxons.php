<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'bayernflora.taxons_fsg')]
class FSGTaxons
{
    public const array excludedFromItalics = ["/\s(agg\.)/", "/\s(subsp\.)/", "/\s(nothosubsp\.)/", "/\s(var\.)/", "/\s(sect\.)/", "/\s(subg\.)/"];
    public const string  replacement = ' <span class="noItalics">$1</span>';

    use TId;

    #[Column(type: 'string')]
    protected(set) string $nameLat;

    #[Column(type: 'string')]
    protected(set) string $nameCz;

    #[Column(type: 'string')]
    protected(set) string $nameDe;

    #[Column(type: 'string')]
    protected(set) string $descriptionCz;

    #[Column(type: 'string')]
    protected(set) string $descriptionDe;

    #[Column(type: 'string')]
    protected(set) string $descriptionEn;

    #[Column(type: 'string')]
    protected(set) string $redlistReason;

    #[OneToMany(targetEntity: TaxonsConvertor::class, mappedBy: 'fsgTaxon')]
    protected(set) array $taxonConvertor;

    #[OneToMany(targetEntity: Images::class, mappedBy: 'taxon')]
    protected(set) array $images;

    #[Column(type: 'integer')]
    protected(set) int $altitudeMax;

    #[Column(type: 'integer')]
    protected(set) int $altitudeMin;

    #[Column(type: 'boolean')]
    protected(set) bool $autocomplete;

    #[ManyToOne(targetEntity: RedListCategory::class)]
    #[JoinColumn(name: 'redlist_category', referencedColumnName: 'id')]
    protected ?RedListCategory $redListCategory;

    public function getExtendedName($locale = Locale::CS): ?string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }
        $extendedName = '';

        if ($locale === Locale::DE->value) {
            $extendedName .= $this->nameDe;
        } else {
            $extendedName .= $this->nameCz;
        }
        if ($this->getName($locale) !== null) {
            $extendedName .= " (";
        }
        $extendedName .= "<i>" . $this->nameLat . "</i>";
        if ($this->getName($locale) !== null) {
            $extendedName .= ")";
        }

        return preg_replace(self::excludedFromItalics, self::replacement, $extendedName);

    }

    public function getName($locale = Locale::CS): ?string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->nameCz,
            Locale::DE->value => !empty($this->nameDe) ? $this->nameDe : null,
            Locale::EN->value => !empty($this->nameEn) ? $this->nameEn : null,
            default => throw new WrongLocaleException(),
        };
    }

    public function getDescription($locale = Locale::CS): ?string
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


    public function hasImages(): bool
    {
        return count($this->images) === 0 ? false : true;
    }


}
