<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Measurements;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TDescriptionCs;
use Pladias\ORM\Entity\Attributes\TId;

#[Entity()]
#[Table(name: 'measurements.datatypes')]
class Datatypes
{
    use TId;
    use TDescriptionCs;

    public const string INTERVAL_AVG = "interval_avg";
    public const string INTERVAL_MOD = "interval_mod";
    public const string REAL = "real";
    public const string REAL_MULTI = "real_multi";
    public const string ENUM_NOMINAL = "enum_nominal";
    public const string ENUM_ORDINAL = "enum_ordinal";
    public const string ENUM_ORDINAL_SINGLE = "enum_ordinal_single";
    public const string BOOLEAN = "boolean";
    public const string MONTH = "month";
    public const int ENUM_NOMINAL_ID = 5;
    public const int ENUM_ORDINAL_ID = 6;
    public const int ENUM_ORDINAL_SINGLE_ID = 15;


    #[Column(type: 'boolean')]
    protected(set) bool $dominantValue;
    #[Column(type: 'string')]
    protected(set) string $key;
    #[Column(type: 'integer')]
    protected(set) int $max;
    #[Column(type: 'integer')]
    protected(set) int $min;
    #[Column(type: 'boolean')]
    protected(set) bool $multiplicity;

    #[Column(name: 'name_cz', type: 'string')]
    protected(set) string $nameCs;
    #[Column(type: 'string')]
    protected(set) string $tablename;
    #[Column(type: 'boolean')]
    protected(set) bool $unmeasurable;
    #[Column(type: 'string')]
    protected(set) string $valueComment;
    #[Column(type: 'integer')]
    protected(set) int $frequency;

}
