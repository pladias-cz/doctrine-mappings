<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TMptt;
use Pladias\ORM\Entity\Attributes\TName;
use Pladias\ORM\Enums\Locale;
use Pladias\ORM\Exception\WrongLocaleException;

#[Entity()]
#[Table(name: 'measurements.sections')]
class Sections
{
    use TId;
    use TDescriptionCs;
    use TName;
    use TMptt;
    #[Column]
    protected(set) string $bibliography_cs;
    #[Column]
    protected(set) string $bibliography_en;

    /**
     * @var Features[]
     */
    #[OneToMany(targetEntity: Features::class, mappedBy: 'section_id')]
    protected(set) Collection $features;


    public function getBibliography($locale = Locale::CS): string
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

    public function getFeaturesForDetermination()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('useForDetermination', true));

        return $this->features->matching($criteria);
    }

}
