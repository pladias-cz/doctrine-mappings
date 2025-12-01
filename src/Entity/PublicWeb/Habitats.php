<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\PublicWeb;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'public_web.habitats')]
class Habitats
{
    use TId;

    #[ManyToOne(targetEntity: HabitatsRanks::class)]
    #[JoinColumn(name: 'rank', referencedColumnName: 'id')]
    protected(set) HabitatsRanks $rank;

    #[Column(type: 'integer')]
    protected(set) int $depth;

    #[Column(type: 'integer')]
    protected(set) int $lft;

    #[Column(type: 'integer')]
    protected(set) int $rgt;

    #[Column(type: 'string')]
    protected(set) string $code;

    #[Column(type: 'string')]
    protected(set) string $redListCode;

    #[Column(type: 'string')]
    protected(set) string $redListName;

    #[Column(type: 'string')]
    protected(set) string $name;
    #[Column(type: 'string')]
    protected(set) string $nameHTML;

    #[Column(type: 'string')]
    protected(set) ?string $description;

    #[Column(name: 'map', type: 'boolean')]
    protected(set) bool $hasMap;

    #[OneToMany(targetEntity: HabitatsSyntaxons::class, mappedBy: 'habitat')]
    protected(set) Collection $syntaxa_relationships;

    #[OneToMany(targetEntity: HabitatsSyntaxonsNonvascular::class, mappedBy: 'habitat')]
    protected(set) Collection $syntaxa_relationships_nonvascular;

    #[OneToMany(targetEntity: HabitatsNonvascular::class, mappedBy: 'habitat')]
    #[OrderBy(['taxagroup' => 'ASC', 'taxon' => 'ASC'])]
    protected(set) Collection $taxaNonvascular;

    public function hasNomenclature(): bool
    {
        if ($this->redListCode === '') {
            return false;
        }
        return true;
    }

    public function hasDescription(): bool
    {
        if ($this->description === '') {
            return false;
        }
        return true;
    }

    public function hasAlliances(): bool
    {
        if (count($this->syntaxa_relationships) == 0 && count($this->syntaxa_relationships_nonvascular) == 0) {
            return false;
        }

        if ($this->rank->id < 4) {
            return false;
        }
        return true;
    }

    public function getMapURL(): string
    {
        return "https://files.ibot.cas.cz/cevs/maps/habitats/" . $this->code . ".png";

    }

    public function getTaxaNonvascular($filterType = HabitatsNonvascular::TaxaTypes, $filterGroup = NULL)
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq("type", $filterType));
        if ($filterGroup !== NULL) {
            $criteria->andWhere(Criteria::expr()->eq("taxagroup", $filterGroup));
            return $this->taxaNonvascular->matching($criteria);
        }
        return $this->taxaNonvascular;
    }
}
