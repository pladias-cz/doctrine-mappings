<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\PublicWeb;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Taxons;
use Pladias\ORM\Enums\DateFormat;

#[Entity()]
#[Table(name: 'public_web.taxons_images')]
class TaxonsImages
{
    use TId;

    public const string PRECISION_DATE = "D";
    public const string  PRECISION_MONTH = "M";
    public const string  PRECISION_YEAR = "Y";
    #[Column(type: 'integer')]
    protected(set) int $altitude;
    #[Column(type: 'string')]
    protected(set) string $author;
    #[Column(type: 'string')]
    protected(set) string $date;
    #[Column(type: 'string')]
    protected(set) string $external_id;
    #[Column(type: 'string')]
    protected(set) string $filename;
    #[Column(type: 'string')]
    protected(set) string $locality;
    #[Column(type: 'string')]
    protected(set) string $remark;
    #[Column(type: 'string')]
    protected(set) string $representative;
    #[Column(type: 'string')]
    protected(set) string $source;
    #[Column(type: 'string')]
    protected(set) string $datePrecision;
    #[Column(type: 'integer')]
    protected(set) int $succession;
    #[ManyToOne(targetEntity: Taxons::class, inversedBy: 'images')]
    #[JoinColumn(name: 'taxon', referencedColumnName: 'id')]
    protected(set) Taxons $taxon;

    #[ManyToOne(targetEntity: Countries::class)]
    #[JoinColumn(name: 'country', referencedColumnName: 'id')]
    protected(set) Countries $country;

    public function getHTMLTitle($taxonName)
    {
        $text = $taxonName;
        if ($this->country != null) {
            $text .= ", " . $this->country->name_en;
        }

        if ($this->locality != null) {
            $text .= ", " . $this->locality;
        } else {
            $text .= ", locality unknown";
        }

        $text .= ", ";

        $helper = "";

        if ($this->date != null) {
            $helper .= $this->getDateFormated();
        }

        if ($this->author != "") {
            if (strlen($helper) > 0) {
                $helper .= ", ";
            }
            $helper .= $this->author;
        }

        if (strlen($helper) > 0) {
            $text .= $helper . ". ";
        }


        if ($this->getRemark() != "") {
            $text .= $this->getRemark();
            if (!str_ends_with($text, '.')) {
                $text .= ".";
            }
        }

        return $text;
    }

    public function getDateFormated()
    {
        if (NULL === $this->date) {
            return "";
        }

        $date = \DateTime::createFromFormat(DateFormat::DEFAULT->value, $this->date);

        switch ($this->datePrecision) {
            case self::PRECISION_MONTH:
                $format = 'Y';
                $date = $date->format($format);
                return sprintf("%s", $date) . "-00-00";

            case self::PRECISION_YEAR:
                $format = 'Y';
                $date = $date->format($format);
                return sprintf("%s", $date);
            default:
                $format = DateFormat::DEFAULT->value;
                $date = $date->format($format);
                return sprintf("%s", $date);
        }

    }

    public function getRemark(): string
    {
        return ucfirst(trim($this->remark));
    }

}
