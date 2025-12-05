<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Atlas\TaxonMapsettings;
use Pladias\ORM\Entity\Atlas\TaxonsUsers;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TMptt;
use Pladias\ORM\Entity\Bayernflora\TaxonsConvertor;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;


/**
 * This entity works with view
 */
#[Entity()]
#[Table(name: 'public.taxons_clear')]
class Taxons
{
    use TId;
    use TMptt;

    #[ManyToOne(targetEntity: TaxonRanks::class)]
    #[JoinColumn(name: 'rank', referencedColumnName: 'id')]
    protected(set) TaxonRanks $rank;

    #[Column]
    protected(set) ?string $author;

    #[Column]
    protected(set) string $comment;


    #[Column(name: 'depth_backup', type: 'integer')]
    protected(set) int $depthBackup;

    #[Column(name: 'id_dani')]
    protected(set) string $idDanihelka;


    #[Column(name: 'lft_backup', type: 'integer')]
    protected(set) int $lft_backup;

    #[Column(name: 'name_cz')]
    protected(set) ?string $nameCz;

    #[Column(name: 'name_html')]
    protected(set) string $nameHtml;

    #[Column(name: 'name_lat')]
    protected(set) string $nameLatin;

    #[Column]
    protected(set) ?string $parents;

    #[Column(name: 'parents_cz')]
    protected(set) string $parentsCz;

    #[Column(name: 'rgt_backup', type: 'integer')]
    protected(set) int $rgt_backup;

    #[Column(type: 'boolean')]
    protected(set) bool $suppressed;

    #[Column(type: 'boolean')]
    protected(set) bool $protected;

    #[OneToMany(targetEntity: TaxonsConvertor::class, mappedBy: 'pladiasTaxon')]
    protected(set) Collection $taxonConvertor;

    #[OneToMany(targetEntity: TaxonSynonyms::class, mappedBy: 'taxon')]
    protected(set) Collection $synonyms;

    #[OneToMany(targetEntity: TaxonsUsers::class, mappedBy: 'taxons_id')]
    protected(set) Collection $revisors;

    #[OneToOne(targetEntity: TaxonMapsettings::class)]
    #[JoinColumn(name: 'id', referencedColumnName: 'taxon_id')]
    protected(set) TaxonMapsettings $mapsettings;

    public function getNamePreslia()
    {
        $name = str_replace(".", "", $this->nameLatin) . "_report.pdf";
        $name = str_replace(" ", "_", $name);
        return $name;
    }


    public function isTerminating()
    {
        if ($this->lft + 1 == $this->rgt) {
            return true;
        }
        return false;
    }

    public function getLongName($locale = Locale::CS)
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }
        return match ($locale) {
            Locale::CS->value => $this->nameCz . " (" . $this->nameHtml . ")",
            Locale::EN->value => $this->nameHtml,
            default => throw new WrongLocaleException(),
        };

    }

    public function getName($locale = Locale::CS)
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }
        return match ($locale) {
            Locale::CS->value => $this->nameCz,
            Locale::EN->value => $this->nameHtml,
            default => throw new WrongLocaleException(),
        };
    }

    public function getNameMulti($locale = Locale::CS)
    {

        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }
        return match ($locale) {
            Locale::CS->value => $this->nameCz . " (<i>" . $this->nameHtml . "</i>)",
            Locale::EN->value => $this->nameHtml,
            default => throw new WrongLocaleException(),
        };
    }

    public function isMapped()
    {
        try {
            if (NULL !== $this->mapsettings
                && (0 < $this->mapsettings->revision_status->id || 0 < $this->mapsettings->publication_status->id)
            ) {
                return true;
            }
        } catch (EntityNotFoundException $exception) {
        }
        return false;
    }

    public function getSynonymsFromSource($source)
    {
        $return = array();
        foreach ($this->synonyms as $synonym) {
            if ($synonym->publication->id === $source) {
                $return[] = $synonym;
            }
        }
        return $return;

    }
}
