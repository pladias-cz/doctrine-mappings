<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Entity\Public\Users;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'measurements.enumerates')]
class Enumerates
{
    use TId;
    use TDescriptionCs;
    use TName;

    #[ManyToOne(targetEntity: Users::class)]
    #[JoinColumn(name: 'administrator', referencedColumnName: 'id')]
    protected(set) Users $administrator;

    /**
     * @var Collection | EnumeratesValues[]
     */
    #[OneToMany(targetEntity: EnumeratesValues::class, mappedBy: 'enumerateId')]
    #[OrderBy(['succession' => 'ASC'])]
    protected(set) Collection $values;

    public function getValuesForDetermination(): array
    {
        $return = [];
        foreach ($this->values as $value) {
            if ($value->showInDetermination) {
                $return[] = $value->toArray();
            }
        }
        return $return;
    }

    public function getValuesForDeterminationSortedByName(string $locale): array
    {
        $return = [];
        foreach ($this->getValuesSortedByName($locale) as $value) {
            if ($value->showInDetermination) {
                $return[] = $value;
            }
        }
        return $return;
    }

    protected function getValuesSortedByName($locale = Locale::CS): ArrayCollection
    {
        if ($locale instanceof Locale) {
            $locale = $locale->value;
        }

        return match ($locale) {
            Locale::CS->value => $this->sortValuesByNameCz(),
            Locale::EN->value => $this->sortValuesByNameEn(),
            default => throw new WrongLocaleException(),
        };

    }

    protected function sortValuesByNameCz(): ArrayCollection
    {
        $collection = $this->values;
        $iterator = $collection->getIterator();
        $oldLocale = setlocale(LC_COLLATE, "0");
        setlocale(LC_COLLATE, 'cs_CZ.utf8');
        $iterator->uasort(function ($a, $b) {
            return strcoll($a->getNameCz(), $b->getNameCz());
        });
        setlocale(LC_COLLATE, $oldLocale);

        return new ArrayCollection(iterator_to_array($iterator));

    }

    protected function sortValuesByNameEn(): ArrayCollection
    {
        $collection = $this->values;
        $iterator = $collection->getIterator();
        $iterator->uasort(function ($a, $b) {
            return strcoll($a->getNameEn(), $b->getNameEn());
        });
        return new ArrayCollection(iterator_to_array($iterator));
    }

}
