<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Pladiascz;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Attributes\TRemark;
use Pladias\ORM\Entity\Public\Taxons;

#[Entity()]
#[Table(name: 'pladiascz.images')]
class Images
{
    use TId;
    use TRemark;

    public const string PRECISION_DATE = "D";
    public const string PRECISION_MONTH = "M";
    public const string PRECISION_YEAR = "Y";

    public const string LARGE = "large";
    public const string XLARGE = "xlarge";
    public const string THUMB = "thumb";

    #[ManyToOne(targetEntity: Taxons::class)]
    #[JoinColumn(name: 'taxon', referencedColumnName: 'id')]
    protected(set) Taxons $taxon;
    #[ManyToOne(targetEntity: Countries::class)]
    #[JoinColumn(name: 'country', referencedColumnName: 'id')]
    protected(set) Countries $country;
    #[Column(type: 'integer')]
    protected(set) int $altitude;
    #[Column]
    protected(set) string $author;
    #[Column]
    protected(set) string $date;
    #[Column]
    protected(set) string $external_id;
    #[Column]
    protected(set) string $filename;
    #[Column]
    protected(set) string $locality;
    #[Column]
    protected(set) string $representative;
    #[Column]
    protected(set) string $type;
    #[Column]
    protected(set) string $source;
    #[Column]
    protected(set) string $datePrecision;
    #[Column(type: 'integer')]
    protected(set) int $succession;


    public function getFilePath($size = self::LARGE)
    {
        switch ($size) {
            case self::LARGE:
                $path = "/large";
                break;
            case self::XLARGE:
                $path = "/extra_large";
                break;
            default:
                $path = "/thumbs";
        }
        if ($this->type == "photo") {
            return "/images" . $path . "/" . $this->filename;
        } else {
            return "/images/clopla" . $path . "/" . $this->filename;
        }
    }

    public function getDateFormated()
    {
        if (NULL === $this->date) {
            return "";
        }

        $date = \DateTime::createFromFormat('Y-m-d', $this->date);

        switch ($this->datePrecision) {
            case self::PRECISION_MONTH:
                $date = new \DateTime($this->date);
                return $date->format('(F Y)');

            case self::PRECISION_YEAR:
                $format = 'Y';
                //$date = strftime('%Y', $timestamp);
                break;
            default:
                $format = 'j. n. Y';
        }
        $date = $date->format($format);
        return sprintf("%s", $date);
    }

}
