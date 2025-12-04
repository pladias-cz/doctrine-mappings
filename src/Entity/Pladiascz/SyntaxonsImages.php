<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TRemark;
use Pladias\ORM\Entity\Floravegeu\Countries;
use Pladias\ORM\Entity\Public\Syntaxons;
use Pladias\ORM\Enums\DateFormat;
//TODO this class is redundant to floravegeu - let's refactored when the images are moved to the repository
#[Entity()]
#[Table(name: 'pladiascz.vegetation_images')]
class SyntaxonsImages
{
    use TId;
    use TRemark;

    public const string PRECISION_DATE = "D";
    public const string  PRECISION_MONTH = "M";
    public const string  PRECISION_YEAR = "Y";
    #[ManyToOne(targetEntity: Syntaxons::class)]
    #[JoinColumn(name: 'syntaxon', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;

    #[ManyToOne(targetEntity: Countries::class)]
    #[JoinColumn(name: 'country', referencedColumnName: 'id')]
    protected(set) Countries $country;

    #[Column]
    protected(set) string $author_name;

    #[Column]
    protected(set) ?string $date;

    #[Column]
    protected(set) string $filename;

    #[Column]
    protected(set) ?string $locality;

    #[Column]
    protected(set) string $datePrecision;

    #[Column]
    protected(set) string $representative;

    public function getDateFormated(): string
    {
        if (NULL === $this->date) {
            return "";
        }

        $date = \DateTime::createFromFormat(DateFormat::DEFAULT->value, $this->date);

        switch ($this->datePrecision) {
            case self::PRECISION_MONTH:
                $format = 'Y';
                $date = $date->format($format);
                return sprintf("%s", $date);

            case self::PRECISION_YEAR:
                $format = 'Y';
                //$date = strftime('%Y', $timestamp);
                break;
            default:
                $format = DateFormat::DEFAULT->value;
        }
        $date = $date->format($format);
        return sprintf("%s", $date);
    }


}
