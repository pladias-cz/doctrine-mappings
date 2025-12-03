<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Public;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TMptt;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Entity\Floravegeu\HabitatsSyntaxons;
use Pladias\ORM\Entity\Floravegeu\SyntaxonsBibliography;
use Pladias\ORM\Entity\Floravegeu\SyntaxonsDiagnosticNonvascular;
use Pladias\ORM\Entity\Floravegeu\SyntaxonsImages;
use Pladias\ORM\Entity\Floravegeu\SyntaxonsRemarksVersions;
use Pladias\ORM\Entity\Floravegeu\SyntaxonsSynonyms;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'public.syntaxons')]
class Syntaxons
{
    use TId;
    use TName;
    use TMptt;

    #[ManyToMany(targetEntity: SyntaxonsSections::class)]
    #[JoinTable(
        name: 'public.rel_syntaxons_sections',
        joinColumns: [
            new JoinColumn(name: 'syntaxon_id', referencedColumnName: 'id')
        ],
        inverseJoinColumns: [
            new JoinColumn(name: 'section_id', referencedColumnName: 'id')
        ]
    )]
    protected(set) Collection $syntaxons_sections;
    #[Column]
    protected(set) string $author;
    #[Column]
    protected(set) string $author_2;
    #[Column]
    protected(set) string $author_html;
    #[Column(name:'`citationHTML`',type: 'string')]
    protected(set) string $citationHTML;
    #[Column]
    protected(set) string $code;
    #[Column]
    protected(set) string $comment;
    #[Column]
    protected(set) string $description;
    #[Column]
    protected(set) string $filename;
    #[Column]
    protected(set) string $map_filename;
    #[Column]
    protected(set) string $name_cz_html;
    #[Column]
    protected(set) string $name_en_html;
    #[Column]
    protected(set) string $name_lat;
    #[Column]
    protected(set) string $nomen;
    #[Column]
    protected(set) string $pages;

    #[Column]
    protected(set) string $species_const_html;
    #[Column]
    protected(set) string $species_diag_html;
    #[Column]
    protected(set) string $species_dominant_html;
    #[Column(name:'species_formal_html')]
    protected(set) string $species_formal_html_cs;
    #[Column]
    protected(set) string $species_formal_html_en;
    #[Column]
    protected(set) string $synonymum_html;
    #[Column]
    protected(set) string $text_1;
    #[Column]
    protected(set) string $text_2;
    #[Column]
    protected(set) string $text_3;
    #[Column]
    protected(set) string $text_en;
    #[Column(type: 'integer')]
    protected(set) int $releveCount;

    #[Column(type: 'boolean')]
    protected(set) bool $vegkeyForest;

    #[ManyToOne(targetEntity: SyntaxonRanks::class)]
    #[JoinColumn(name: 'rank', referencedColumnName: 'id')]
    protected(set) SyntaxonRanks $rank;

    #[OneToMany(targetEntity: SyntaxonsImages::class, mappedBy: 'syntaxon')]
    protected(set) Collection $images;

    #[OneToMany(targetEntity: SyntaxonsSynonyms::class, mappedBy: 'syntaxon')]
    #[OrderBy(['originalName' => 'ASC'])]
    protected(set) Collection $synonyms;

    #[OneToMany(targetEntity: SyntaxonsDiagnosticNonvascular::class, mappedBy: 'syntaxon')]
    #[OrderBy(['taxagroup' => 'ASC', 'taxon' => 'ASC'])]
    protected(set) Collection $diagnosticNonvascular;

    #[OneToMany(targetEntity: SyntaxonsBibliography::class, mappedBy: 'syntaxon')]
    #[OrderBy(['succession' => 'ASC', 'cite' => 'ASC'])]
    protected(set) Collection $bibliography;

    #[OneToMany(targetEntity: SyntaxonsRemarksVersions::class, mappedBy: 'syntaxon')]
    #[OrderBy(['createdAt' => 'DESC'])]
    protected(set) Collection $remarks;

    #[OneToMany(targetEntity: HabitatsSyntaxons::class, mappedBy: 'syntaxon')]
    protected(set) Collection $habitat_relationships;

    public function getSpeciesFormalHtml($locale = Locale::CS): string
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->species_formal_html_cs,
            Locale::EN->value => !empty($this->species_formal_html_en) ? $this->species_formal_html_en : $this->species_formal_html_cs,
            default => throw new WrongLocaleException(),
        };
    }


    public function getMapURL(): string
    {

        $folder = match ($this->rank->id) {
            2 => "classes",
            3 => "orders",
            4 => "alliances",
            default => "",
        };
        return "https://files.ibot.cas.cz/cevs/maps/vegetation/" . $folder . "/" . strtok($this->code, ' ') . ".png";
    }

    public function getNewestRemarkVersion(): ?SyntaxonsRemarksVersions
    {
        if ($this->hasRemarks()) {
            return $this->remarks[0];
        }
        return null;
    }

    public function hasRemarks(): bool
    {
        if (count($this->remarks) == 0) {
            return false;
        }
        return true;
    }


    public function getOldestRemarkVersion(): ?SyntaxonsRemarksVersions
    {
        if ($this->hasRemarks()) {
            return $this->remarks->last();
        }
        return null;
    }

    public function hasMultipleRemarkVersions(): bool
    {
        if (count($this->remarks) > 1) {
            return true;
        }
        return false;
    }

    public function hasBiblio(): bool
    {
        if (count($this->bibliography) == 0) {
            return false;
        }

        if ($this->rank->id != 2) {
            return false;
        }
        return true;
    }


    public function hasPictures(): bool
    {
        if (count($this->images) == 0) {
            return false;
        }
        return true;
    }


    public function getDiagnosticNonvascular($filterByGroup = NULL)
    {
        if ($filterByGroup !== NULL) {
            $criteria = Criteria::create()->where(Criteria::expr()->eq("taxagroup", $filterByGroup));
            return $this->diagnosticNonvascular->matching($criteria);
        }
        return $this->diagnosticNonvascular;
    }
}
