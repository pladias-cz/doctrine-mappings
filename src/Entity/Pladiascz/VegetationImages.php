<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TRemark;
use Pladias\ORM\Entity\Public\Syntaxons;

#[Entity()]
#[Table(name: 'pladiascz.vegetation_images')]
class VegetationImages
{
    use TId;
    use TRemark;

    public const string PRECISION_DATE = "D";
    public const string PRECISION_MONTH = "M";
    public const string PRECISION_YEAR = "Y";

    #[ManyToOne(targetEntity: Syntaxons::class)]
    #[JoinColumn(name: 'syntaxon', referencedColumnName: 'id')]
    protected(set) Syntaxons $syntaxon;
    #[ManyToOne(targetEntity: Countries::class)]
    #[JoinColumn(name: 'country', referencedColumnName: 'id')]
    protected(set) Countries $country;
    #[Column]
    protected(set) string $author_name;
    #[Column]
    protected(set) string $date;
    #[Column]
    protected(set) string $filename;
    #[Column]
    protected(set) string $locality;

    #[Column]
    protected(set) string $datePrecision;
    #[Column(type: 'boolean')]
    protected(set) bool $representative;

    public function getDateFormated()
    {
        if (NULL === $this->date) {
            return "";
        }

        $date = \DateTime::createFromFormat('Y-m-d', $this->date);

        switch ($this->datePrecision) {
            case self::PRECISION_MONTH:
                $timestamp = strtotime($this->date);
                $date = date('%B %Y', $timestamp);
                return sprintf("%s", $date);

            case self::PRECISION_YEAR:
                $format = 'Y';
                break;
            default:
                $format = 'j.n.Y';
        }
        $date = $date->format($format);
        return sprintf("%s", $date);
    }


}
