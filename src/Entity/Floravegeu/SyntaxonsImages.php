<?php declare(strict_types=1);

namespace Pladias\ORM\Entity\Floravegeu;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Pladias\ORM\Entity\Attributes\TId;
use Pladias\ORM\Entity\Public\Syntaxons;
use Pladias\ORM\Enums\DateFormat;

#[Entity()]
#[Table(name: 'floravegeu.syntaxons_images')]
class SyntaxonsImages
{
    use TId;

    public const string PRECISION_DATE = "D";
    public const string  PRECISION_MONTH = "M";
    public const string  PRECISION_YEAR = "Y";
    #[ManyToOne(targetEntity: Syntaxons::class, inversedBy: 'images')]
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
    protected(set) ?string $remark;

    #[Column]
    protected(set) string $datePrecision;

    #[Column(name: 'domin_taxa')]
    protected(set) ?string $dominantTaxa;

    #[Column]
    protected(set) string $representative;

    #[Column]
    protected(set) ?string $association;

    public function getHTMLTitle($syntaxonName): string
    {
        $text = $syntaxonName;

        if ($this->association != "") {
            $text .= ", " . $this->association;
        }

        $text .= ". ";
        if ($this->dominantTaxa != "") {
            $text .= "Dominant species: ";
            $text .= $this->dominantTaxa . ". ";
        }

        if ($this->country != null) {
            $text .= $this->country->name_en;
        }

        if ($this->locality != null) {
            $text .= ", " . $this->locality;
        } else {
            $text .= ", locality unknown";
        }
        if ($this->getDateFormated() != "") {
            $text .= ", " . $this->getDateFormated();
        }
        if ($this->author_name != "") {
            $text .= ", " . $this->author_name;
        }
        $text .= ". ";

        if ($this->remark != "") {
            $text .= ucfirst($this->remark) . ". ";
        }

        return $text;
    }

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
