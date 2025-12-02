<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'floravegeu.habitats_nonvascular')]
class HabitatsNonvascular
{
    use TId;

    public const array  TaxaGroups = ["Bryophytes", "Algae", "Cyanobacteria", "Lichens", "Fungi"];
    public const string Diag = "Diagnostic";
    public const string  Cons = "Constant";
    public const string  Domin = "Dominant";
    public const array  TaxaTypes = [self::Cons, self::Diag, self::Domin];

    #[Column(type: 'string')]
    protected(set) string $taxagroup;

    #[Column(type: 'string')]
    protected(set) string $type;

    #[Column(type: 'string')]
    protected(set) string $taxon;

    #[ManyToOne(targetEntity: Habitats::class, inversedBy: 'taxaNonvascular')]
    #[JoinColumn(name: 'habitat', referencedColumnName: 'id')]
    protected(set) Habitats $habitat;

}
