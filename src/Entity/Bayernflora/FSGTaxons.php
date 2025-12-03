<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Bayernflora;


use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Taxons;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'bayernflora.taxons_fsg')]
class FSGTaxons
{
    public const array excludedFromItalics = ["/\s(agg\.)/", "/\s(subsp\.)/", "/\s(nothosubsp\.)/", "/\s(var\.)/", "/\s(sect\.)/", "/\s(subg\.)/"];
    public const string  replacement = ' <span class="noItalics">$1</span>';

    use TId;

    #[OneToMany(targetEntity: TaxonsConvertor::class, mappedBy: 'fsgTaxon')]
    protected(set) Collection $taxonConvertor;

    #[OneToMany(targetEntity: Images::class, mappedBy: 'taxon')]
    protected(set) Collection $images;

    #[ManyToOne(targetEntity: RedListCategory::class)]
    #[JoinColumn(name: 'redlist_category', referencedColumnName: 'id')]
    protected(set) ?RedListCategory $redListCategory;

    #[ManyToMany(targetEntity: BayernTaxons::class)]
    #[JoinTable(
        name: 'bayernflora.taxons_convertor',
        joinColumns: [
            new JoinColumn(name: 'fsg_taxon_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'bayernflora_taxon', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $bayernTaxa;

    #[ManyToMany(targetEntity: Taxons::class)]
    #[JoinTable(
        name: 'bayernflora.taxons_convertor',
        joinColumns: [
            new JoinColumn(name: 'fsg_taxon_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'pladias_taxon', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $pladiasTaxa;

    #[Column(name: 'name_lat')]
    protected(set) string $nameLat;

    #[Column(name: 'name_cz')]
    protected(set) ?string $nameCz;

    #[Column(name: 'name_de')]
    protected(set) ?string $nameDe;

    #[Column(name: 'description_cz')]
    protected(set) ?string $descriptionCz;

    #[Column(name: 'description_de')]
    protected(set) ?string $descriptionDe;

    #[Column(name: 'description_en')]
    protected(set) ?string $descriptionEn;

    #[Column]
    protected(set) string $redlistReason;

    #[Column(type: 'integer')]
    protected(set) ?int $altitudeMax;

    #[Column(type: 'integer')]
    protected(set) ?int $altitudeMin;

    #[Column(type: 'boolean')]
    protected(set) bool $autocomplete;

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

    public function setNameLat(string $nameLat): FSGTaxons
    {
        $this->nameLat = $nameLat;
        return $this;
    }

}
