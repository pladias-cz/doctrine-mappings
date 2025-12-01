<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Entity\Public\SyntaxonRanks;
use Pladias\ORM\Entity\Public\Users;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\MissingData;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'measurements.features')]
class Features
{
    use TId;
    use TDescriptionCs;

    use TName;

    public const int FEATURE_INV_STATUS = 148;
    public const int  FEATURE_ORIGINALITY = 147;
    public const array FEATURE_HIDDEN_IDS = array(217, 160, 163, 166);
    #[Column(type: 'string')]
    protected(set) ?string $bibliography_cs;
    #[Column(type: 'string')]
    protected(set) ?string $bibliography_en;
    #[Column(type: 'string')]
    protected(set) string $explanation_cs;
    #[Column(type: 'string')]
    protected(set) string $explanation_en;
    #[Column(type: 'string')]
    protected(set) string $external_id;
    #[Column(type: 'integer')]
    protected(set) int $maximum;
    #[Column(type: 'integer')]
    protected(set) int $minimum;
    #[Column(type: 'boolean')]
    protected(set) bool $show_description_on_public_web;
    #[Column(type: 'boolean')]
    protected(set) bool $show_on_public_web;
    #[Column(type: 'integer')]
    protected(set) int $succession;
    #[Column(type: 'integer')]
    protected(set) int $precisionOnPublicWeb;
    #[Column(type: 'boolean')]
    protected(set) bool $useForDetermination;
    #[Column(type: 'boolean')]
    protected(set) bool $determinationUnionInsteadIntersect;
    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'administrator', referencedColumnName: 'id')]
    protected(set) Users $administrator;
    #[ManyToOne(targetEntity: Enumerates::class)]
    #[JoinColumn(name: 'enumerate', referencedColumnName: 'id')]
    protected(set) Enumerates $enumerate;
    #[ManyToOne(targetEntity: Sections::class, inversedBy: 'features')]
    #[JoinColumn(name: 'section_id', referencedColumnName: 'id')]
    protected(set) Sections $section_id;
    #[ManyToOne(targetEntity: SyntaxonRanks::class)]
    #[JoinColumn(name: 'syntaxon_restricted_rank_id', referencedColumnName: 'id')]
    protected(set) SyntaxonRanks $syntaxon_restricted_rank_id;
    #[ManyToOne(targetEntity: Datatypes::class)]
    #[JoinColumn(name: 'datatype_id', referencedColumnName: 'id')]
    protected(set) Datatypes $datatype_id;
    #[ManyToOne(targetEntity: Inheritances::class)]
    #[JoinColumn(name: 'inheritance_id', referencedColumnName: 'id')]
    protected(set) Inheritances $inheritance;
    #[ManyToOne(targetEntity: Units::class)]
    #[JoinColumn(name: 'unit_id', referencedColumnName: 'id')]
    protected(set) ?Units $unit;
    /**
     * @var Collection | Traits[]
     */
    #[OneToMany(targetEntity: Traits::class, mappedBy: 'feature_id')]
    protected(set) Collection $traits;

    public function getBibliography($locale = Locale::CS): ?string
    {

        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->bibliography_cs,
            Locale::EN->value => !empty($this->bibliography_en) ? $this->bibliography_en : $this->bibliography_cs,
            default => throw new WrongLocaleException(),
        };
    }


    public function getExplanation($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->explanation_cs,
            Locale::EN->value => !empty($this->explanation_en) ? $this->explanation_en : $this->explanation_cs,
            default => throw new WrongLocaleException(),
        };
    }


    public function isEnum(): bool
    {
        if ($this->datatype_id->id === Datatypes::ENUM_NOMINAL_ID ||
            $this->datatype_id->id === Datatypes::ENUM_ORDINAL_ID ||
            $this->datatype_id->id === Datatypes::ENUM_ORDINAL_SINGLE_ID) {
            return true;
        }
        return false;
    }

    public function isEnumOrdinal(): bool
    {
        if ($this->datatype_id->id === Datatypes::ENUM_ORDINAL_ID ||
            $this->datatype_id->id === Datatypes::ENUM_ORDINAL_SINGLE_ID) {
            return true;
        }
        return false;
    }

    public function getDefaultTrait()
    {
        foreach ($this->traits as $trait) {
            if ($trait->default_values) {
                return $trait;
            }
        }
        throw new MissingData('Missing default trait for feature ID: ' . $this->id);
    }

}
