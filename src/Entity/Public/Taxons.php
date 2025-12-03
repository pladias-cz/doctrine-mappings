<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Atlas\TaxonsUsers;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Bayernflora\TaxonsConvertor;
use Pladias\ORM\Entity\Dalibcz\TaxonInfo;
use Pladias\ORM\Enums\Locale;


/**
 * This entity works with view
 */
#[Entity()]
#[Table(name: 'public.taxons_clear')]
class Taxons
{
    use TId;

    #[ManyToOne(targetEntity: TaxonRanks::class)]
    #[JoinColumn(name: 'rank', referencedColumnName: 'id')]
    protected(set) TaxonRanks $rank;

    #[Column]
    protected(set) string $author;

    #[Column]
    protected(set) string $comment;

    #[Column(type: 'integer')]
    protected(set) int $depth;

    #[Column(name: 'depth_backup', type: 'integer')]
    protected(set) int $depthBackup;

    #[Column(name: 'id_dani')]
    protected(set) string $idDanihelka;

    #[Column(type: 'integer')]
    protected(set) int $lft;

    #[Column(name: 'lft_backup', type: 'integer')]
    protected(set) int $lft_backup;

    #[Column(name: 'name_cz')]
    protected(set) string $nameCz;

    #[Column(name: 'name_html')]
    protected(set) string $nameHtml;

    #[Column(name: 'name_lat')]
    protected(set) string $nameLatin;

    #[Column]
    protected(set) ?string $parents;

    #[Column(name: 'parents_cz')]
    protected(set) string $parentsCz;

    #[Column(type: 'integer')]
    protected(set) int $rgt;

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

    /**
     * used in florasylva probably only
     * @internal
     */
    public function getLongName(Locale $locale = Locale::CS)
    {
        if ($locale === Locale::CS) {
            return $this->nameCz. " (".$this->nameHtml.")";
        } else {
            return $this->nameHtml;
        }
    }
}
